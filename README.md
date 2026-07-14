# DragonBall-CardZ

## Présentation

DragonBall-CardZ est une application web permettant de consulter des cartes de personnages de Dragon Ball, de créer un compte utilisateur et de constituer sa propre collection.

Les données des personnages proviennent de l'API publique Dragon Ball, tandis que les informations des utilisateurs et de leur collection sont stockées dans une base de données SQLite.

## Fonctionnalités

- Consultation de l'ensemble des cartes Dragon Ball
- Détails d'une carte
- Création de compte
- Connexion / Déconnexion
- Espace profil
- Collection personnelle
- Ouverture de boosters (5 cartes aléatoires)
- Limitation d'une ouverture de booster toutes les 24 heures
- Recherche de cartes
- Filtrage des cartes par race
- Interface responsive avec menu hamburger

---

## Technologies utilisées

### Front-end

- HTML5
- CSS3
- JavaScript

### Back-end

- PHP 8

### Base de données

- SQLite

### Serveur local

- XAMPP (Apache + PHP)

### API

https://dragonball-api.com

---

# Installation

## 1. Installer XAMPP

Télécharger XAMPP :

https://www.apachefriends.org/

Installer au minimum :

- Apache
- PHP

SQLite est directement pris en charge par PHP, aucune installation supplémentaire n'est nécessaire.

---

## 2. Copier le projet

Copiez le dossier du projet dans :

```
C:\xampp\htdocs\
```

Exemple :

```
C:\xampp\htdocs\project-cards
```

---

## 3. Démarrer Apache

Ouvrir le panneau de contrôle XAMPP.

Cliquer sur :

```
Start
```

en face de :

```
Apache
```

---

## 4. Ouvrir le projet

Dans le navigateur :

```
http://localhost/project-cards
```

---

# Base de données SQLite

Le projet utilise une base SQLite.

Aucun serveur MySQL n'est nécessaire.

La base est créée automatiquement grâce au script PHP prévu à cet effet.

Les principales tables sont :

## utilisateurs

Stocke les comptes utilisateurs.

| Champ | Description |
|--------|-------------|
| id | Identifiant |
| pseudo | Nom d'utilisateur |
| email | Adresse mail |
| mot_de_passe | Mot de passe hashé |
| date_inscription | Date d'inscription |

---


# Fonctionnement des boosters

Lorsqu'un utilisateur ouvre un booster :

1. Vérification qu'il est connecté.
2. Vérification que 24 heures se sont écoulées depuis la dernière ouverture.
3. Récupération des personnages via l'API Dragon Ball.
4. Sélection aléatoire de 5 cartes.
5. Enregistrement des cartes dans la table `collection`.
6. Enregistrement de la date d'ouverture dans `ouvertures_booster`.

---

# Authentification

Les pages protégées utilisent un système de session PHP.
Si un utilisateur tente d'accéder à une page protégée sans être connecté, il est automatiquement redirigé vers la page de connexion.

---

# Arborescence du projet

```
project-cards/

│
├── config/
│   ├── auth.php
│   └── db.php
│
├── css/
│
├── js/
│
├── index.php
├── profil.php
├── connexion.php
├── inscription.php
├── carte-details.php
│
└── database.sqlite
```

---

# Auteur

Projet réalisé dans le cadre de la formation Axe Coding – Digital Innovation.