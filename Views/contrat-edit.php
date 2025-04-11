<!-- HEADER -->
<?php require_once __DIR__ . '/templates/header.php'; ?> 

<!-- MESSAGES DE SUCCES ET ECHEC -->
<?php if (isset($_GET['update_success']) && $_GET['update_success'] == 1): ?>
    <div class="alert alert-success"><?= htmlspecialchars('Dossier compte modifié avec succès !') ?></div>
<?php endif; ?>

<!-- FORMULAIRE DE MODIFICATION DU DOSSIER CONTRAT -->
<h2 class="mb-4"><?= htmlspecialchars('Modification du dossier compte') ?></h2>

<form action="?action=contrat-update" method="POST">
    <input type="hidden" name="id_contrat" value="<?= htmlspecialchars($contrat->getId()) ?>">

    <div class="mb-3">
        <label for="montant" class="form-label"><?= htmlspecialchars('Montant:') ?></label>
        <input type="text" class="form-control" id="montant" name="montant" value="<?= htmlspecialchars($contrat->getMontant()) ?>" required />
    </div>
    <div class="mb-3">
        <label for="duree" class="form-label"><?= htmlspecialchars('Durée :') ?></label>
        <input type="number" class="form-control" id="duree" name="duree" value="<?= htmlspecialchars($contrat->getDuree()) ?>" required />
    </div>

    <button type="submit" class="btn btn-primary"><?= htmlspecialchars('Enregistrer les modifications') ?></button>
</form>

<a href="?action=compte-list=" class="btn btn-secondary"><?= htmlspecialchars('Retour à la liste') ?></a>

<!-- FOOTER -->
<?php require_once __DIR__ . '/templates/footer.php'; ?>
