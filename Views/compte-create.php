<?php require_once __DIR__ . '/templates/header.php'; ?>

<h2 class="mb-4">Création d'un dossier compte</h2>

<?php if (isset($_GET['add_success']) && $_GET['add_success'] == 1): ?>
    <div class="alert alert-success">Compte ajouté avec succès !</div>
<?php endif; ?>

<?php if (isset($_GET['add_error']) && $_GET['add_error'] == 1): ?>
    <div class="alert alert-danger">Une erreur s'est produite lors de l'ajout du compte.</div>
<?php endif; ?>

<?php if (isset($_GET['error']) && $_GET['error'] == 'invalid_email'): ?>
    <div class="alert alert-danger">L'adresse e-mail fournie n'est pas valide.</div>
<?php endif; ?>



<form action="?action=compte-store" method="POST">
    <div class="mb-3">
        <label for="rib" class="form-label">Rib :</label>
        <input type="text" class="form-control" id="rib" name="rib" required />
    </div>
    <div class="mb-3">
        <label for="type_compte" class="form-label">Type de compte :</label>
        <input type="text" class="form-control" id="type_compte" name="type_compte" required />
    </div>
    <div class="mb-3">
        <label for="solde" class="form-label">Solde :</label>
        <input type="text" class="form-control" id="solde" name="solde" required />
    </div>
    <div class="mb-3">
        <label for="client_id" class="form-label">Id du client :</label>
        <input type="text" class="form-control" id="client_id" name="client_id" required />
    </div>
   
    
    <button type="submit" class="btn btn-primary">Ajouter</button>
</form>

<a href="?action=compte-list=" class="btn btn-secondary">Retour à la liste</a>

<?php require_once __DIR__ . '/templates/footer.php'; 