<!-- HEADER -->
<?php require_once __DIR__ . '/templates/header.php'; ?>

<!-- MESSAGES DE SUCCES ET ECHEC -->
<?php if (isset($_GET['login_success']) && $_GET['login_success'] == 1): ?>
    <div class="alert alert-success"><?= htmlspecialchars('Connexion réussie !') ?></div>
<?php endif; ?>

<?php if (isset($_GET['add_success']) && $_GET['add_success'] == 1): ?>
    <div class="alert alert-success"><?= htmlspecialchars('Compte ajouté avec succès !') ?></div>
<?php endif; ?>

<?php if (isset($_GET['update_success']) && $_GET['update_success'] == 1): ?>
    <div class="alert alert-success"><?= htmlspecialchars('Dossier compte modifié avec succès !') ?></div>
<?php endif; ?>

<?php if (isset($_GET['delete_success']) && $_GET['delete_success'] == 1): ?>
    <div class="alert alert-success"><?= htmlspecialchars('Compte supprimé avec succès !') ?></div>
<?php endif; ?>

<?php if (isset($_GET['add_error']) && $_GET['add_error'] == 1): ?>
    <div class="alert alert-danger"><?= htmlspecialchars('Une erreur s\'est produite lors de l\'ajout du compte.') ?></div>
<?php endif; ?>

<?php if (isset($_SESSION['flash_message'])): ?>
    <div class="alert alert-danger">
        <?= htmlspecialchars($_SESSION['flash_message']) ?>
    </div>
    <?php unset($_SESSION['flash_message']); ?>
<?php endif; ?>


<!-- LISTE DES COMPTES -->
<div class="d-flex justify-content-end mb-3">
<button type="button" class="btn btn-dark mb-3"><a class="nav-link" href="?action=compte-create"><?= htmlspecialchars('⊕ Créer un nouveau compte') ?></a></button>
</div>

<h2><?= htmlspecialchars('💰  Liste des comptes') ?></h2>

<table class="table table-striped">
    <thead>
        <tr>
            <th><?= htmlspecialchars('Rib') ?></th>
            <th><?= htmlspecialchars('Type de compte') ?></th>
            <th><?= htmlspecialchars('Solde') ?></th>
            <th><?= htmlspecialchars('Nom client') ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($comptes as $compte): ?>
        
            <tr>
                <td><?= htmlspecialchars($compte->getRib()) ?></td>
                <td><?= htmlspecialchars($compte->getTypeCompte()) ?></td>
                <td><?= htmlspecialchars($compte->getSolde()) ?></td>
                <td><?= htmlspecialchars($compte->getClient()->getNom()) ?></td>
                <td>
                    <a href="?action=compte-edit&id_compte=<?= htmlspecialchars($compte->getId()) ?>" class="btn btn-secondary btn-sm"><?= htmlspecialchars('Modifier✏️') ?></a>
                    <a onclick="return confirm('T’es sûr ?');" href="?action=compte-delete&id_compte=<?= htmlspecialchars($compte->getId()) ?>" class="btn btn-danger btn-sm"><?= htmlspecialchars('Supprimer ❌') ?></a>
                    <a href="?action=compte-view&id_compte=<?= htmlspecialchars($compte->getId()) ?>" class="btn btn-dark btn-sm"><?= htmlspecialchars('Voir dossier 👀') ?></a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<a href="index.php?action=dashboard" class="btn btn-secondary"><?= htmlspecialchars('⬅️ Retour à l’accueil') ?></a>

<!-- FOOTER -->
<?php require_once __DIR__ . '/templates/footer.php'; ?>
