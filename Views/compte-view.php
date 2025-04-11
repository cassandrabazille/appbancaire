<!-- HEADER -->
<?php require_once __DIR__ . '/templates/header.php'; ?>

<!-- MESSAGES DE SUCCES ET ECHEC -->
<?php if (isset($_GET['update_success']) && $_GET['update_success'] == 1): ?>
    <div class="alert alert-success"><?= htmlspecialchars('Dossier compte modifié avec succès !') ?></div>
<?php endif; ?>

<?php if (isset($_GET['delete_success']) && $_GET['delete_success'] == 1): ?>
    <div class="alert alert-success"><?= htmlspecialchars('Compte supprimé avec succès !') ?></div>
<?php endif; ?>

<!-- DETAILS DU DOSSIER COMPTE -->
<h2 class="mb-4"><?= htmlspecialchars('📋 Détails du compte') ?></h2>

<?php if ($compte): ?>
    <div class="card mb-3">
        <div class="card-body">
            <p><strong><?= htmlspecialchars('ID : ') ?></strong> <?= htmlspecialchars($compte->getId()) ?></p>
            <p><strong><?= htmlspecialchars('Rib : ') ?></strong> <?= htmlspecialchars($compte->getRib()) ?></p>
            <p><strong><?= htmlspecialchars('Type de compte : ') ?></strong> <?= htmlspecialchars($compte->getTypeCompte()) ?></p>
            <p><strong><?= htmlspecialchars('Solde : ') ?></strong> <?= htmlspecialchars($compte->getSolde()) ?></p>
            <div class="mt-3">
                <a href="?action=compte-edit&id_compte=<?= htmlspecialchars($compte->getId()) ?>" class="btn btn-warning btn-sm"><?= htmlspecialchars('Modifier le compte') ?></a>
                <a href="?action=compte-list" class="btn btn-secondary btn-sm"><?= htmlspecialchars('Retour à la liste') ?></a>
            </div>
        </div>
    </div>
<?php else: ?>
    <div class="alert alert-danger"><?= htmlspecialchars('Compte non trouvé') ?></div>
    <a href="?action=compte-list" class="btn btn-secondary"><?= htmlspecialchars('Retour à la liste') ?></a>
<?php endif; ?>

<!-- FOOTER -->
<?php require_once __DIR__ . '/templates/footer.php'; ?>
