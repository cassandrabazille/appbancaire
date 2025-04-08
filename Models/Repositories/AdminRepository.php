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

    public function getAdminbyMail(string $mail): ?Admin
    {
        $statement = $this->connection->getConnection()->prepare('SELECT * FROM admin WHERE mail = :mail');
        $statement->execute(['mail' => $mail]);

        $result = $statement->fetch();

        if (!$result) {
            return null;
        }

        $admin = new Admin();
        $admin->setId($result['id_admin']);
        $admin->setMail($result['mail']);
        $admin->setMdp($result['mdp']);
        return $admin;
    }
}