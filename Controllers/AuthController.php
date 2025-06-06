<?php

require_once __DIR__ . '/../Models/Repositories/AdminRepository.php';

// Instanciation du Repository nécessaire pour le AuthController
class AuthController
{
   
    private AdminRepository $adminrepo;

    public function __construct()
    {
        $this->adminrepo = new AdminRepository();
    }

    public function login()
    {
        require __DIR__ . '/../views/login.php';
    }

public function doLogin()
{
   
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {  // S'assurer que la méthode est bien POST
        if (isset($_POST['mail']) && isset($_POST['mdp'])) {
            // Vérifier que le CSRF token est valide
            if (isset($_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) {
                // Nettoyer et valider les données
                $mail = filter_var(trim($_POST['mail']), FILTER_SANITIZE_EMAIL);
                if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                    $_SESSION['login_error'] = "Adresse email invalide";
                    header('Location: ?action=login');
                    exit;
                }
                $mdp = trim($_POST['mdp']);
            
                // Vérification pour le mode démo
                if ($mail === 'demo@banque.com' && $mdp === 'Mdpdemo1') {
                    $_SESSION['user'] = 'demo';
                    $_SESSION['modeDemo'] = true;
                      $_SESSION['id_admin'] = 0; 
                    $_SESSION['flash_message'] = "Vous êtes connecté en mode démo.";
                    session_regenerate_id(true);  // Renouvelle l'ID de session pour la sécurité
                    header('Location: ?action=dashboard');
                    exit;
                }

                // Vérification de l'utilisateur en production
                $admin = $this->adminrepo->getAdminbyMail($mail);
                if ($admin) {
                    if (password_verify($mdp, $admin->getMdp())) {
                        $_SESSION['id_admin'] = $admin->getId();
                        $_SESSION['flash_message'] = "Connexion réussie !";
                        session_regenerate_id(true);  // Renouvelle l'ID de session pour la sécurité
                        header('Location: ?action=dashboard');
                        exit;
                    } else {
                        $_SESSION['login_error'] = "Mot de passe incorrect";
                        header('Location: ?action=login');
                        exit;
                    }
                } else {
                    $_SESSION['login_error'] = "Utilisateur non trouvé";
                    header('Location: ?action=login');
                    exit;
                }
            } else {
                $_SESSION['login_error'] = "Token CSRF invalide";
                header('Location: ?action=login');
                exit;
            }
        }

        $_SESSION['error'] = 'Veuillez corriger votre saisie';
        header('Location: ?action=login');
        exit;
    }
}



    public function logout()
    {
        // Suppression de la session
        session_destroy();  // Détruire la session

        // Supprimer les variables de session spécifiques
        unset($_SESSION['flash_message']);
        unset($_SESSION['login_error']);
        unset($_SESSION['error']);
        unset($_SESSION['modeDemo']); // Détruire la variable de session mode démo

        header('Location: ?action=login'); // Redirige vers la page de login
        exit;
    }

    public function forbidden()
    {
        require_once __DIR__ . '/../views/404.php';
        http_response_code(404);
    }
}
