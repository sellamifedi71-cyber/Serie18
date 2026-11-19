# Fedi Bibliothèque — Gestion des abonnements

Application PHP/MySQL pour enregistrer des abonnés, gérer leurs abonnements à des revues et consulter les dates d'échéance.

## Fonctionnalités
- Création d'abonnés avec validation du CIN et de l'e-mail
- Création d'abonnements avec durée de 1, 3, 6 ou 12 mois
- Liste des abonnements et statut actif/expiré
- Requêtes préparées, échappement HTML et protection CSRF sur les formulaires

## Installation locale
1. Démarrer Apache et MySQL avec XAMPP, WAMP ou équivalent.
2. Créer/importer la base `bdabon` en important `bdabon.sql` dans phpMyAdmin.
3. Vérifier les identifiants dans `config.php`.
4. Placer le dossier dans le répertoire web local et ouvrir `index.php`.

## Stack
PHP 8+, MySQL/MariaDB, HTML et CSS.

## Sécurité et limites
Cette version est destinée à un environnement local de démonstration. Avant une mise en production, créer un compte MySQL à privilèges limités, activer HTTPS, ajouter authentification/autorisation administrateur, journalisation et sauvegardes. Les données de démonstration du dump doivent être remplacées.

Brand: Fedi.
