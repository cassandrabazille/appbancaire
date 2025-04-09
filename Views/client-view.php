<?php require_once __DIR__ . '/templates/header.php'; ?>

<?php if (isset($_GET['update_success']) && $_GET['update_success'] == 1): ?>
    <div class="alert alert-success">Dossier client modifié avec succès !</div>
<?php endif; ?>

<?php if (isset($_GET['delete_success']) && $_GET['delete_success'] == 1): ?>
    <div class="alert alert-success">Client supprimé avec succès !</div>
<?php endif; ?>


<h2 class="mb-4">📋 Détails du client</h2>

<p><strong>Id : </strong> <?= htmlspecialchars($client->getId()) ?></p>
<p><strong>Name : </strong> <?= htmlspecialchars($client->getPrenom()) ?></p>
<p><strong>Name : </strong> <?= htmlspecialchars($client->getNom()) ?></p>
<p><strong>Mail : </strong> <?= htmlspecialchars ($client->getMail()) ?></p>
<p><strong>Phone : </strong> <?= htmlspecialchars ($client->getTelephone()) ?></p>
<p><strong>Adresse : </strong> <?= htmlspecialchars ($client->getAdresse()) ?></p>
<a href="?action=edit&id_client=<?= htmlspecialchars($client->getId()) ?>" class="btn btn-warning">Modifier le client</a>
<a href="?action=showList" class="btn btn-secondary">Retour à la liste</a>




</body>
</html>