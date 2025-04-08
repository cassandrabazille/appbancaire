<?php
session_start();

// Chargement des contrôleurs
require_once __DIR__ . '/Controllers/AuthController.php';
require_once __DIR__ . '/Controllers/ClientController.php';

$authController = new AuthController();
$clientController = new ClientController();

// Par défaut : redirige vers le login
if (!isset($_GET['action']) && !isset($_SESSION['id_admin'])) {
    header('Location: ?action=login');
    exit;
}

$action = $_GET['action'] ?? 'home';

switch ($action) {


    case 'login':
        if (isset($_SESSION['id_admin'])) {
            header('Location: ?action=dashboard'); // ✅ redirige vers dashboard (et pas "home")
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
            header('Location: ?action=login'); // ✅ S’il est pas connecté, redirige vers login
            exit;
        }
        $clientController->dashboard(); // ✅ Sinon, affiche dashboard
        break;


    case 'showList':
        $clientController->showList();
        break;

    default:
        $authController->forbidden();
        break;
}










