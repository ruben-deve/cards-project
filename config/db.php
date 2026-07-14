<?php
// chemin vers fichier SQLite : créé automatiquement si n'existe pas encore
$cheminBDD = __DIR__ . '/../database/cartes.sqlite';

try {
    $pdo = new PDO('sqlite:' . $cheminBDD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // contraintes de clés étrangères
    $pdo->exec('PRAGMA foreign_keys = ON');
} catch (PDOException $e) {
    die('Erreur de connexion à la base de données : ' . $e->getMessage());
}