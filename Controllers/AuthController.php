<?php

require_once __DIR__ . '/../Models/Repositories/AdminRepository.php';

//INSTANCIATION DU REPOSITORY NECESSAIRES POUR LE AUTHCONTROLLER
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
        if (isset($_POST['mail']) && isset($_POST['mdp'])) {
            $mail = htmlspecialchars(trim($_POST['mail'])); // Sécurise l'email
            $mdp = trim($_POST['mdp']); // Nettoie le mot de passe

            $admin = $this->adminrepo->getAdminbyMail($mail);

            if ($admin && password_verify($mdp, $admin->getMdp())) {
                $_SESSION['id_admin'] = $admin->getId();
                $_SESSION['flash_message'] = "Connexion réussie !";
                header('Location: ?action=dashboard');
                exit;
            }

            $_SESSION['login_error'] = "Identifiants incorrects";
            header('Location: ?action=login');
            exit;
        }

        $_SESSION['error'] = 'Veuillez corriger votre saisie';
        header('Location: ?action=login');
        exit;
    }

    public function logout()
    {
        session_start();
        session_destroy();
        session_start();

        unset($_SESSION['flash_message']);
        unset($_SESSION['login_error']);
        unset($_SESSION['error']);

        header('Location: ?action=login');
        exit;
    }

    public function forbidden()
    {
        require_once __DIR__ . '/../views/404.php';
        http_response_code(404);
    }
}
