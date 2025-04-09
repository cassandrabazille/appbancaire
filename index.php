<?php
session_start();

if (isset($_SESSION['flash_message'])) {
    echo '<div class="alert alert-success">' . htmlspecialchars($_SESSION['flash_message']) . '</div>';
    unset($_SESSION['flash_message']);
}


require_once __DIR__ . '/Controllers/AuthController.php';
require_once __DIR__ . '/Controllers/ClientController.php';
require_once __DIR__ . '/Controllers/CompteController.php';

$authController = new AuthController();
$clientController = new ClientController();
$compteController = new CompteController();


if (!isset($_GET['action']) && !isset($_SESSION['id_admin'])) {
    header('Location: ?action=login');
    exit;
}

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

    case 'compte-delete':
        if (isset($_GET['id_compte']) && is_numeric($_GET['id_compte'])) {
            $compteController->delete((int) $_GET['id_compte']);
        } else {
            header('Location: ?action=compte-list');
            exit;
        }
        break;

    default:
        $authController->forbidden();
        break;
}












