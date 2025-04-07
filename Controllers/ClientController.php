<?php

require_once __DIR__ . '/../models/repositories/TaskRepository.php';
require_once __DIR__ . '/../models/Task.php';

class ClientController
{
    private ClientRepository $clientrepo;

    public function __construct()
    {
        $this->clientrepo = new ClientRepository();
    }

    public function home()
    {
        $client = $this->clientrepo->getClients();

        require_once __DIR__ . '/../Views/home.php';
    }

    public function show(int $id) 
    {
        $client = $this->clientrepo->getClient($id);

        require_once __DIR__ . '/../Views/view-task.php';
    }

    public function create()
    {
        require_once __DIR__ . '/../Views/create.php';
    }

    public function store()
    {
        $client = new Client();
        $client->setNom($_POST['nom']);
        $client->setPrenom($_POST['prenom']);
        $client->setMail($_POST['mail']);
        $client->setTelephone($_POST['telephone']);
        $client->setAdresse($_POST['adresse']);
        $this->clientrepo->create($client);

        header('Location: ?');
    }

    public function edit(int $id)
    {
        $client = $this->clientrepo->getClient($id);
        require_once __DIR__ . '/../Views/edit.php';
    }

    public function update()
    {
        $client = new Client();
        $client->setId($_POST['id_client']);
        $client->setNom($_POST['nom']);
        $client->setPrenom($_POST['prenom']);
        $client->setMail($_POST['mail']);
        $client->setTelephone($_POST['telephone']);
        $client->setAdresse($_POST['adresse']);
        $this->clientrepo->update($client);

        header('Location: ?');
    }

    public function delete(int $id)
    {
        $this->clientrepo->delete($id);

        header('Location: ?');
    }

    public function forbidden()
    {
        require_once __DIR__ . '/../views/404.php';
        http_response_code(404);
    }
}