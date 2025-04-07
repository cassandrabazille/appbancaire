<?php

require_once __DIR__ . '/../lib/database.php';

class Client
{
    public int $id;
    public string $nom;
    public string $prenom;
    public string $mail;
    public string $telephone;
    public string $adresse;
}

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
            $client->id = $row['id_client'];
            $client->nom = $row['nom'];
            $client->prenom = $row['prenom'];
            $client->mail = $row['mail'];
            $client->telephone = $row['telephone'];
            $client->adresse = $row['adresse'];

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
        $client->id = $result['id_client'];
        $client->nom = $result['nom'];
        $client->prenom = $result['prenom'];
        $client->mail = $result['mail'];
        $client->telephone = $result['telephone'];
        $client->adresse = $result['adresse'];

        return $client;
    }

    public function create(Client $client): bool
    {
        $statement = $this->connection
            ->getConnection()
            ->prepare('INSERT INTO clients (nom, prenom, mail, telephone, adresse) VALUES (:nom, :prenom, :mail, :telephone, :adresse);');
        $statement->bindParam(':nom', $client->nom);
        $statement->bindParam(':prenom', $client->prenom);
        $statement->bindParam(':mail', $client->mail);
        $statement->bindParam(':telephone', $client->telephone);
        $statement->bindParam(':adresse', $client->adresse);

        return $statement->execute();
    }
    public function update(Client $client): bool
    {
        $statement = $this->connection
            ->getConnection()
            ->prepare('UPDATE clients SET :nom, :prenom, :mail, :telephone, :adresse WHERE id_client = :id_client');
        $statement->bindParam(':nom', $client->nom);
        $statement->bindParam(':prenom', $client->prenom);
        $statement->bindParam(':mail', $client->mail);
        $statement->bindParam(':telephone', $client->telephone);
        $statement->bindParam(':adresse', $client->adresse);

        return $statement->execute();
    }

    public function delete(int $id)
    {
        $statement = $this->connection
            ->getConnection()
            ->prepare('DELETE FROM clients WHERE id_client = :id_client');
        $statement->bindParam(':id', $id);

        return $statement->execute();
    }
}


