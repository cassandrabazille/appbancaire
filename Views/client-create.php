<?php require_once __DIR__ . '/templates/header.php'; ?>

<h2 class="mb-4">Création d'un dossier client</h2>

<?php if (isset($_GET['add_success']) && $_GET['add_success'] == 1): ?>
    <div class="alert alert-success">Client ajouté avec succès !</div>
<?php endif; ?>

<?php if (isset($_GET['add_error']) && $_GET['add_error'] == 1): ?>
    <div class="alert alert-danger">Une erreur s'est produite lors de l'ajout du client.</div>
<?php endif; ?>

<?php if (isset($_GET['error']) && $_GET['error'] == 'invalid_email'): ?>
    <div class="alert alert-danger">L'adresse e-mail fournie n'est pas valide.</div>
<?php endif; ?>



<form action="?action=store" method="POST">
    <div class="mb-3">
        <label for="description" class="form-label">Nom :</label>
        <textarea class="form-control" id="nom" name="nom" rows="3" required></textarea>
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Prénom :</label>
        <textarea class="form-control" id="prenom" name="prenom" rows="3" required></textarea>
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Mail :</label>
        <textarea class="form-control" id="mail" name="mail" rows="3" required></textarea>
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Téléphone :</label>
        <textarea class="form-control" id="telephone" name="telephone" rows="3" required></textarea>
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Adresse :</label>
        <textarea class="form-control" id="adresse" name="adresse" rows="3" required></textarea>
    </div>
    
    <button type="submit" class="btn btn-primary">Ajouter</button>
</form>

<a href="?" class="btn btn-secondary">Retour à la liste</a>

<?php require_once __DIR__ . '/templates/footer.php'; 