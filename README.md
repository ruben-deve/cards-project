-DragonBall-CardZ

*Présentation

DragonBall-CardZ est une application web permettant de consulter des cartes de personnages de Dragon Ball, de créer un compte utilisateur et de constituer sa propre collection.
Les données des personnages proviennent de l'API publique Dragon Ball, tandis que les informations des utilisateurs et de leur collection sont stockées dans une base de données SQLite.

**Technologies utilisées

*Front-end

- HTML5
- CSS3
- JavaScript

*Back-end

- PHP 8

*Base de données

- SQLite

Serveur local

- XAMPP (Apache + PHP)

*API

https://dragonball-api.com



*Installation

1. Installer XAMPP

Télécharger XAMPP :

https://www.apachefriends.org/

Installer au minimum :

- Apache
- PHP

SQLite est directement pris en charge par PHP, aucune installation supplémentaire n'est nécessaire.



2. Copier le projet

Copiez le dossier du projet dans :

C:\xampp\htdocs\


3. Démarrer Apache

Ouvrir le panneau de contrôle XAMPP.

Cliquer sur :
Start


4. Ouvrir le projet

Dans le navigateur : http://localhost/project-cards


*Base de données SQLite

Le projet utilise une base SQLite.
Aucun serveur MySQL n'est nécessaire.
La base est créée automatiquement grâce au script PHP prévu à cet effet.


*Authentification

Les pages protégées utilisent un système de session PHP.
Si un utilisateur tente d'accéder à une page protégée sans être connecté, il est automatiquement redirigé vers la page de connexion.