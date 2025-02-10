API Lorcana
Configuration du projet
Cloner le dépôt
Clone le dépôt Git et accède au dossier du projet :
git clone [URL_DU_REPO]
cd lorcanaexam

Installation de l'environnement Docker
Exécute cette commande pour installer les dépendances PHP avec Docker :

docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php84-composer:latest \
    composer install --ignore-platform-reqs

Démarrer le serveur
Lance le serveur avec Sail :
sail up -d

Générer la clé d’application
Exécute cette commande pour générer la clé de l'application Laravel :
sail artisan key:generate

Installer Breeze et Sanctum
Installe Laravel Breeze pour l'authentification et Sanctum pour la gestion des tokens :
sail artisan breeze:install
sail composer require laravel/sanctum

Configurer la base de données
N'oublie pas de connecter ta base de données et de lancer les migrations :
sail artisan migrate

Importer les Sets et les Cartes
Exécute cette commande pour récupérer les Sets et les Cartes dans ta base de données :
sail artisan app:import-data

(Optionnel) Générer des utilisateurs aléatoires
Décommente la ligne suivante dans /seeders/DatabaseSeeder.php pour générer 10 utilisateurs aléatoires avec leurs wishlists et cartes associées :
User::factory(10)->create();
Ensuite, exécute la commande suivante pour peupler ta base de données :
sail artisan db:seed

Redémarrer le serveur
Si nécessaire, tu peux redémarrer le serveur avec cette commande :
sail up -d


Instructions API
Pour tester l'API, utilise un outil comme Insomnia ou Postman.

Tester un endpoint
Renseigne l'endpoint que tu souhaites tester, par exemple http://localhost/api/me/cards.
Spécifie si la requête est en GET ou POST.

Requêtes en POST
Lorsque tu fais des requêtes en POST, n'oublie pas d'inclure un body en format JSON. Exemple pour l'authentification :
{
    "name": "test",
    "email": "test@example.com",
    "password": "test1234"
}

Authentification
Lors de l'utilisation des endpoints /api/login ou /api/register pour l'authentification, après avoir envoyé la requête, tu recevras un message avec un token d'authentification. Pour rester connecté et effectuer d'autres requêtes, tu devras :

Récupérer le token.
Ajouter une nouvelle en-tête dans Postman/Insomnia avec :
Key : Authorization
Value : Bearer <ton_token>
Cela te permettra de rester connecté et de tester les autres endpoints de manière sécurisée.

Conclusion
L'API Lorcana est maintenant prête à être utilisée.  🚀


PS: pour acceder au information d'un utilisateur je n'utilise pas l'endpoint : GET /me mais plutot GET /user.
A pars ce changement tout le reste est normalement conforme.



