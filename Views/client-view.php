<?php require_once __DIR__ . '/templates/header.php'; ?>


<h2 class="mb-4">📋 Détails du client</h2>
<p><strong>Id : </strong> <?= htmlspecialchars($client->getId()) ?></p>
<p><strong>Name : </strong> <?= htmlspecialchars($client->getPrenom()) ?></p>
<p><strong>Name : </strong> <?= htmlspecialchars($client->getNom()) ?></p>
<p><strong>Mail : </strong> <?= htmlspecialchars ($client->getMail()) ?></p>
<p><strong>Phone : </strong> <?= htmlspecialchars ($client->getPhone()) ?></p>
<p><strong>Adresse : </strong> <?= htmlspecialchars ($client->getAdresse()) ?></p>
<a href="?action=edit&id=<?= htmlspecialchars($client->getId()) ?>" class="btn btn-warning">Modifier le client</a>
<a href="?" class="btn btn-secondary">Retour à la liste</a>




</body>
</html>