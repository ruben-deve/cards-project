<?php
require 'config/db.php';

$pdo->exec("

    CREATE TABLE IF NOT EXISTS utilisateurs (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        pseudo TEXT NOT NULL UNIQUE,
        email TEXT NOT NULL UNIQUE,
        mot_de_passe TEXT NOT NULL,
        date_inscription TEXT DEFAULT CURRENT_TIMESTAMP
    );


    CREATE TABLE IF NOT EXISTS collection (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        utilisateur_id INTEGER NOT NULL,
        carte_id INTEGER NOT NULL,
        nom TEXT NOT NULL,
        image TEXT,
        race TEXT,
        affiliation TEXT,
        description TEXT,
        date_obtention TEXT DEFAULT CURRENT_TIMESTAMP,

        FOREIGN KEY(utilisateur_id) REFERENCES utilisateurs(id)
    );


    CREATE TABLE IF NOT EXISTS ouvertures_booster (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        utilisateur_id INTEGER NOT NULL,
        date_ouverture TEXT DEFAULT CURRENT_TIMESTAMP,

        FOREIGN KEY(utilisateur_id) REFERENCES utilisateurs(id)
    );

");

echo "Tables créées avec succès.";