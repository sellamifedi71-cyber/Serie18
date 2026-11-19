<?php
declare(strict_types=1);
require __DIR__ . '/config.php';
$error = ''; $success = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();
    $cin = trim((string)($_POST['cin'] ?? ''));
    $code = trim((string)($_POST['code'] ?? ''));
    $months = filter_var($_POST['months'] ?? null, FILTER_VALIDATE_INT);
    if (!preg_match('/^[0-9]{8}$/', $cin) || !in_array($months, [1,3,6,12], true) || $code === '') {
        $error = 'Vérifiez le CIN, le titre et la durée.';
    } else {
        $member = $db->prepare('SELECT cin FROM abonne WHERE cin = ?'); $member->bind_param('s', $cin); $member->execute();
        $title = $db->prepare('SELECT code FROM revue WHERE code = ?'); $title->bind_param('s', $code); $title->execute();
        if (!$member->get_result()->fetch_assoc()) $error = 'Aucun abonné ne correspond à ce CIN.';
        elseif (!$title->get_result()->fetch_assoc()) $error = 'La revue sélectionnée est introuvable.';
        else {
            $start = new DateTimeImmutable('today'); $end = $start->modify('+' . $months . ' months');
            try {
                $stmt = $db->prepare('INSERT INTO abonnement (cin, code, dateabon, dateech) VALUES (?, ?, ?, ?)');
                $startText = $start->format('Y-m-d'); $endText = $end->format('Y-m-d');
                $stmt->bind_param('ssss', $cin, $code, $startText, $endText); $stmt->execute(); $success = true;
            } catch (mysqli_sql_exception $e) {
                if ((int)$e->getCode() === 1062) $error = 'Cet abonnement existe déjà pour cette date.';
                else throw $e;
            }
        }
    }
}
$revues = $db->query('SELECT code, titre, prixmens FROM revue ORDER BY titre');
?>
<!doctype html><html lang="fr"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Nouvel abonnement — Fedi Bibliothèque</title><link rel="stylesheet" href="fedi.css"></head><body><header><a class="brand" href="index.php"><span>F</span> Fedi Bibliothèque</a><nav><a href="index.php">Accueil</a><a href="ajout.php">Créer un compte</a><a href="liste.php">Abonnés</a></nav></header><main class="content"><p class="eyebrow">Choisir une revue</p><h1>Nouvel abonnement</h1><?php if ($error): ?><p class="alert"><?= h($error) ?></p><?php endif; ?><?php if ($success): ?><p class="success">Abonnement enregistré. Vous pouvez consulter la liste pour vérifier l’échéance.</p><?php endif; ?><form method="post"><input type="hidden" name="csrf" value="<?= h(csrf_token()) ?>"><label for="cin">CIN de l’abonné</label><input id="cin" name="cin" inputmode="numeric" pattern="[0-9]{8}" maxlength="8" required value="<?= h($_POST['cin'] ?? '') ?>"><label for="code">Revue</label><select id="code" name="code" required><option value="">Choisir une revue</option><?php while ($r = $revues->fetch_assoc()): ?><option value="<?= h($r['code']) ?>" <?= ($_POST['code'] ?? '') === $r['code'] ? 'selected' : '' ?>><?= h($r['titre']) ?> — <?= number_format((float)$r['prixmens'], 3, ',', ' ') ?> TND/mois</option><?php endwhile; ?></select><label for="months">Durée</label><select id="months" name="months"><option value="1">1 mois</option><option value="3">3 mois</option><option value="6">6 mois</option><option value="12">12 mois</option></select><button class="button">Valider l’abonnement</button></form></main><footer>Fedi Bibliothèque</footer></body></html>