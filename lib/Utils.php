<?php

function isConnected(): bool {
    // Vérification de la session et de son contenu de manière sécurisée
    if (isset($_SESSION['id_admin']) && !empty($_SESSION['id_admin'])) {
        return true;
    }
    
    // Si non connecté, redirection vers la page de login
    header('Location: ?action=login');  
    exit;  
}

