<!-- HEADER -->
<?php require_once __DIR__ . '/templates/header.php'; ?>

<p><?= htmlspecialchars('👋 Bonjour bienvenue dans votre espace administrateur !') ?></p></h1>

<h1><?= htmlspecialchars('📋 Dashboard') ?></h1>


<div class="container mt-4">
  <div class="row justify-content-center">

    <div class="col-md-4">
      <div class="card">
      <img src="Views/Images/clients.jpg" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">Clients</h5>
          <p><?= htmlspecialchars('Nombre total de clients enregistrés : ') ?> 
            <strong><?= htmlspecialchars($totalClients) ?></strong></p>
          <a href="index.php?action=client-list" class="btn btn-dark">
            <?= htmlspecialchars('📋 Voir la liste des clients') ?>
          </a>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card">
      <img src="Views/Images/comptes.jpg" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">Comptes</h5>
          <p><?= htmlspecialchars('Nombre total de comptes enregistrés : ') ?> 
            <strong><?= htmlspecialchars($totalComptes) ?></strong></p>
          <a href="index.php?action=compte-list" class="btn btn-dark">
            <?= htmlspecialchars('📋 Voir la liste des comptes') ?>
          </a>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card">
      <img src="Views/Images/contrats.jpg" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">Contrats</h5>
          <p><?= htmlspecialchars('Nombre total de contrats enregistrés : ') ?> 
            <strong><?= htmlspecialchars($totalContrats) ?></strong></p>
          <a href="index.php?action=contrat-list" class="btn btn-dark">
            <?= htmlspecialchars('📋 Voir la liste des contrats') ?>
          </a>
        </div>
      </div>
    </div>

  </div>
</div>




</div> <!-- Fermeture du container -->
</body>
</html>

<!-- FOOTER -->
<?php require_once __DIR__ . '/templates/footer.php'; ?>
