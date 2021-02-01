# Api CRM pour entraînement RxJS

- Cloner le repo : `git clone https://github.com/liorchamla/crm-api.git` dans le dossier de votre choix
- Rendez vous dans le dossier et installez les dépendances : `composer install`
- Modifiez le fichier .env pour paramétrer la base de données
- Créez la base de données : `php bin/console d:d:c`
- Lancez la migration : `php bin/console d:m:m -n`
- Lancez les fixtures : `php bin/console d:f:l -n`
- Lancez le serveur : `php -S localhost:8000 -t public` ou `symfony serve --allow-http`
- Lancez dans le navigateur : http://localhost:8000/api
