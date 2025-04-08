<?php require_once __DIR__ . '/templates/header.php'; 

if (isset($_SESSION['login_error'])) {
    echo '<div class="error-message">'.$_SESSION['login_error'].'</div>';
    unset($_SESSION['login_error']); 
}
?>

<form action="?action=doLogin" method="POST">
    <div class="form-group">
        <label>Mail :</label>
        <input class="form-control" type="text" name="mail" required>
    </div>
    <div class="form-group">
        <label>Mot de passe :</label>
        <input class="form-control" type="mdp" name="mdp" required>
    </div>
    <div class="form-group">
        <button class="btn btn-primary" type="submit">Se connecter</button>
    </div>
</form>

<?php require_once __DIR__ . '/templates/footer.php';