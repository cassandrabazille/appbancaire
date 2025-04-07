<?php

require_once __DIR__ . '/../Client.php';
require_once __DIR__ . '/../../lib/database.php';
class ClientRepository
{

    public DatabaseConnection $connection;

    public function __construct()
    {
        $this->connection = new DatabaseConnection();
    }

    public function getClients(): array
    {
        $statement = $this->connection->getConnection()->query('SELECT * from clients');
        $result = $statement->fetchAll();
        $tasks = [];
        foreach ($result as $row) {
            $client = new Client();
            $client->setId = $row['id_client'];
            $client->setNom = $row['nom'];
            $client->setPrenom = $row['prenom'];
            $client->setMail = $row['mail'];
            $client->setTelephone = $row['telephone'];
            $client->setAdresse = $row['adresse'];

            $clients[] = $client;

        }

        return $clients;
    }
    public function getClient(int $id): ?Client
    {
        $statement = $this->connection->getConnection()->prepare("SELECT * FROM clients WHERE id_client=:id_client");
        $statement->execute(['id_client' => $id]);
        $result = $statement->fetch();

        if (!$result) {
            return null;
        }

        $client = new Client();
        $client->setId = $result['id_client'];
        $client->setNom = $result['nom'];
        $client->setPrenom = $result['prenom'];
        $client->setMail = $result['mail'];
        $client->setTelephone = $result['telephone'];
        $client->setAdresse = $result['adresse'];

        return $client;
    }

    public function create(Client $client): bool
    {
        $statement = $this->connection
            ->getConnection()
            ->prepare('INSERT INTO clients (nom, prenom, mail, telephone, adresse) VALUES (:nom, :prenom, :mail, :telephone, :adresse);');
       
            return $statement->execute([
                'nom' => $client->getNom(),
                'prenom' => $client->getPrenom(),
                'mail' => $client->getMail(),
                'telephone' => $client->getTelephone(),
                'adresse' => $client->getAdresse(),
            ]);
    }
    public function update(Client $client): bool
    {
        $statement = $this->connection
            ->getConnection()
            ->prepare('UPDATE clients SET :nom, :prenom, :mail, :telephone, :adresse WHERE id_client = :id_client');
    

            return $statement->execute([
                'id' => $client->getId(),
                'nom' => $client->getNom(),
                'prenom' => $client->getPrenom(),
                'mail' => $client->getMail(),
                'telephone' => $client->getTelephone(),
                'adresse' => $client->getAdresse(),
            ]);
    }

    public function delete(int $id)
    {
        $statement = $this->connection
            ->getConnection()
            ->prepare('DELETE FROM clients WHERE id_client = :id_client');
        $statement->bindParam(':id_client', $id);

        return $statement->execute();
    }
}