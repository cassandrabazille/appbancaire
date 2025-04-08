<?php require_once __DIR__ . '/templates/header.php'; ?>

<h2 class="mb-4">⊕ Créer un nouveau client</h2>

<form action="?action=store" method="POST">
    <div class="mb-3">
        <label for="title" class="form-label">Informations :</label>
        <input type="text" class="form-control" id="title" name="title" required>
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Nom :</label>
        <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
    </div>
    
    <button type="submit" class="btn btn-primary">Ajouter</button>
</form>

<a href="?" class="btn btn-secondary">Retour à la liste</a>

<?php require_once __DIR__ . '/templates/footer.php'; 