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



<form action="?action=client-store" method="POST">
    <div class="mb-3">
        <label for="nom" class="form-label">Nom :</label>
        <input type="text" class="form-control" id="nom" name="nom" required />
    </div>
    <div class="mb-3">
        <label for="prenom" class="form-label">Prénom :</label>
        <input type="text" class="form-control" id="prenom" name="prenom" required />
    </div>
    <div class="mb-3">
        <label for="mail" class="form-label">Mail :</label>
        <input type="text" class="form-control" id="mail" name="mail" required />
    </div>
    </div>
    <div class="mb-3">
        <label for="telephone" class="form-label">Téléphone :</label>
        <input type="text" class="form-control" id="telephone" name="telephone" required />
    </div>
    <div class="mb-3">
        <label for="adresse" class="form-label">Adresse :</label>
        <input type="text" class="form-control" id="adresse" name="adresse" required />
    </div>
    
    <button type="submit" class="btn btn-primary">Ajouter</button>
</form>

<a href="?action=client-list" class="btn btn-secondary">Retour à la liste</a>

<?php require_once __DIR__ . '/templates/footer.php'; 