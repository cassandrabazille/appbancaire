<?php

require_once __DIR__ . '/../Models/Repositories/AdminRepository.php';

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
        // Vérifier si les champs sont remplis
        if (isset($_POST['mail']) && isset($_POST['mdp'])) {
            $mail = $_POST['mail'];
            $mdp = $_POST['mdp'];
    
            // Récupérer l'administrateur en fonction de l'email
            $admin = $this->adminrepo->getAdminbyMail($mail);
    
            // Vérifier si l'admin existe et si le mot de passe est correct
            if ($admin && password_verify($mdp, $admin->getMdp())) {
                // Connexion réussie, on enregistre l'ID de l'administrateur en session
                $_SESSION['id_admin'] = $admin->getId();
                $_SESSION['flash_message'] = "Connexion réussie !"; // Message de succès
    
                // Redirection vers le dashboard
                header('Location: ?action=dashboard');
                exit;
            }
    
            // Si les identifiants sont incorrects
            $_SESSION['login_error'] = "Identifiants incorrects";
            header('Location: ?action=login');
            exit;
        }
    
        // Si les champs mail ou mdp sont vides
        $_SESSION['error'] = 'Veuillez corriger votre saisie'; 
        header('Location: ?action=login');
        exit;
    }
    
    
    

    public function logout()
    {
        session_start(); // Démarre une nouvelle session avant de détruire l'ancienne
        session_destroy(); // Détruit la session active
        session_start(); // Redémarre la session pour réinitialiser les variables
    
        // Assurez-vous de vider tout message flash pour qu'il n'apparaisse plus
        unset($_SESSION['flash_message']);
        unset($_SESSION['login_error']);
        unset($_SESSION['error']);
        
        header('Location: ?action=login'); // Redirection vers la page de login
        exit;
    }
    

    public function forbidden()
    {
        require_once __DIR__ . '/../views/404.php';
        http_response_code(404);
    }
    
  
}