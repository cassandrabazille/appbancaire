<?php

require_once __DIR__ .'/lib/database.php';
require_once __DIR__ .'/Models/Client.php';

$clientrepo = new ClientRepository();

$client = new Client();
$client->nom = 'Nom';
$client->prenom = 'prenom';
$client->mail = 'mail';
$client->telephone = 'telephone';
$client->adresse = 'adresse';

// Test multi-client
for ($i = 1; $i <= 5; $i++) {
    $client = $clientrepo->getClient($i);
    echo "<h2>Client $i :</h2>";
    var_dump($client);
    echo "<hr>";
}













