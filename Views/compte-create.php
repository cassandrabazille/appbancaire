<!-- HEADER -->
<?php require_once __DIR__ . '/templates/header.php'; ?>

<!-- MESSAGES DE SUCCES ET ECHEC -->
<?php if (isset($_GET['add_success']) && $_GET['add_success'] == 1): ?>
    <div class="alert alert-success"><?php echo htmlspecialchars('Compte ajouté avec succès !'); ?></div>
<?php endif; ?>

<?php if (isset($_GET['add_error']) && $_GET['add_error'] == 1): ?>
    <div class="alert alert-danger"><?php echo htmlspecialchars('Une erreur s\'est produite lors de l\'ajout du compte.'); ?></div>
<?php endif; ?>

<!-- FORMULAIRE DE CREATION DE DOSSIER COMPTE -->
<h2 class="mb-4">Création d'un dossier compte</h2>
<form action="?action=compte-store" method="POST">
    <div class="mb-3">
        <label for="rib" class="form-label">RIB :</label>
        <input type="text" class="form-control" id="rib" name="rib" required />
    </div>

    <div class="mb-3">
    <label for="type_compte" class="form-label">Type de compte :</label>
    <select name="type_compte" id="type_compte" class="form-select" required>
        <?php foreach ($typesCompteDisponibles as $type): ?>
            <option value="<?= htmlspecialchars($type) ?>">
                <?= htmlspecialchars($type) ?>
            </option>
        <?php endforeach; ?>
    </select>
</div>


    <div class="mb-3">
        <label for="solde" class="form-label">Solde (en euros) :</label>
        <input type="text" class="form-control" id="solde" name="solde" required />
    </div>

    <div class="mb-3">
        <label for="client_id" class="form-label">ID du client :</label>
        <input type="text" class="form-control" id="client_id" name="client_id" required />
    </div>

    <button type="submit" class="btn btn-primary">Créer</button>
</form>

<a href="?action=compte-list" class="btn btn-secondary">Retour à la liste</a>


<!-- FOOTER -->
<?php require_once __DIR__ . '/templates/footer.php'; ?>
