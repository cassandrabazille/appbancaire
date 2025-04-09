<?php require_once __DIR__ . '/templates/header.php'; ?>

        <h1>Bienvenue dans votre espace admin</h1>
        <h2>📋 Dashboard</h2>
        <p>Nombre total de clients enregistrés : <strong><?= $totalClients ?></strong></p>
        <a href="index.php?action=showList" class="btn btn-primary">📋 Voir la liste des clients</a>

    </div> <!-- Fermeture du container -->
</body>
</html>

<?php require_once __DIR__ . '/templates/footer.php'; 