<?php

class DatabaseConnection
{
    public ?\PDO $database = null;

    public function getConnection(): PDO
    {
        // Vérifier si la connexion est déjà établie
        if ($this->database == null) {
            // Récupérer les variables d'environnement (préférer utiliser un fichier .env pour la sécurité)
            $host = getenv('DB_HOST') ?: 'localhost';  
            $dbname = getenv('DB_NAME') ?: 'appbancaire';
            $username = getenv('DB_USER') ?: 'root';
            $password = getenv('DB_PASSWORD') ?: '';
            $charset = 'utf8mb4';

            // Construire le DSN de connexion
            $dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";

            // Options pour la gestion des erreurs et du mode de récupération des données
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,  
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,  
            ];

            try {
                // Tentative de connexion à la base de données
                $this->database = new PDO($dsn, $username, $password, $options);
            } catch (PDOException $e) {
                // Gestion des erreurs : enregistrement dans un fichier de log au lieu de tuer l'exécution
                error_log("Erreur de connexion à la base de données : " . $e->getMessage(), 3, __DIR__ . '/error_log.txt');
                die('Erreur de connexion à la base de données. Veuillez réessayer plus tard.');
            }
        }
        
        // Retourne l'objet PDO de la connexion
        return $this->database;
    }
}
















