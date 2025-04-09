<?php

require_once __DIR__ . '/../Compte.php';
require_once __DIR__ . '/../../lib/database.php';
class CompteRepository
{
    public DatabaseConnection $connection;

    public function __construct()
    {
        $this->connection = new DatabaseConnection();
    }

    public function getComptes(): array
    {
        $statement = $this->connection->getConnection()->query('SELECT * from comptes');
        $result = $statement->fetchAll();
        $comptes = [];
        foreach ($result as $row) {
            $compte = new Compte();
            $compte->setId($row['id_compte']);       
            $compte->setRib($row['rib']);            
            $compte->setTypeCompte($row['type_compte']);      
            $compte->setSolde($row['solde']);          
            $compte->setClientId($row['client_id']); 

            $comptes[] = $compte;
        }

        return $comptes;
    }
    public function getCompte(int $id): ?Compte
    {
        $statement = $this->connection->getConnection()->prepare("SELECT * FROM comptes WHERE id_compte=:id_compte");
        $statement->execute(['id_compte' => $id]);
        $result = $statement->fetch();

        if (!$result) {
            return null;
        }

        $compte = new Compte();
        $compte->setId($result['id_compte']);       
        $compte->setRib($result['rib']);            
        $compte->setTypeCompte($result['type_compte']);      
        $compte->setSolde($result['solde']);          
        $compte->setClientId($result['client_id']); 

        return $compte;
    }
    public function countComptes(): int
    {
        $stmt = $this->connection->getConnection()->prepare("SELECT COUNT(*) AS total_comptes FROM comptes");
        $stmt->execute();
        $result = $stmt->fetch();
        return (int) $result['total_comptes'];
    }

    public function create(Compte $compte): bool
    {
        $statement = $this->connection
            ->getConnection()
            ->prepare('INSERT INTO comptes (rib, type_compte, solde, client_id) VALUES (:rib, :type_compte, :solde, :client_id);');
       
            return $statement->execute([
                'rib' => $compte->getRib(),
                'type_compte' => $compte->getTypeCompte(),
                'solde' => $compte->getSolde(),
                'client_id' => $compte->getClientId(),
               
            ]);
    }
    public function update(Compte $compte): bool
    {
        $statement = $this->connection
            ->getConnection()
            ->prepare('UPDATE comptes SET rib=:rib, type_compte=:type_compte, solde=:solde, client_id=:client_id WHERE id_compte = :id_compte');
    

            return $statement->execute([
                'id_compte' => $compte->getId(),
                'rib' => $compte->getRib(),
                'type_compte' => $compte->getTypeCompte(),
                'solde' => $compte->getSolde(),
                'client_id' => $compte->getClientId(),
            ]);
    }

    public function delete(int $id)
    {
        $statement = $this->connection
            ->getConnection()
            ->prepare('DELETE FROM comptes WHERE id_compte = :id_compte ');
        $statement->bindParam(':id_compte', $id);

        return $statement->execute();
    }

    // Exemple de méthode dans le CompteRepository
    public function findComptesByClientId($id)
    {
        $query = 'SELECT * FROM comptes WHERE client_id = :id';
        $stmt = $this->connection->getConnection()->prepare($query);
        $stmt->execute(['id' => $id]);
        return $stmt->fetchAll();
    }
    


}