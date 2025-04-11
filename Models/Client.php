<?php

require_once __DIR__ . '/../lib/database.php';

//INSTANCIATION DE LA CLASSE CLIENT
class Client
{
    private int $id;
    private string $nom;
    private string $prenom;
    private string $mail;
    private string $telephone;
    private string $adresse;

    //GETTERS
    public function getId(): int
    {
        return $this->id;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function getPrenom(): string
    {
        return $this->prenom;
    }

    public function getMail(): string
    {
        return $this->mail;
    }

    public function getTelephone(): string
    {
        return $this->telephone;
    }

    public function getAdresse(): string
    {
        return $this->adresse;
    }

    //SETTERS

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setNom(string $nom): void
    {
        $this->nom = htmlspecialchars($nom);
    }

    public function setPrenom(string $prenom): void
    {
        $this->prenom = htmlspecialchars($prenom);
    }

    public function setMail(string $mail): void
    {
        $this->mail = htmlspecialchars($mail);
    }

    public function setTelephone(string $telephone): void
    {
        $this->telephone = htmlspecialchars($telephone);
    }

    public function setAdresse(string $adresse): void
    {
        $this->adresse = htmlspecialchars($adresse);
    }

}
