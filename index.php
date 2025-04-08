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
    case 'home':
        if (!isset($_SESSION['id_admin'])) {
            header('Location: ?action=login');
            exit;
        }
        require_once __DIR__ . '/Views/home.php'; // Vue dashboard réservée aux admins
        break;
        
    case 'login':
        if (isset($_SESSION['id_admin'])) {
            header('Location: ?action=home'); // Si déjà connecté, redirige vers le dashboard
            exit;
        }
        require_once __DIR__ . '/Views/login.php'; // Affiche uniquement le formulaire
        break;
        
    case 'doLogin':
        $authController->doLogin();
        break;
        
    case 'logout':
        $authController->logout();
        break;
        
    default:
        $authController->forbidden();
        break;
}










