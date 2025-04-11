<?php

require_once __DIR__ . '/../lib/database.php';

//INSTANCIATION DE LA CLASSE CONTRAT
class Contrat
{
    private int $id_contrat;
    private string $type_contrat;
    private float $montant;
    private int $duree;
    private int $clientId;

    private ?Client $client = null;

    //GETTERS
    public function getId(): int
    {
        return $this->id_contrat;
    }

    public function getTypeContrat(): string
    {
        return $this->type_contrat;
    }

    public function getMontant(): float
    {
        return $this->montant;
    }

    public function getDuree(): int
    {
        return $this->duree;
    }

    public function getClientId(): string
    {
        return $this->clientId;
    }

    //SETTERS
    public function setId(int $id): void
    {
        $this->id_contrat = $id;
    }

    public function setTypeContrat(string $type_contrat): void
    {
        $this->type_contrat = htmlspecialchars($type_contrat);
    }

    public function setMontant(float $montant): void
    {
        $this->montant = $montant;
    }

    public function setDuree(int $duree): void
    {
        $this->duree = $duree;
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
