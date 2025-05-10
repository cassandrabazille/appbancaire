<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application bancaire</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="?action=dashboard">Application bancaire</a>
            <div id="navbarNav"></div>
        </div>
    </nav>

    <div class="container mt-5">
        <!-- MESSAGES DE SUCCES ET ECHEC -->
        <?php if (isset($_SESSION['flash_message'])): ?>
            <div class="alert alert-success">
                <?php echo htmlspecialchars($_SESSION['flash_message']); ?>
            </div>
            <?php unset($_SESSION['flash_message']); ?>  
        <?php endif; ?>

        <?php if (isset($_SESSION['login_error'])): ?>
            <div class="alert alert-danger">
                <?php echo htmlspecialchars($_SESSION['login_error']); ?>
            </div>
            <?php unset($_SESSION['login_error']); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-warning">
                <?php echo htmlspecialchars($_SESSION['error']); ?>
            </div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <!-- FORMULAIRE DE CONNEXION -->
<form action="index.php?action=doLogin" method="POST">
    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

    <div class="form-group">
        <label for="mail">Mail :</label>
         <input type="hidden" name="mail" value="demo@banque.com">
        <input class="form-control" type="email" id="mail" name="mail" required placeholder="Entrez votre email">
    </div>
    <div class="form-group">
        <label for="mdp">Mot de passe :</label>
         <input type="hidden" name="mdp" value="Mdpdemo1">
        <input class="form-control" type="password" id="mdp" name="mdp" required placeholder="Entrez votre mot de passe">
    </div>
    <div class="form-group mt-4">
        <button class="btn btn-primary" type="submit">Se connecter</button>
    </div>
</form>


        <!-- FOOTER -->
        <?php require_once __DIR__ . '/templates/footer.php'; ?>
    </div>

    <!-- Scripts Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
