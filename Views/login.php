<?php require_once __DIR__ . '/templates/header.php'; ?>

<?php if (isset($_SESSION['flash_message'])): ?>
    <div class="alert alert-success">
        <?php echo $_SESSION['flash_message']; ?>
    </div>
    <?php unset($_SESSION['flash_message']); ?>  <!-- On nettoie la session ici après affichage -->
<?php endif; ?>



<?php if (isset($_SESSION['login_error'])): ?>
    <div class="alert alert-danger">
        <?php echo $_SESSION['login_error']; ?>
    </div>
    <?php unset($_SESSION['login_error']); ?>
<?php endif; ?>

<?php if (isset($_SESSION['error'])): ?>
    <div class="alert alert-warning">
        <?php echo $_SESSION['error']; ?>
    </div>
    <?php unset($_SESSION['error']); ?>
<?php endif; ?>

<form action="?action=doLogin" method="POST">
    <div class="form-group">
        <label>Mail :</label>
        <input class="form-control" type="text" name="mail" required>
    </div>
    <div class="form-group">
        <label>Mot de passe :</label>
        <input class="form-control" type="password" name="mdp" required> <!-- Modifié ici -->
    </div>
    <div class="form-group">
        <button class="btn btn-primary" type="submit">Se connecter</button>
    </div>
</form>

<?php require_once __DIR__ . '/templates/footer.php'; ?>
