<?php

class DatabaseConnection
{
    public ?\PDO $database = null;

    public function getConnection(): PDO
    {
        if ($this->database === null) {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            if (!empty($_SESSION['modeDemo'])) {
                // Connexion PostgreSQL en mode demo
                $databaseUrl = getenv('DATABASE_URL');

                if ($databaseUrl) {
                    $dbopts = parse_url($databaseUrl);
                    $host = $dbopts["host"];
                    $port = $dbopts["port"];
                    $username = $dbopts["user"];
                    $password = $dbopts["pass"];
                    $dbname = ltrim($dbopts["path"], '/');

                    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname";
                } else {
                    $host = getenv('DB_HOST') ?: 'localhost';
                    $username = getenv('DB_USER') ?: 'postgres';
                    $password = getenv('DB_PASSWORD') ?: '';
                    $dbname = 'demo_appbancaire';
                    $dsn = "pgsql:host=$host;port=5432;dbname=$dbname";
                }
            } else {
                // Connexion MySQL en mode production/admin
                $host = getenv('DB_HOST') ?: 'localhost';
                $username = getenv('DB_USER') ?: 'root';
                $password = getenv('DB_PASSWORD') ?: '';
                $charset = 'utf8mb4';
                $dbname = getenv('DB_NAME') ?: 'appbancaire';

                $dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";
            }

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











