<?php

require_once __DIR__ . '/../Models/Repositories/ContratRepository.php';
require_once __DIR__ . '/../Models/Contrat.php';
require_once __DIR__ . '/../Models/Client.php';

//INSTANCIATION DES REPOSITORIES NECESSAIRES POUR LE CONTRATCONTROLLER
class ContratController
{
    private ContratRepository $contratrepo;
    private ClientRepository $clientRepo;

    public function __construct()
    {
        $this->contratrepo = new ContratRepository();
        $this->clientRepo = new ClientRepository();
    }
    
    //CRUD

    //CREATE
    public function create()
    {
        $typesContratDisponibles = ContratRepository::getTypesContratDisponibles();
        require_once __DIR__ . '/../Views/contrat-create.php';
    }

    public function store()
    {
        // Sécurisation des données reçues de l'utilisateur
        $typeContrat = htmlspecialchars(trim($_POST['type_contrat']));
        $montant = htmlspecialchars(trim($_POST['montant']));
        $duree = htmlspecialchars(trim($_POST['duree']));
        $clientId = (int) $_POST['client_id'];  // Assurer que c'est un entier pour éviter l'injection

        $contrat = new Contrat();
        $contrat->setTypeContrat($typeContrat);
        $contrat->setMontant($montant);
        $contrat->setDuree($duree);
        $contrat->setClientId($clientId);

        $success = $this->contratrepo->create($contrat);

        if ($success) {
            header('Location: ?action=contrat-list&add_success=1');
        } else {
            header('Location: ?action=contrat-list&add_error=1');
        }
        exit;
    }

    //READ
    public function show(int $id)
    {
        if (!isset($_SESSION['id_admin'])) {
            header('Location: ?action=login');
            exit;
        }

        $contrat = $this->contratrepo->getContrat($id);

        if (!$contrat) {
            header('Location: ?action=contrat-list');
            exit;
        }

        // Récupération du client associé au contrat
        $client = $this->clientRepo->getClient($contrat->getClientId());
        if ($client) {
            $contrat->setClient($client);  
        }

        require_once __DIR__ . '/../Views/contrat-view.php';
    }

    public function showList()
    {
        $contrats = $this->contratrepo->getContrats(); 
        $clientrepo = new ClientRepository(); 
    
        foreach ($contrats as $contrat) {
            $client = $clientrepo->getClient($contrat->getClientId());  
            if ($client) {
                $contrat->setClient($client);  
            }
        }
    
        require_once __DIR__ . '/../Views/contrat-list.php';  
    }
    
    public function showDetails(): void
    {
        if (!isset($_GET['id_contrat']) || !is_numeric($_GET['id_contrat'])) {
            header('Location: ?action=contrat-list');
            exit;
        }

        $id = (int) $_GET['id_contrat'];
        $contrat = $this->contratrepo->getContrat($id);

        if (!$contrat) {
            echo "Compte non trouvé.";  // Ajout d'un message d'erreur si le contrat n'est pas trouvé
            return;
        }

        require __DIR__ . '/../views/contrat-view.php';
    }

    //UPDATE
    public function edit(int $id)
    {
        $contrat = $this->contratrepo->getContrat($id);
        require_once __DIR__ . '/../Views/contrat-edit.php';
    }

    public function update()
    {
        // Sécurisation des données reçues de l'utilisateur
        $idContrat = (int) $_POST['id_contrat'];
        $montant = htmlspecialchars(trim($_POST['montant']));
        $duree = htmlspecialchars(trim($_POST['duree']));

        $contrat = new Contrat();
        $contrat->setId($idContrat);
        $contrat->setMontant($montant);
        $contrat->setDuree($duree);

        $this->contratrepo->update($contrat);

        header('Location: ?action=contrat-list&update_success=1');
        exit;
    }

    //DELETE
    public function delete(int $id)
    {
        $this->contratrepo->delete($id);

        header('Location: ?action=contrat-list&delete_success=1');
        exit;
    }

    public function forbidden()
    {
        require_once __DIR__ . '/../views/404.php';
        http_response_code(404);
    }

    //LOGIQUE METIER
    public function countContrats()
    {
        return $this->contratrepo->countContrats();
    }

    public function dashboard()
    {
        if (!isset($_SESSION['id_admin'])) {
            header('Location: ?action=login');
            exit;
        }

        $totalContrats = $this->contratrepo->countContrats();
        require_once __DIR__ . '/../Views/home.php';
    }
}
