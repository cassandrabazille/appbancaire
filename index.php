<!-- HEADER -->
<?php

// MESSAGE DE DEBUT DE SESSION
session_start();

if (isset($_SESSION['flash_message'])) {
    echo '<div class="alert alert-success">' . htmlspecialchars($_SESSION['flash_message']) . '</div>';
    unset($_SESSION['flash_message']);
}

// Générer un CSRF token s'il n'existe pas encore
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));  // Génère un token unique pour la session
}

// LIENS DE REDIRECTION VERS LES FICHIERS CONTROLLERS ET INSTANCIATION
require_once __DIR__ . '/Controllers/AuthController.php';
require_once __DIR__ . '/Controllers/ClientController.php';
require_once __DIR__ . '/Controllers/CompteController.php';
require_once __DIR__ . '/Controllers/ContratController.php';


$authController = new AuthController();
$clientController = new ClientController();
$compteController = new CompteController();
$contratController = new ContratController();

// Si l'utilisateur n'est pas connecté (!isset($_SESSION['id_admin'])) et n'a pas spécifié d'action dans l'URL, il est redirigé vers la page de connexion.
if (!isset($_GET['action']) && !isset($_SESSION['id_admin'])) {
    header('Location: ?action=login');
    exit;
}
//Si aucune action n'est spécifiée dans l'URL, l'action par défaut sera 'home'.
$action = $_GET['action'] ?? 'home';

switch ($action) {
    //General actions

    case 'login':
        if (isset($_SESSION['id_admin'])) {
            header('Location: ?action=dashboard');
            exit;
        }
        require_once __DIR__ . '/Views/login.php';
        break;

    case 'doLogin':
        $authController->doLogin();
        break;

    case 'logout':
        $authController->logout();
        break;

    case 'dashboard':
        if (!isset($_SESSION['id_admin'])) {
            header('Location: ?action=login');
            exit;
        }
        $totalComptes = $compteController->countComptes();
        $totalClients = $clientController->countClients();
        $totalContrats = $contratController->countContrats();
        require_once __DIR__ . '/Views/home.php';
        break;


    //Client-related actions

    case 'client-list':
        $clientController->showList();
        break;

    case 'client-view':
        $clientController->showDetails();
        break;

    case 'client-create':
        $clientController->create();
        break;

    case 'client-store':
        $clientController->store();
        break;

    case 'client-update':
        $clientController->update();
        break;

    case 'client-edit':
        if (isset($_GET['id_client']) && is_numeric($_GET['id_client'])) {
            $clientController->edit((int) $_GET['id_client']);
        } else {
            header('Location: ?action=client-list');
            exit;
        }
        break;

    case 'client-delete':
        if (isset($_GET['id_client']) && is_numeric($_GET['id_client'])) {
            $clientController->delete((int) $_GET['id_client']);
        } else {
            header('Location: ?action=client-list');
            exit;
        }
        break;


    // Compte-related actions
    case 'compte-list':
        $compteController->showList();
        break;

    case 'compte-create':
        $compteController->create();
        break;

    case 'compte-view':
        $compteController->showDetails();
        break;

    case 'compte-store':
        $compteController->store();
        break;

    case 'compte-update':
        $compteController->update();
        break;
    case 'compte-edit':
        if (isset($_GET['id_compte']) && is_numeric($_GET['id_compte'])) {
            $compteController->edit((int) $_GET['id_compte']);
        } else {
            header('Location: ?action=compte-list');
            exit;
        }
        break;

        case 'compte-update-type':
            if (isset($_GET['id_compte']) && is_numeric($_GET['id_compte'])) {
                $compteController->updateTypeCompte(); // Appel sans paramètre, tout est dans $_POST
            } else {
                header('Location: ?action=compte-list');
                exit;
            }
            break;
        

    case 'compte-delete':
        if (isset($_GET['id_compte']) && is_numeric($_GET['id_compte'])) {
            $compteController->delete((int) $_GET['id_compte']);
        } else {
            header('Location: ?action=compte-list');
            exit;
        }
        break;

    
          // Contrat-related actions
    case 'contrat-list':
        $contratController->showList();
        break;

    case 'contrat-create':
        $contratController->create();
        break;

        case 'contrat-view':
            if (isset($_GET['id_contrat']) && is_numeric($_GET['id_contrat'])) {
                $contratController->show((int)$_GET['id_contrat']);
            } else {
                header('Location: ?action=contrat-list');
                exit;
            }
            break;

    case 'contrat-store':
        $contratController->store();
        break;

    case 'contrat-update':
        $contratController->update();
        break;
    case 'contrat-edit':
        if (isset($_GET['id_contrat']) && is_numeric($_GET['id_contrat'])) {
            $contratController->edit((int) $_GET['id_contrat']);
        } else {
            header('Location: ?action=contrat-list');
            exit;
        }
        break;

        case 'contrat-delete':
            if (isset($_GET['id_contrat']) && is_numeric($_GET['id_contrat'])) {
                $contratController->delete((int)$_GET['id_contrat']);
            } else {
                header('Location: ?action=contrat-list');
                exit;
            }
            break;

    default:
        $authController->forbidden();
        break;
}












