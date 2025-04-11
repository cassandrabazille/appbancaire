<?php

require_once __DIR__ . '/../Models/Repositories/CompteRepository.php';
require_once __DIR__ . '/../Models/Compte.php';
require_once __DIR__ . '/../Models/Client.php';

//INSTANCIATION DES REPOSITORIES NECESSAIRES POUR LE COMPTECONTROLLER
class CompteController
{
    private CompteRepository $compterepo;
    private ClientRepository $clientRepo;

    public function __construct()
    {
        $this->compterepo = new CompteRepository();
        $this->clientRepo = new ClientRepository();
        
    }

    //CRUD

    //CREATE
    public function create()
    {
        require_once __DIR__ . '/../Views/compte-create.php';
    }

    public function store()
    {
        // Sécurisation des données reçues de l'utilisateur
        $rib = htmlspecialchars(trim($_POST['rib']));
        $typeCompte = htmlspecialchars(trim($_POST['type_compte']));
        $solde = htmlspecialchars(trim($_POST['solde']));
        $clientId = (int) $_POST['client_id'];  // On cast en entier pour plus de sécurité

        $compte = new Compte();
        $compte->setRib($rib);
        $compte->setTypeCompte($typeCompte);
        $compte->setSolde($solde);
        $compte->setClientId($clientId);

        $success = $this->compterepo->create($compte);

        if ($success) {
            header('Location: ?action=compte-list&add_success=1');
        } else {
            header('Location: ?action=compte-list&add_error=1');
        }
        exit;
    }

    //READ
    public function show(int $id)
    {
        $compte = $this->compterepo->getCompte($id);
    
        if (!$compte) {
            header('Location: ?action=compte-list');
            exit;
        }
    
        $client = $this->clientRepo->getClient($compte->getClientId());
        if ($client) {
            $compte->setClient($client);  
        }
    
        require_once __DIR__ . '/../Views/compte-view.php';
    }
    
    public function showList()
    {
        $comptes = $this->compterepo->getComptes(); 
        $clientrepo = new ClientRepository(); 
    
        foreach ($comptes as $compte) {
            $client = $clientrepo->getClient($compte->getClientId());  
            if ($client) {
                $compte->setClient($client);  
            }
        }
    
        require_once __DIR__ . '/../Views/compte-list.php';  
    }
    
    public function showDetails(): void
    {
        if (!isset($_GET['id_compte']) || !is_numeric($_GET['id_compte'])) {
            header('Location: ?action=compte-list');
            exit;
        }

        $id = (int) $_GET['id_compte'];
        $compte = $this->compterepo->getCompte($id);

        if (!$compte) {
            echo "Compte non trouvé.";
            return;
        }

        require __DIR__ . '/../views/compte-view.php';
    }

    //UPDATE
    public function edit(int $id)
    {
        $compte = $this->compterepo->getCompte($id);
        require_once __DIR__ . '/../Views/compte-edit.php';
    }

    public function update()
    {
        // Sécurisation des données reçues de l'utilisateur
        $idCompte = (int) $_POST['id_compte'];
        $typeCompte = htmlspecialchars(trim($_POST['type_compte']));
        $solde = htmlspecialchars(trim($_POST['solde']));

        $compte = new Compte();
        $compte->setId($idCompte);
        $compte->setTypeCompte($typeCompte);
        $compte->setSolde($solde);
    
        $this->compterepo->update($compte);
    
        header('Location: ?action=compte-list&update_success=1');
        exit;
    }

    //DELETE
    public function delete(int $id)
    {
        $this->compterepo->delete($id);

        header('Location: ?action=compte-list&delete_success=1');
        exit;
    }

    //GESTION DES ERREURS
    public function forbidden()
    {
        require_once __DIR__ . '/../views/404.php';
        http_response_code(404);
    }

    //LOGIQUE METIER
    public function countComptes()
    {
        return $this->compterepo->countComptes();
    }

    public function dashboard()
    {
        if (!isset($_SESSION['id_admin'])) {
            header('Location: ?action=login');
            exit;
        }

        $totalComptes = $this->compterepo->countComptes();
        require_once __DIR__ . '/../Views/home.php';
    }

}
