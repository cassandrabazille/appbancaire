<?php require_once __DIR__ . '/templates/header.php'; ?>


<?php if (isset($_GET['login_success']) && $_GET['login_success'] == 1): ?>
    <div class="alert alert-success">Connexion réussie !</div>
<?php endif; ?>

<?php if (isset($_GET['add_success']) && $_GET['add_success'] == 1): ?>
    <div class="alert alert-success">Client ajouté avec succès !</div>
<?php endif; ?>

<?php if (isset($_GET['update_success']) && $_GET['update_success'] == 1): ?>
    <div class="alert alert-success">Dossier client modifié avec succès !</div>
<?php endif; ?>

<?php if (isset($_GET['delete_success']) && $_GET['delete_success'] == 1): ?>
    <div class="alert alert-success">Client supprimé avec succès !</div>
<?php endif; ?>

<?php if (isset($_GET['add_error']) && $_GET['add_error'] == 1): ?>
    <div class="alert alert-danger">Une erreur s'est produite lors de l'ajout du client.</div>
<?php endif; ?>


<a class="nav-link" href="?action=client-create">⊕ Créer un nouveau client</a>

<h2>👥 Liste des clients</h2>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Prenom</th>
            <th>Nom</th>
            <th>E-mail</th>
            <th>Téléphone</th>
            <th>Adresse</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($clients as $client): ?>
            <tr>
                <td><?= htmlspecialchars($client->getPrenom()) ?></td>
                <td><?= htmlspecialchars($client->getNom()) ?></td>
                <td><?= htmlspecialchars($client->getMail()) ?></td>
                <td><?= htmlspecialchars($client->getTelephone()) ?></td>
                <td><?= htmlspecialchars($client->getAdresse()) ?></td>
                <td> 
                <a href="?action=edit&id_client=<?= $client->getId() ?>" class="btn btn-warning btn-sm">Modifier✏️</a>
                <a onclick="return confirm('T’es sûr ?');" href="?action=delete&id_client=<?= $client->getId() ?>" class="btn btn-dark btn-sm">Supprimer ❌</a>
                <a href="?action=client-view&id_client=<?= $client->getId() ?>" class="btn btn-warning btn-sm">Voir dossier 👀</a>

                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<a href="index.php?action=dashboard" class="btn btn-secondary">⬅️ Retour à l’accueil</a>

<?php require_once __DIR__ . '/templates/footer.php'; ?>
