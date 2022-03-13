# P7-OC-BileMo

[![SymfonyInsight](https://insight.symfony.com/projects/58d88bf9-9db3-4f3e-ab42-eedb384ff658/big.svg)](https://insight.symfony.com/projects/58d88bf9-9db3-4f3e-ab42-eedb384ff658/analyses/25)

Créez un web service exposant une API

## Environnement de développement
- Symfony 5.2.2
- Composer 2.2.5
- LexikJWTAuthenticationBundle 2.14
- ApiPlatform 2.6
- JMSSerializerBundle 4.0
- NelmioApiDocBundle 4.8
- BazingaHateoasBundle
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
Générer une clé SSH d'authentification JWT (Documentation officiel):

    mkdir -p config/jwt
    openssl genrsa -out config/jwt/private.pem -aes256 4096
    openssl rsa -pubout -in config/jwt/private.pem -out config/jwt/public.pem
    
    ou
    
    php bin/console lexik:jwt:generate-keypair
Accédez à l'aide de l'API : 127.0.0.1:8000/api (en fonction de l'adresse d'hébergement de l'API)

Se connecter et obtenir un token : 
    
    Requête POST sur http://127.0.0.1:8000/api/login
    Body: 
    {
        "username" : "SFR",
        "password" : "Admin1@"
    }
    
Pour tester tes endpoints dans le navigateur avec l'interface de swagger (ApiPlatform):
Un bouton Authorize va s'afficher sur l'interface.
Et pour renseigner le token:
    Il faut toujours saisir Bearer puis coller le token juste après:
    
    earer yJ0eXAiOiJKV1QiLCJhbGciOiJS....
