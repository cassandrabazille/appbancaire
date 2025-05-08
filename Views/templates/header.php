<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application bancaire</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="?action=dashboard">
  <img src="Views/Images/monaco-white.svg" alt="Logo" class="me-2" style="height: 30px;">
  Application bancaire
</a>

            <div id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="?action=dashboard">🏠 Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?action=client-list">Gestion des clients</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?action=compte-list">Gestion des comptes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?action=contrat-list">Gestion des contrats</a>
                    </li>
                    <?php if (isset($_SESSION['id_admin'])): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="?action=logout">Déconnexion</a>
                    </li>
                    <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="?action=login">Connexion</a>
                    </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-5">

