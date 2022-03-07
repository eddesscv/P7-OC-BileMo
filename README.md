# P7-OC-BileMo

[![SymfonyInsight](https://insight.symfony.com/projects/479002c1-63aa-4221-a31f-28e30e012056/big.svg)](https://insight.symfony.com/projects/479002c1-63aa-4221-a31f-28e30e012056/analyses/20)

Créez un web service exposant une API

## Environnement de développement
- Symfony 5.2.2
- Composer 2.2.5
- Bootstrap 5.0.2
- jQuery 3.3.1
- PHPUnit 9.5
- WampServer 3.1.6
    - Apache 2.4.51
    - PHP 7.4.26
    - MySQL 8.0.27


## Installation
Clonez ou téléchargez le repository GitHub dans le dossier voulu :

    https://github.com/eddesscv/P7-OC-BileMo.git
Configurez vos variables d'environnement telles que la connexion à la base de données .env.

Téléchargez et installez les dépendances back-end du projet avec Composer :

    composer install
Créer la base de données si elle n'existe pas déjà, taper la commande ci-dessous en vous plaçant dans le répertoire du projet :

    php bin/console doctrine:database:create
    php bin/console doctrine:schema:create
Créez les fixtures vous permettant de tester :

    php bin/console doctrine:fixtures:load
Accédez à l'aide de l'API : 127.0.0.1:8000/api (en fonction de l'adresse d'hébergement de l'API)

Se connecter et obtenir un token : Requête GET sur http://127.0.0.1:8000/api/login, body {"username": "clientsfr@client.com", "password": "clientsfr"}
