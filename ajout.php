<?php
declare(strict_types=1);
require __DIR__ . '/config.php';
$error = ''; $success = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();
    $cin = trim((string)($_POST['cin'] ?? ''));
    $nom = trim((string)($_POST['nom'] ?? ''));
    $prenom = trim((string)($_POST['prenom'] ?? ''));
    $adresse = trim((string)($_POST['adresse'] ?? ''));
    $email = trim((string)($_POST['email'] ?? ''));
    if (!preg_match('/^[0-9]{8}$/', $cin) || $nom === '' || mb_strlen($nom) > 20 || $prenom === '' || mb_strlen($prenom) > 20 || $adresse === '' || mb_strlen($adresse) > 50 || !filter_var($email, FILTER_VALIDATE_EMAIL) || mb_strlen($email) > 50) {
        $error = 'Vérifiez le CIN (8 chiffres), le nom, le prénom, l’adresse et l’e-mail.';
    } else {
        try {
            $stmt = $db->prepare('INSERT INTO abonne (cin, nom, prenom, adress, email) VALUES (?, ?, ?, ?, ?)');
            $stmt->bind_param('sssss', $cin, $nom, $prenom, $adresse, $email);
            $stmt->execute(); $success = true;
        } catch (mysqli_sql_exception $e) {
            if ((int)$e->getCode() === 1062) $error = 'Un abonné avec ce CIN existe déjà.';
            else throw $e;
        }
    }
}
?>
<!doctype html><html lang="fr"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Créer un abonné — Fedi Bibliothèque</title><link rel="stylesheet" href="fedi.css"></head><body><header><a class="brand" href="index.php"><span>F</span> Fedi Bibliothèque</a><nav><a href="index.php">Accueil</a><a href="abonnement.php">Abonnement</a><a href="liste.php">Abonnés</a></nav></header><main class="content"><p class="eyebrow">Nouveau membre</p><h1>Créer un abonné</h1><?php if ($error): ?><p class="alert"><?= h($error) ?></p><?php endif; ?><?php if ($success): ?><p class="success">Abonné enregistré avec succès.</p><?php endif; ?><form method="post"><input type="hidden" name="csrf" value="<?= h(csrf_token()) ?>"><label for="cin">CIN (8 chiffres)</label><input id="cin" name="cin" inputmode="numeric" pattern="[0-9]{8}" maxlength="8" required value="<?= h($_POST['cin'] ?? '') ?>"><label for="nom">Nom</label><input id="nom" name="nom" maxlength="20" required value="<?= h($_POST['nom'] ?? '') ?>"><label for="prenom">Prénom</label><input id="prenom" name="prenom" maxlength="20" required value="<?= h($_POST['prenom'] ?? '') ?>"><label for="adresse">Adresse</label><input id="adresse" name="adresse" maxlength="50" required value="<?= h($_POST['adresse'] ?? '') ?>"><label for="email">E-mail</label><input id="email" name="email" type="email" maxlength="50" required value="<?= h($_POST['email'] ?? '') ?>"><button class="button">Enregistrer l’abonné</button></form></main><footer>Fedi Bibliothèque</footer></body></html>