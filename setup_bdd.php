<?php
require 'config/db.php';

$pdo->exec("
    CREATE TABLE IF NOT EXISTS utilisateurs (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        pseudo TEXT NOT NULL UNIQUE,
        email TEXT NOT NULL UNIQUE,
        mot_de_passe TEXT NOT NULL,
        date_inscription TEXT DEFAULT CURRENT_TIMESTAMP
    )
");

echo "Table 'utilisateurs' créée avec succès.";