<?php

require_once __DIR__ . '/../Models/Repositories/CompteRepository.php';
require_once __DIR__ . '/../Models/Compte.php';

class CompteController
{
    private CompteRepository $compterepo;

    public function __construct()
    {
        $this->compterepo = new CompteRepository();
    }

    public function showList()
    {
        if (!isset($_SESSION['id_admin'])) {
            header('Location: ?action=login');
            exit;
        }

        $comptes = $this->compterepo->getComptes();

        require_once __DIR__ . '/../Views/compte-list.php';
    }

    public function countComptes()
    {
        return $this->compterepo->countComptes(); // Appelle la méthode dans le repository
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
    

    public function show(int $id) 
    {
        $compte = $this->compterepo->getCompte($id);

        require_once __DIR__ . '/../Views/compte-view.php';
    }

    public function showDetails(): void
{
    if (!isset($_GET['id_compte']) || !is_numeric($_GET['id_compte'])) {
       
        header('Location: ?action=compte-list');
        exit;
    }

    $id = (int)$_GET['id_compte'];
    $compte = $this->compterepo->getCompte($id);

    if (!$compte) {
    
        echo "Compte non trouvé.";
        return;
    }

    require __DIR__ . '/../views/compte-view.php';
}


    public function create()
    {
        require_once __DIR__ . '/../Views/compte-create.php';
    }

    public function store()
    {
        $compte = new Compte();
        $compte->setRib($_POST['rib']);
        $compte->setTypeCompte($_POST['type_compte']);
        $compte->setSolde($_POST['solde']);
        $compte->setClientId($_POST['client_id']);

        
        // Appel à la méthode create pour enregistrer le client dans la base de données
        $success = $this->compterepo->create($compte); 
    
        // Vérifie si l'ajout a réussi et redirige en conséquence
        if ($success) {
            // Redirection vers la liste avec un paramètre success=1 pour afficher un message de confirmation
            header('Location: ?action=compte-list&add_success=1');
        } else {
            // En cas d'échec, on peut rediriger avec un message d'erreur
            header('Location: ?action=compte-list&add_error=1');
        }
        exit; // Important : termine l'exécution du script après la redirection
    }
    

    public function edit(int $id)
    {
        $compte = $this->compterepo->getCompte($id);
        require_once __DIR__ . '/../Views/compte-edit.php';
    }

    public function update()
    {
        $compte = new Compte();
        $compte->setId($_POST['id_compte']); 
        $compte->setRib($_POST['rib']);
        $compte->setTypeCompte($_POST['type_compte']);
        $compte->setSolde($_POST['solde']);
        $compte->setClientId($_POST['client_id']);
        
        $this->compterepo->update($compte);
    
        header('Location: ?action=compte-list&update_success=1');
        exit;
    }
    

    public function delete(int $id)
    {
        $this->compterepo->delete($id);

        header('Location: ?action=compte-list&delete_success=1');
        exit;
    }


    public function forbidden()
    {
        require_once __DIR__ . '/../views/404.php';
        http_response_code(404);
    }
}