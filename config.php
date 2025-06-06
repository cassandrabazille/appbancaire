<?php

session_start();


// Détection du mode démo via la session
$modeDemo = isset($_SESSION['modeDemo']) && $_SESSION['modeDemo'] === true;

if ($modeDemo) {
    // Connexion à la base de données de démo
    $dbHost = 'localhost';
    $dbName = 'ma_base_demo';  // Nom de la base de données démo
    $dbUser = 'user';
    $dbPassword = 'password';
} else {
    // Connexion à la base de données de production
    $dbHost = 'localhost';
    $dbName = 'ma_base_production';  // Nom de la base de données de production
    $dbUser = 'user';
    $dbPassword = 'password';
}

try {
    // Connexion PDO
    $connection = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPassword);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Erreur de connexion : ' . $e->getMessage();
}

