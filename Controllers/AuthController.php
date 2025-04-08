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

    public function doLogin() {
        $mail = filter_input(INPUT_POST, 'mail');
        $mdp = filter_input(INPUT_POST, 'mdp');
    
        $admin = $this->adminrepo->getAdminbyMail($mail);

        if (!$mail || !$mdp) {
            $_SESSION['error'] = 'Veuillez corriger votre saisie';
            header('Location: ?action=login');
            exit;
        }
    
        if ($admin && password_verify($mdp, $admin->getMdp())) {
            $_SESSION['id_admin'] = $admin->getId();
            $_SESSION['flash_message'] = "Connexion réussie !";
            header('Location: ?action=home'); // Redirection vers le dashboard
            exit;
        }
        
        $_SESSION['login_error'] = "Identifiants incorrects";
        header('Location: ?action=login'); // Reste sur la page de login
        exit;
    }


    public function logout()
    {
        unset($_SESSION['id_admin']);
        header('Location: ?');
        exit;
    }

    public function forbidden()
    {
        require_once __DIR__ . '/../views/404.php';
        http_response_code(404);
    }
    
  
}