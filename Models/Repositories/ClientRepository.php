<?php

require_once __DIR__ . '/../Client.php';
require_once __DIR__ . '/../../lib/database.php';

//CLASSE GERANT L'ACCES AUX DONNEES LIEES AUX CLIENTS
class ClientRepository
{
    public DatabaseConnection $connection;

    public function __construct()
    {
        $this->connection = new DatabaseConnection();
    }

    public function countClients(): int
    {
        $stmt = $this->connection->getConnection()->prepare("SELECT COUNT(*) AS total FROM clients");
        $stmt->execute();
        $result = $stmt->fetch();
        return (int) $result['total'];
    }

    //CRUD

    //CREATE
    public function create(Client $client): bool
    {
        $statement = $this->connection
            ->getConnection()
            ->prepare('INSERT INTO clients (nom, prenom, mail, telephone, adresse) VALUES (:nom, :prenom, :mail, :telephone, :adresse);');

        // On utilise htmlspecialchars pour sécuriser les données avant l'insertion dans la base de données
        return $statement->execute([
            'nom' => htmlspecialchars($client->getNom()), 
            'prenom' => htmlspecialchars($client->getPrenom()), 
            'mail' => htmlspecialchars($client->getMail()), 
            'telephone' => htmlspecialchars($client->getTelephone()), 
            'adresse' => htmlspecialchars($client->getAdresse()) 
        ]);
    }

    //READ
    public function getClients(): array
    {
        $statement = $this->connection->getConnection()->query('SELECT * from clients');
        $result = $statement->fetchAll();
        $clients = [];
        foreach ($result as $row) {
            $client = new Client();
            $client->setId($row['id_client']);
            $client->setNom(htmlspecialchars($row['nom'])); 
            $client->setPrenom(htmlspecialchars($row['prenom'])); 
            $client->setMail(htmlspecialchars($row['mail']));
            $client->setTelephone(htmlspecialchars($row['telephone'])); 
            $client->setAdresse(htmlspecialchars($row['adresse'])); 

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
        $client->setId($result['id_client']);
        $client->setNom(htmlspecialchars($result['nom']));
        $client->setPrenom(htmlspecialchars($result['prenom'])); 
        $client->setMail(htmlspecialchars($result['mail'])); 
        $client->setTelephone(htmlspecialchars($result['telephone'])); 
        $client->setAdresse(htmlspecialchars($result['adresse'])); 

        return $client;
    }

    //EDIT
    public function update(Client $client): bool
    {
        $statement = $this->connection
            ->getConnection()
            ->prepare('UPDATE clients SET nom=:nom, prenom=:prenom, mail=:mail, telephone=:telephone, adresse=:adresse WHERE id_client = :id_client');

        // On utilise htmlspecialchars pour sécuriser les données avant la mise à jour dans la base de données
        return $statement->execute([
            'id_client' => $client->getId(),
            'nom' => htmlspecialchars($client->getNom()), 
            'prenom' => htmlspecialchars($client->getPrenom()), 
            'mail' => htmlspecialchars($client->getMail()),
            'telephone' => htmlspecialchars($client->getTelephone()), 
            'adresse' => htmlspecialchars($client->getAdresse()) 
        ]);
    }

    //DELETE
    public function delete(int $id)
    {
        $statement = $this->connection
            ->getConnection()
            ->prepare('DELETE FROM clients WHERE id_client = :id_client');
        $statement->bindParam(':id_client', $id);

        return $statement->execute();
    }
}
