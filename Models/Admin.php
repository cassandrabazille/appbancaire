<?php

class Admin
{
    private int $id;
    private string $mail;
    private string $mdp;


    public function getId()
    {
        return $this->id;
    }
    public function getMail()
    {
        return $this->mail;
    }
    public function getMdp()
    {
        return $this->mdp;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function setMail(string $mail)
    {
        $this->mail = $mail;
    }

    public function setMdp(string $mdp)
    {
        $this->mdp = $mdp;
    }

}