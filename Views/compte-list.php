<?php require_once __DIR__ . '/templates/header.php'; ?>


<?php if (isset($_GET['login_success']) && $_GET['login_success'] == 1): ?>
    <div class="alert alert-success">Connexion réussie !</div>
<?php endif; ?>

<?php if (isset($_GET['add_success']) && $_GET['add_success'] == 1): ?>
    <div class="alert alert-success">Compte ajouté avec succès !</div>
<?php endif; ?>

<?php if (isset($_GET['update_success']) && $_GET['update_success'] == 1): ?>
    <div class="alert alert-success">Dossier compte modifié avec succès !</div>
<?php endif; ?>

<?php if (isset($_GET['delete_success']) && $_GET['delete_success'] == 1): ?>
    <div class="alert alert-success">Compte supprimé avec succès !</div>
<?php endif; ?>

<?php if (isset($_GET['add_error']) && $_GET['add_error'] == 1): ?>
    <div class="alert alert-danger">Une erreur s'est produite lors de l'ajout du compte.</div>
<?php endif; ?>


<a class="nav-link" href="?action=compte-create">⊕ Créer un nouveau compte</a>

<h2>👥 Liste des comptes</h2>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Rib</th>
            <th>Type de compte</th>
            <th>Solde/th>
            <th>Id du client</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($comptes as $compte): ?>
            <tr>
                <td><?= htmlspecialchars($compte->getRib()) ?></td>
                <td><?= htmlspecialchars($compte->getTypeCompte()) ?></td>
                <td><?= htmlspecialchars($compte->getSolde()) ?></td>
                <td><?= htmlspecialchars($compte->getClientId()) ?></td>
                <td> 
                <a href="?action=compte-edit&id_compte=<?= $compte->getId() ?>" class="btn btn-warning btn-sm">Modifier✏️</a>
                <a onclick="return confirm('T’es sûr ?');" href="?action=compte-delete&id_compte=<?= $compte->getId() ?>" class="btn btn-dark btn-sm">Supprimer ❌</a>
                <a href="?action=compte-view&id_compte=<?= $compte->getId() ?>" class="btn btn-warning btn-sm">Voir dossier 👀</a>

                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<a href="index.php?action=dashboard" class="btn btn-secondary">⬅️ Retour à l’accueil</a>

<?php require_once __DIR__ . '/templates/footer.php'; ?>