<?php

require_once __DIR__ . '/../../lib/database.php';
require_once __DIR__ . '/../Admin.php';

class AdminRepository
{
    public DatabaseConnection $connection;

    public function __construct()
    {
        $this->connection = new DatabaseConnection();
    }

    // Recherche un administrateur par son adresse email
    public function getAdminbyMail(string $mail): ?Admin
    {
        // Utilisation de `prepare` pour éviter les injections SQL
        $statement = $this->connection->getConnection()->prepare('SELECT * FROM admin WHERE mail = :mail');
        
        // Exécution de la requête avec liaison sécurisée de l'email
        $statement->execute(['mail' => $mail]);

        // Récupération des résultats sous forme de tableau associatif
        $result = $statement->fetch(PDO::FETCH_ASSOC);

        // Si aucun résultat trouvé, on retourne null
        if (!$result) {
            return null;
        }

        // Création de l'objet Admin avec les données récupérées
        $admin = new Admin();
        $admin->setId($result['id_admin']);
        $admin->setMail($result['mail']);
        $admin->setMdp($result['mdp']);

        return $admin;
    }
}
