<?php require_once __DIR__ . '/templates/header.php'; ?>

<?php if (isset($_GET['update_success']) && $_GET['update_success'] == 1): ?>
    <div class="alert alert-success">Dossier compte modifié avec succès !</div>
<?php endif; ?>

<?php if (isset($_GET['delete_success']) && $_GET['delete_success'] == 1): ?>
    <div class="alert alert-success">Compte supprimé avec succès !</div>
<?php endif; ?>


<h2 class="mb-4">📋 Détails du compte</h2>

<p><strong>Id : </strong> <?= htmlspecialchars($compte->getId()) ?></p>
<p><strong>Rib : </strong> <?= htmlspecialchars($compte->getRib()) ?></p>
<p><strong>Type de compte : </strong> <?= htmlspecialchars($compte->getTypeCompte()) ?></p>
<p><strong>Solde : </strong> <?= htmlspecialchars ($compte->getSolde()) ?></p>
<p><strong>Id du client : </strong> <?= htmlspecialchars ($compte->getClientId()) ?></p>
<a href="?action=compte-edit&id_compte=<?= htmlspecialchars($compte->getId()) ?>" class="btn btn-warning">Modifier le compte</a>
<a href="?action=compte-list" class="btn btn-secondary">Retour à la liste</a>




</body>
</html>