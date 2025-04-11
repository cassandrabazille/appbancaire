<!-- HEADER -->
<?php require_once __DIR__ . '/templates/header.php'; ?> 

<!-- MESSAGES DE SUCCES  -->

<?php if (isset($_GET['update_success']) && $_GET['update_success'] == 1): ?>
    <div class="alert alert-success"><?= htmlspecialchars('Dossier client modifié avec succès !') ?></div>
<?php endif; ?>

<!-- FORMULAIRE DE MODIFICATION DU DOSSIER CLIENT -->
<h2 class="mb-4">Modification du dossier client</h2>

<form action="?action=client-update" method="POST">
    <input type="hidden" name="id_client" value="<?= htmlspecialchars($client->getId()) ?>">
    
    <div class="mb-3">
        <label for="nom" class="form-label">Nom :</label>
        <input type="text" class="form-control" id="nom" name="nom" value="<?= htmlspecialchars($client->getNom()) ?>" required />
    </div>
    
    <div class="mb-3">
        <label for="prenom" class="form-label">Prénom :</label>
        <input type="text" class="form-control" id="prenom" name="prenom" value="<?= htmlspecialchars($client->getPrenom()) ?>" required />
    </div>
    
    <div class="mb-3">
        <label for="mail" class="form-label">Mail :</label>
        <input type="email" class="form-control" id="mail" name="mail" value="<?= htmlspecialchars($client->getMail()) ?>" required />
    </div>
    
    <div class="mb-3">
        <label for="telephone" class="form-label">Téléphone :</label>
        <input type="tel" class="form-control" id="telephone" name="telephone" value="<?= htmlspecialchars($client->getTelephone()) ?>" required />
    </div>
    
    <div class="mb-3">
        <label for="adresse" class="form-label">Adresse :</label>
        <textarea class="form-control" id="adresse" name="adresse" rows="3"><?= htmlspecialchars($client->getAdresse()) ?></textarea>
    </div>
    
    <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
</form>

<a href="?action=client-list" class="btn btn-secondary">Retour à la liste</a>

<!-- FOOTER -->
<?php require_once __DIR__ . '/templates/footer.php'; ?>
