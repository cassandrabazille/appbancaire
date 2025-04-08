<?php require_once __DIR__ . '/templates/header.php'; ?>

  

        <h1>Bienvenue dans votre espace admin</h1>
        <!-- Contenu spécifique du dashboard ici -->
    </div>

 


    <body>

           
    <h2>📋 Dashboard</h2>
<p>Nombre total de clients enregistrés : <strong><?= $totalClients ?></strong></p>

<a href="?action=showList" class="btn btn-primary">Voir tous les clients</a>


<?php if (isset($clients)) : ?>
    <h3>Liste des clients</h3>
    <ul>
        <?php foreach ($clients as $client) : ?>
            <li><?= $client->getNom() ?> <?= $client->getPrenom() ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
   
       
     


</body>
</html>