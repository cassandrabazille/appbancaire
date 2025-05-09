<!-- HEADER -->
<?php require_once __DIR__ . '/templates/header.php'; ?>

<!-- MESSAGES DE SUCCES ET ECHEC -->
<?php if (isset($_GET['add_success']) && $_GET['add_success'] == 1): ?>
    <div class="alert alert-success"><?= htmlspecialchars('Compte ajouté avec succès !') ?></div>
<?php endif; ?>

<?php if (isset($_GET['add_error']) && $_GET['add_error'] == 1): ?>
    <div class="alert alert-danger"><?= htmlspecialchars('Une erreur s\'est produite lors de l\'ajout du contrat.') ?></div>
<?php endif; ?>

<!-- FORMULAIRE DE CREATION DE DOSSIER CONTRAT -->
<h2 class="mb-4"><?= htmlspecialchars('Création d\'un dossier contrat') ?></h2>
<form action="?action=contrat-store" method="POST">
<div class="mb-3">
    <label for="type_contrat" class="form-label">Type de contrat :</label>
    <select name="type_contrat" id="type_contrat" class="form-select" required>
        <?php foreach ($typesContratDisponibles as $type): ?>
            <option value="<?= htmlspecialchars($type) ?>">
                <?= htmlspecialchars($type) ?>
            </option>
        <?php endforeach; ?>
    </select>
</div>
    <div class="mb-3">
        <label for="montant" class="form-label"><?= htmlspecialchars('Montant :') ?></label>
        <input type="text" class="form-control" id="montant" name="montant" required />
    </div>
    <div class="mb-3">
        <label for="duree" class="form-label"><?= htmlspecialchars('Durée (en mois) :') ?></label>
        <input type="text" class="form-control" id="duree" name="duree" required />
    </div>
    <div class="mb-3">
        <label for="client_id" class="form-label"><?= htmlspecialchars('Id du client :') ?></label>
        <input type="text" class="form-control" id="client_id" name="client_id" required />
    </div>

    <button type="submit" class="btn btn-primary"><?= htmlspecialchars('Créer') ?></button>
</form>

<a href="?action=contrat-list=" class="btn btn-secondary"><?= htmlspecialchars('Retour à la liste') ?></a>

<!-- FOOTER -->
<?php require_once __DIR__ . '/templates/footer.php'; ?>
