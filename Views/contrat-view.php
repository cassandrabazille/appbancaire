<!-- HEADER -->
<?php require_once __DIR__ . '/templates/header.php'; ?>

<!-- MESSAGES DE SUCCES ET ECHEC -->
<?php if (isset($_GET['update_success']) && $_GET['update_success'] == 1): ?>
    <div class="alert alert-success"><?= htmlspecialchars('Dossier contrat modifié avec succès !') ?></div>
<?php endif; ?>

<?php if (isset($_GET['delete_success']) && $_GET['delete_success'] == 1): ?>
    <div class="alert alert-success"><?= htmlspecialchars('Contrat supprimé avec succès !') ?></div>
<?php endif; ?>

<!-- DETAILS DU DOSSIER CONTRAT -->
<h2 class="mb-4"><?= htmlspecialchars('📋 Détails du contrat') ?></h2>

<?php if ($contrat): ?>
    <div class="card mb-3">
        <div class="card-body">
            <p><strong><?= htmlspecialchars('ID : ') ?></strong> <?= htmlspecialchars($contrat->getId()) ?></p>
            <p><strong><?= htmlspecialchars('Type de contrat : ') ?></strong> <?= htmlspecialchars($contrat->getTypeContrat()) ?></p>
            <p><strong><?= htmlspecialchars('Montant : ') ?></strong> <?= htmlspecialchars($contrat->getMontant()) ?></p>
            <p><strong><?= htmlspecialchars('Durée : ') ?></strong> <?= htmlspecialchars($contrat->getDuree()) ?></p>
            <div class="mt-3">
                <a href="?action=contrat-edit&id_contrat=<?= htmlspecialchars($contrat->getId()) ?>" class="btn btn-warning btn-sm"><?= htmlspecialchars('Modifier le contrat') ?></a>
                <a href="?action=contrat-list" class="btn btn-secondary btn-sm"><?= htmlspecialchars('Retour à la liste') ?></a>
            </div>
        </div>
    </div>
<?php else: ?>
    <div class="alert alert-danger"><?= htmlspecialchars('Compte non trouvé') ?></div>
    <a href="?action=contrat-list" class="btn btn-secondary"><?= htmlspecialchars('Retour à la liste') ?></a>
<?php endif; ?>

<!-- FOOTER -->
<?php require_once __DIR__ . '/templates/footer.php'; ?>
