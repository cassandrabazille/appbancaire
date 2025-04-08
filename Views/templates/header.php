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
            <a class="navbar-brand" href="?">📋 Application bancaire</a>
            <div class="" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="?">🏠 Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?action=create">Gestion des client</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?action=create">Gestion des comptes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?action=create">Gestion des contrats</a>
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
