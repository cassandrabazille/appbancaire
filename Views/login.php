<?php require_once __DIR__ . '/templates/header.php'; 

// Affiche un message d'erreur de connexion si existant
if (isset($_SESSION['login_error'])) {
    echo '<div class="error-message">' . $_SESSION['login_error'] . '</div>';
    unset($_SESSION['login_error']); // On enlève le message de session après l'avoir affiché
}
?>

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
