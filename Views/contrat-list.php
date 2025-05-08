<!-- HEADER -->
<?php require_once __DIR__ . '/templates/header.php'; ?>

<!-- MESSAGES DE SUCCES ET ECHEC -->
<?php if (isset($_GET['login_success']) && $_GET['login_success'] == 1): ?>
    <div class="alert alert-success"><?= htmlspecialchars('Connexion réussie !') ?></div>
<?php endif; ?>

<?php if (isset($_GET['add_success']) && $_GET['add_success'] == 1): ?>
    <div class="alert alert-success"><?= htmlspecialchars('Contrat ajouté avec succès !') ?></div>
<?php endif; ?>

<?php if (isset($_GET['update_success']) && $_GET['update_success'] == 1): ?>
    <div class="alert alert-success"><?= htmlspecialchars('Dossier contrat modifié avec succès !') ?></div>
<?php endif; ?>

<?php if (isset($_GET['delete_success']) && $_GET['delete_success'] == 1): ?>
    <div class="alert alert-success"><?= htmlspecialchars('Contrat supprimé avec succès !') ?></div>
<?php endif; ?>

<?php if (isset($_GET['add_error']) && $_GET['add_error'] == 1): ?>
    <div class="alert alert-danger"><?= htmlspecialchars('Une erreur s\'est produite lors de l\'ajout du contrat.') ?></div>
<?php endif; ?>

<!-- LISTE DES CONTRATS -->
<div class="d-flex justify-content-end mb-3">
<button type="button" class="btn btn-dark mb-3"><a class="nav-link" href="?action=contrat-create"><?= htmlspecialchars('⊕ Créer un nouveau contrat') ?></a></button>
</div>

<h2><?= htmlspecialchars('📝 Liste des contrats') ?></h2>

<?php if (!empty($contrats)): ?>
    <table class="table table-striped">
        <thead>
            <tr>
                <th><?= htmlspecialchars('Type du contrat') ?></th>
                <th><?= htmlspecialchars('Montant') ?></th>
                <th><?= htmlspecialchars('Durée') ?></th>
                <th><?= htmlspecialchars('Nom client') ?></th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($contrats as $contrat): ?>
            <tr>
                <td><?= htmlspecialchars($contrat->getTypeContrat()) ?></td>
                <td><?= htmlspecialchars($contrat->getMontant()) ?></td>
                <td><?= htmlspecialchars($contrat->getDuree()) ?></td>
                <td><?= htmlspecialchars($contrat->getClient()->getNom()) ?></td>
                <td>
                    <a href="?action=contrat-edit&id_contrat=<?= htmlspecialchars($contrat->getId()) ?>" class="btn btn-secondary btn-sm"><?= htmlspecialchars('Modifier✏️') ?></a>
                    <a onclick="return confirm('T’es sûr ?');" href="?action=contrat-delete&id_contrat=<?= htmlspecialchars($contrat->getId()) ?>" class="btn btn-danger btn-sm"><?= htmlspecialchars('Supprimer ❌') ?></a>
                    <a href="?action=contrat-view&id_contrat=<?= htmlspecialchars($contrat->getId()) ?>" class="btn btn-dark btn-sm"><?= htmlspecialchars('Voir dossier 👀') ?></a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <div class="alert alert-info"><?= htmlspecialchars('Aucun contrat à afficher') ?></div>
<?php endif; ?>

<a href="index.php?action=dashboard" class="btn btn-secondary"><?= htmlspecialchars('⬅️ Retour à l\'accueil') ?></a>

<!-- FOOTER -->
<?php require_once __DIR__ . '/templates/footer.php'; ?>
