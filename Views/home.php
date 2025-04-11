<!-- HEADER -->
<?php require_once __DIR__ . '/templates/header.php'; ?>

<h1><?= htmlspecialchars('Bienvenue dans votre espace admin') ?></h1>
<h2><?= htmlspecialchars('📋 Dashboard') ?></h2>

<p><?= htmlspecialchars('Nombre total de clients enregistrés : ') ?> <strong><?= htmlspecialchars($totalClients) ?></strong></p>
<a href="index.php?action=client-list" class="btn btn-primary"><?= htmlspecialchars('📋 Voir la liste des clients') ?></a>

<p><?= htmlspecialchars('Nombre total de comptes enregistrés : ') ?> <strong><?= htmlspecialchars($totalComptes) ?></strong></p>
<a href="index.php?action=compte-list" class="btn btn-primary"><?= htmlspecialchars('📋 Voir la liste des comptes') ?></a>

<p><?= htmlspecialchars('Nombre total de contrats enregistrés : ') ?> <strong><?= htmlspecialchars($totalContrats) ?></strong></p>
<a href="index.php?action=contrat-list" class="btn btn-primary"><?= htmlspecialchars('📋 Voir la liste des contrats') ?></a>

</div> <!-- Fermeture du container -->
</body>
</html>

<!-- FOOTER -->
<?php require_once __DIR__ . '/templates/footer.php'; ?>
