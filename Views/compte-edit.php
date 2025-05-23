<!-- HEADER -->
<?php require_once __DIR__ . '/templates/header.php'; ?> 

<!-- MESSAGES DE SUCCES ET ECHEC -->
<?php if (isset($_GET['update_success']) && $_GET['update_success'] == 1): ?>
    <div class="alert alert-success"><?= htmlspecialchars('Dossier compte modifié avec succès !') ?></div>
<?php endif; ?>

<!-- FORMULAIRE DE MODIFICATION DU DOSSIER COMPTE -->
<h2 class="mb-4">Modification du dossier compte</h2>

<form action="?action=compte-update" method="POST">
    <input type="hidden" name="id_compte" value="<?= htmlspecialchars($compte->getId()) ?>">

    <div class="mb-3">
    <label for="type_compte" class="form-label">Type de compte :</label>
    <select name="type_compte" id="type_compte" class="form-select" required>
        <?php foreach ($typesCompteDisponibles as $type): ?>
            <option value="<?= htmlspecialchars($type) ?>" 
                <?= $compte->getTypeCompte() === $type ? 'selected' : '' ?>>
                <?= htmlspecialchars($type) ?>
            </option>
        <?php endforeach; ?>
    </select>
</div>

    <div class="mb-3">
        <label for="solde" class="form-label">Solde (en euros) :</label>
        <input type="number" class="form-control" id="solde" name="solde" value="<?= htmlspecialchars($compte->getSolde()) ?>" required />
    </div>
    
    <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
</form>

<a href="?action=compte-list=" class="btn btn-secondary">Retour à la liste</a>

<!-- FOOTER -->
<?php require_once __DIR__ . '/templates/footer.php'; ?>
