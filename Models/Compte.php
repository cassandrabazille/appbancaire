<?php

require_once __DIR__ . '/../lib/database.php';

//INSTANCIATION DE LA CLASSE COMPTE
class Compte
{
    private int $id;
    private string $rib;
    private string $typecompte;
    private float $solde;
    private int $clientId;

    private ?Client $client = null; 

    //GETTERS
    public function getId(): int
    {
        return $this->id;
    }

    public function getRib(): string
    {
        return $this->rib;
    }

    public function getTypeCompte(): string
    {
        return $this->typecompte;
    }

    public function getSolde(): float
    {
        return $this->solde;
    }

    public function getClientId(): int
    {
        return $this->clientId;
    }

    //SETTERS
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setRib(string $rib): void
    {
        $this->rib = htmlspecialchars($rib);
    }

    public function setTypeCompte(string $typecompte): void
    {
        $this->typecompte = htmlspecialchars($typecompte);
    }

    public function setSolde(float $solde): void
    {
        $this->solde = $solde;
    }

    public function setClientId(int $clientId): void
    {
        $this->clientId = $clientId;
    }

        // Getter pour l'objet Client
        public function getClient(): ?Client
        {
            return $this->client;
        }
    
        // Setter pour l'objet Client
        public function setClient(Client $client): void
        {
            $this->client = $client;
        }

}
