<?php

require_once __DIR__ . '/../lib/database.php';

class Compte
{
    private int $id;
    private string $rib;
    private string $typecompte;
    private string $solde;
    private string $clientId;


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

public function getSolde(): string
{
    return $this->solde;
}

public function getClientId(): string
{
    return $this->clientId;
}

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

public function setSolde(string $solde): void
{
    $this->solde = htmlspecialchars($solde);
}

public function setClientId(string $clientId): void
{
    $this->clientId = htmlspecialchars($clientId);
}

}
