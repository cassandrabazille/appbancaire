<?php
session_start(); // Démarre la session pour accéder aux variables de session

// Affichage du message flash si disponible
if (isset($_SESSION['flash_message'])) {
    echo '<div class="alert alert-success">' . htmlspecialchars($_SESSION['flash_message']) . '</div>';
    unset($_SESSION['flash_message']); // Supprime le message de la session après affichage
}

// Chargement des contrôleurs
require_once __DIR__ . '/Controllers/AuthController.php';
require_once __DIR__ . '/Controllers/ClientController.php';

$authController = new AuthController();
$clientController = new ClientController();

// Par défaut : redirige vers le login si l'utilisateur n'est pas connecté
if (!isset($_GET['action']) && !isset($_SESSION['id_admin'])) {
    header('Location: ?action=login');
    exit;
}

$action = $_GET['action'] ?? 'home';

switch ($action) {
    case 'login':
        if (isset($_SESSION['id_admin'])) {
            header('Location: ?action=dashboard'); // Redirige vers le dashboard si déjà connecté
            exit;
        }
        require_once __DIR__ . '/Views/login.php';
        break;

    case 'doLogin':
        $authController->doLogin(); // Traite la connexion
        break;

    case 'logout':
        $authController->logout(); // Déconnecte l'utilisateur
        break;

    case 'dashboard':
        if (!isset($_SESSION['id_admin'])) {
            header('Location: ?action=login'); // Redirige vers le login si non connecté
            exit;
        }
        $clientController->dashboard(); // Affiche le dashboard
        break;

    case 'showList':
        $clientController->showList(); // Affiche la liste des clients
        break;

    case 'client-view':
        $clientController->showDetails(); // Affiche les détails d'un client
        break;

    case 'client-create':
        $clientController->create(); // Affiche le formulaire de création de client
        break;

    case 'store':
        $clientController->store(); // Enregistre un nouveau client
        break;

    case 'edit':
        if (!isset($_GET['id_client']) || !is_numeric($_GET['id_client'])) {
            header('Location: ?action=showList'); // Redirige si l'ID du client est invalide
            exit;
        }
        $clientController->edit((int)$_GET['id_client']);
        break;

    case 'update':
        $clientController->update(); // Met à jour les informations d'un client
        break;

    case 'delete':
        if (!isset($_GET['id_client']) || !is_numeric($_GET['id_client'])) {
            header('Location: ?action=showList'); // Redirige si l'ID du client est invalide
            exit;
        }
        $clientController->delete((int)$_GET['id_client']);
        break;

    default:
        $authController->forbidden(); // Affiche une page d'erreur si l'action est inconnue
        break;
}
?>











