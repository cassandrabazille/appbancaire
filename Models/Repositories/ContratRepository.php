<?php

require_once __DIR__ . '/../Contrat.php';
require_once __DIR__ . '/../Client.php';
require_once __DIR__ . '/../../lib/database.php';

//CLASSE GERANT L'ACCES AUX DONNEES LIEES AUX CONTRATS
class ContratRepository
{
    public DatabaseConnection $connection;

    public function __construct()
    {
        $this->connection = new DatabaseConnection();
    }


//CRUD

//CREATE
    public function create(Contrat $contrat): bool
    {
        $statement = $this->connection
            ->getConnection()
            ->prepare('INSERT INTO contrats (type_contrat, montant, duree, client_id) VALUES (:type_contrat, :montant,:duree, :client_id);');
       
            return $statement->execute([
                'type_contrat' => $contrat->getTypeContrat(),
                'montant' => $contrat->getMontant(),
                'duree' => $contrat->getDuree(),
                'client_id' => $contrat->getClientId(),
               
            ]);
    }

    //READ
    public function getContrats(): array
    {
        $statement = $this->connection->getConnection()->query('SELECT * from contrats');
        $result = $statement->fetchAll();
        $contrats = [];
        $clientrepo = new ClientRepository();
        foreach ($result as $row) {
            $contrat = new Contrat();
            $contrat->setId($row['id_contrat']);       
            $contrat->setTypeContrat($row['type_contrat']);            
            $contrat->setMontant($row['montant']);      
            $contrat->setDuree($row['duree']);          
            $contrat->setClientId($row['client_id']);

            $client = $clientrepo->getClient($row['client_id']);
            if ($client) {
                $contrat->setClient($client);  
            }
    
            $contrats[] = $contrat;
        }

        return $contrats;
    }
    public function getContrat(int $id): ?Contrat
    {
        $statement = $this->connection->getConnection()->prepare("SELECT * FROM contrats WHERE id_contrat=:id_contrat");
        $statement->execute(['id_contrat' => $id]);
        $result = $statement->fetch();

        if (!$result) {
            return null;
        }

        $contrat = new Contrat();
        $contrat->setId($result['id_contrat']);       
        $contrat->setTypeContrat($result['type_contrat']);            
        $contrat->setMontant($result['montant']);      
        $contrat->setDuree($result['duree']);          
        $contrat->setClientId($result['client_id']); 

        return $contrat;
    }
    public function countContrats(): int
    {
        $stmt = $this->connection->getConnection()->prepare("SELECT COUNT(*) AS total_contrats FROM contrats");
        $stmt->execute();
        $result = $stmt->fetch();
        return (int) $result['total_contrats'];
    }

    //UPDATE
    public function update(Contrat $contrat): bool
    {
        $statement = $this->connection
            ->getConnection()
            ->prepare('UPDATE contrats SET montant=:montant, duree=:duree WHERE id_contrat = :id_contrat');
    

            return $statement->execute([
                'id_contrat' => $contrat->getId(),
                'montant' => $contrat->getMontant(),
                'duree' => $contrat->getDuree(),
            ]);
    }

    //DELETE

    public function delete(int $id)
    {
        $statement = $this->connection
            ->getConnection()
            ->prepare('DELETE FROM contrats WHERE id_contrat = :id_contrat ');
        $statement->bindParam(':id_contrat', $id);

        return $statement->execute();
    }


    // public function findContratsByClientId($id)
    // {
    //     $query = 'SELECT * FROM contrats WHERE client_id = :id';
    //     $stmt = $this->connection->getConnection()->prepare($query);
    //     $stmt->execute(['id' => $id]);
    //     return $stmt->fetchAll();
    // }

}