<?php

class DatabaseConnection
{
    public ?\PDO $database = null;

 public function getConnection(): PDO
{
    if ($this->database == null) {
        // Démarrer la session si elle n'est pas déjà active
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Récupérer les variables d'environnement
        $host = getenv('DB_HOST') ?: 'localhost';
        $username = getenv('DB_USER') ?: 'root';
        $password = getenv('DB_PASSWORD') ?: '';
        $charset = 'utf8mb4';

        // Choisir la base de données selon le mode (démo ou prod)
        if (!empty($_SESSION['modeDemo'])) {
            $dbname = 'demo_appbancaire'; // ← nom correct de ta base de démonstration
        } else {
            $dbname = getenv('DB_NAME') ?: 'appbancaire'; // ← base de prod par défaut
        }

        // Construire le DSN
        $dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";

        // Options PDO
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ];

        try {
            $this->database = new PDO($dsn, $username, $password, $options);
        } catch (PDOException $e) {
            error_log("Erreur de connexion à la base de données : " . $e->getMessage(), 3, __DIR__ . '/error_log.txt');
            die('Erreur de connexion à la base de données. Veuillez réessayer plus tard.');
        }
    }

    return $this->database;
}
}














