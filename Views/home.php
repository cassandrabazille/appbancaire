<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des clients</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="?">📋 Gestion des clients</a>
            <div class="" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="?">🏠 Accueil</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h2 class="mb-4">📋 Liste des clients</h2>

        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Prenom</th>
                    <th>Mail</th>
                    <th>Telephone</th>
                    <th>Adresse</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($clients as $client): ?>

                    <tr>

                        <td><?php echo $client->getId(); ?></td>
                        <td><a href="?action=view&id=<?php echo $client->getId() ?>"><?php echo $client->getNom(); ?></a></td>
                        <td><?php echo $client->getPrenom(); ?></td>
                        <td><?php echo $client->getMail(); ?></td>
                        <td><?php echo $client->getTelephone() ?></td>
                        <td><?php echo $client->getAdresse() ?></td>

                    </tr>

                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</body>
</html>