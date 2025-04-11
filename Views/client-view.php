<!-- HEADER -->
<?php require_once __DIR__ . '/templates/header.php'; ?>

<?php if (isset($_GET['update_success']) && $_GET['update_success'] == 1): ?>
    <div class="alert alert-success"><?= htmlspecialchars('Dossier client modifié avec succès !') ?></div>
<?php endif; ?>

<?php if (isset($_GET['delete_success']) && $_GET['delete_success'] == 1): ?>
    <div class="alert alert-success"><?= htmlspecialchars('Client supprimé avec succès !') ?></div>
<?php endif; ?>


<!-- DETAILS DU DOSSIER CLIENT -->
<h2 class="mb-4">📋 Détails du client</h2>

<p><strong>Id : </strong> <?= htmlspecialchars($client->getId()) ?></p>
<p><strong>Prénom : </strong> <?= htmlspecialchars($client->getPrenom()) ?></p>
<p><strong>Nom : </strong> <?= htmlspecialchars($client->getNom()) ?></p>
<p><strong>E-mail : </strong> <?= htmlspecialchars ($client->getMail()) ?></p>
<p><strong>Téléphone : </strong> <?= htmlspecialchars ($client->getTelephone()) ?></p>
<p><strong>Adresse : </strong> <?= htmlspecialchars ($client->getAdresse()) ?></p>
<a href="?action=client-edit&id_client=<?= htmlspecialchars($client->getId()) ?>" class="btn btn-warning">Modifier le client</a>
<a href="?action=client-list" class="btn btn-secondary">Retour à la liste</a>

</body>
</html>

<!-- FOOTER -->
<?php require_once __DIR__ . '/templates/footer.php'; ?>