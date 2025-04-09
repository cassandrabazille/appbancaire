<?php require_once __DIR__ . '/templates/header.php'; ?> 

<?php if (isset($_GET['update_success']) && $_GET['update_success'] == 1): ?>
    <div class="alert alert-success">Dossier client modifié avec succès !</div>
<?php endif; ?>


<h2 class="mb-4">Modification du dossier client</h2>

<form action="?action=update" method="POST">
    <input type="hidden" name="id_client" value="<?= htmlspecialchars($client->getId()) ?>">
    <div class="mb-3">
        <label for="nom" class="form-label">Nom :</label>
        <textarea class="form-control" id="nom" name="nom" rows="3" required><?= htmlspecialchars ($client->getNom()) ?></textarea>
    </div>
    <div class="mb-3">
        <label for="prenom" class="form-label">Prénom :</label>
        <textarea class="form-control" id="prenom" name="prenom" rows="3" required><?= htmlspecialchars ($client->getPrenom()) ?></textarea>
    </div>
    <div class="mb-3">
        <label for="mail" class="form-label">Mail :</label>
        <textarea class="form-control" id="mail" name="mail" rows="3" required><?= htmlspecialchars($client->getMail()) ?></textarea>
    </div>
    <div class="mb-3">
        <label for="telephone" class="form-label">Téléphone :</label>
        <textarea class="form-control" id="telephone" name="telephone" rows="3" required><?= htmlspecialchars($client->getTelephone()) ?></textarea>
    </div>
    <div class="mb-3">
        <label for="adresse" class="form-label">Adresse :</label>
        <textarea class="form-control" id="adresse" name="adresse" rows="3" required><?= htmlspecialchars($client->getAdresse()) ?></textarea>
    </div>
    
    <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
</form>

<a href="?action=showList=" class="btn btn-secondary">Retour à la liste</a>

<?php require_once __DIR__ . '/templates/footer.php'; ?>
