<?php

require_once __DIR__ . '/../Models/Repositories/ClientRepository.php';
require_once __DIR__ . '/../Models/Client.php';

class ClientController
{
    private ClientRepository $clientrepo;

    public function __construct()
    {
        $this->clientrepo = new ClientRepository();
    }

    public function showList()
    {
        if (!isset($_SESSION['id_admin'])) {
            header('Location: ?action=login');
            exit;
        }

        $clients = $this->clientrepo->getClients();

        require_once __DIR__ . '/../Views/client-list.php';
    }

    public function dashboard()
    {
        if (!isset($_SESSION['id_admin'])) {
            header('Location: ?action=login');
            exit;
        }
    
        $totalClients = $this->clientrepo->countClients();
        require_once __DIR__ . '/../Views/home.php';
    }
    

    public function show(int $id) 
    {
        $client = $this->clientrepo->getClient($id);

        require_once __DIR__ . '/../Views/client-view.php';
    }

    public function showDetails(): void
{
    if (!isset($_GET['id_client']) || !is_numeric($_GET['id_client'])) {
        // Redirection ou message d'erreur si l'ID est invalide
        header('Location: ?action=showList');
        exit;
    }

    $id = (int)$_GET['id_client'];
    $client = $this->clientrepo->getClient($id);

    if (!$client) {
        // Gérer l'erreur si aucun client trouvé
        echo "Client non trouvé.";
        return;
    }

    require __DIR__ . '/../views/client-view.php';
}


    public function create()
    {
        require_once __DIR__ . '/../Views/client-create.php';
    }

    public function store()
    {
        if (!filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
            // Redirigez avec un message d'erreur si l'email est invalide
            header('Location: ?action=client-create&error=invalid_email');
            exit;
        }
    
        $client = new Client();
        $client->setNom($_POST['nom']);
        $client->setPrenom($_POST['prenom']);
        $client->setMail($_POST['mail']);
        $client->setTelephone($_POST['telephone']);
        $client->setAdresse($_POST['adresse']);
        
        // Appel à la méthode create pour enregistrer le client dans la base de données
        $success = $this->clientrepo->create($client); 
    
        // Vérifie si l'ajout a réussi et redirige en conséquence
        if ($success) {
            // Redirection vers la liste avec un paramètre success=1 pour afficher un message de confirmation
            header('Location: ?action=showList&add_success=1');
        } else {
            // En cas d'échec, on peut rediriger avec un message d'erreur
            header('Location: ?action=showList&add_error=1');
        }
        exit; // Important : termine l'exécution du script après la redirection
    }
    

    public function edit(int $id)
    {
        $client = $this->clientrepo->getClient($id);
        require_once __DIR__ . '/../Views/client-edit.php';
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

        header('Location: ?action=showList&update_success=1');
        exit;
    }

    public function delete(int $id)
    {
        $this->clientrepo->delete($id);

        header('Location: ?action=showList&delete_success=1');
        exit;
    }


    public function forbidden()
    {
        require_once __DIR__ . '/../views/404.php';
        http_response_code(404);
    }
}