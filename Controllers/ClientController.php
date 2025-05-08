<?php

require_once __DIR__ . '/../Models/Repositories/ClientRepository.php';
require_once __DIR__ . '/../Models/Client.php';
require_once __DIR__ . '/../Models/Repositories/CompteRepository.php';

//INSTANCIATION DES REPOSITORIES NECESSAIRES POUR LE CLIENTCONTROLLER
class ClientController
{
    private ClientRepository $clientrepo;
    private CompteRepository $compterepo;

    public function __construct()
    {
        $this->clientrepo = new ClientRepository();
        $this->compterepo = new CompteRepository();
    }

    // CRUD

    //CREATE
    public function create()
    {
        require_once __DIR__ . '/../Views/client-create.php';
    }

    public function store()
    {
        // Nettoyage du téléphone (enlève les espaces)
        $telephone = preg_replace('/\s+/', '', $_POST['telephone']);
    
        // Vérification de l'email
        if (!filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
            $_SESSION['flash'] = [
                'type' => 'danger',
                'message' => "Adresse email invalide."
            ];
            header('Location: ?action=client-create');
            exit;
        }
    
        // Vérification du téléphone : accepte +33 ou 0 en début pour 06 ou 07
        if (!preg_match('/^((\+33[67]\d{8})|(0[67]\d{8}))$/', $telephone)) {
            $_SESSION['flash'] = [
                'type' => 'danger',
                'message' => "Le numéro de téléphone doit être au format français valide (ex : 06... ou +336...)."
            ];
            header('Location: ?action=client-create');
            exit;
        }
    
        // Conversion automatique vers international si nécessaire
        if (preg_match('/^0[67]\d{8}$/', $telephone)) {
            $telephone = '+33' . substr($telephone, 1);
        }
    
        // Sécurisation des données avant l'insertion en base
        $nom = htmlspecialchars(trim($_POST['nom']));
        $prenom = htmlspecialchars(trim($_POST['prenom']));
        $mail = htmlspecialchars(trim($_POST['mail']));
        $adresse = htmlspecialchars(trim($_POST['adresse']));

        // Création du client
        $client = new Client();
        $client->setNom($nom);
        $client->setPrenom($prenom);
        $client->setMail($mail);
        $client->setTelephone($telephone);
        $client->setAdresse($adresse);
    
        $success = $this->clientrepo->create($client);
    
        if ($success) {
            $_SESSION['flash'] = [
                'type' => 'success',
                'message' => 'Client ajouté avec succès !'
            ];
            header('Location: ?action=client-list');
        } else {
            $_SESSION['flash'] = [
                'type' => 'danger',
                'message' => 'Une erreur s\'est produite lors de l\'ajout du client.'
            ];
            header('Location: ?action=client-list');
        }
        exit;
    }
    
    //READ
    public function show(int $id)
    {
        $client = $this->clientrepo->getClient($id);

        // Sécuriser l'affichage de données
        $client_nom = htmlspecialchars($client->getNom());
        $client_prenom = htmlspecialchars($client->getPrenom());

        require_once __DIR__ . '/../Views/client-view.php';
    }

    public function showList()
    {
        if (!isset($_SESSION['id_admin'])) {
            header('Location: ?action=login');
            exit;
        }

        $clients = $this->clientrepo->getClients();

        // Sécurisation des données affichées
        foreach ($clients as $client) {
            $client->setNom(htmlspecialchars($client->getNom()));
            $client->setPrenom(htmlspecialchars($client->getPrenom()));
        }

        require_once __DIR__ . '/../Views/client-list.php';
    }

    public function showDetails(): void
    {
        if (!isset($_GET['id_client']) || !is_numeric($_GET['id_client'])) {

            header('Location: ?action=client-list');
            exit;
        }

        $id = (int) $_GET['id_client'];
        $client = $this->clientrepo->getClient($id);

        if (!$client) {

            echo "Client non trouvé.";
            return;
        }

        // Sécurisation des données
        $client_nom = htmlspecialchars($client->getNom());
        $client_prenom = htmlspecialchars($client->getPrenom());

        require __DIR__ . '/../views/client-view.php';
    }

    //UPDATE
    public function edit(int $id)
    {
        $client = $this->clientrepo->getClient($id);
        // Sécurisation des données
        $client_nom = htmlspecialchars($client->getNom());
        $client_prenom = htmlspecialchars($client->getPrenom());

        require_once __DIR__ . '/../Views/client-edit.php';
    }

    public function update()
    {
        $client = new Client();
        $client->setId($_POST['id_client']);
        $client->setNom(htmlspecialchars(trim($_POST['nom'])));
        $client->setPrenom(htmlspecialchars(trim($_POST['prenom'])));
        $client->setMail(htmlspecialchars(trim($_POST['mail'])));
        $client->setTelephone(htmlspecialchars(trim($_POST['telephone'])));
        $client->setAdresse(htmlspecialchars(trim($_POST['adresse'])));

        $this->clientrepo->update($client);

        header('Location: ?action=client-list&update_success=1');
        exit;
    }

    //DELETE
    public function delete(int $id)
    {
        // $comptes = $this->compterepo->findComptesByClientId($id);
        // if (!empty($comptes)) {
        //     $_SESSION['flash'] = [
        //         'type' => 'danger',
        //         'message' => "Le client ne peut pas être supprimé car il possède des comptes."
        //     ];            
        //     header('Location: ?action=client-list');
        //     exit;
        // }

        $this->clientrepo->delete($id);

        $_SESSION['flash_message'] = "Client supprimé avec succès, ainsi que ses comptes et contrats associés.";
        header('Location: ?action=client-list');
        exit;
    }

    //GESTION DES ERREURS
    public function forbidden()
    {
        require_once __DIR__ . '/../views/404.php';
        http_response_code(404);
    }

    //LOGIQUE METIER
    public function countClients()
    {
        return $this->clientrepo->countClients();
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
}
