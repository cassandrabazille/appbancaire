<?php

require_once __DIR__ . '/Models/Repositories/ClientRepository.php';

$clientrepo = new ClientRepository();

if (isset($_GET['action']) && $_GET['action'] == 'view' && isset($_GET['id_client'])) {
    
    $task = $clientrepo->getClient($_GET['id_client']);
    require_once __DIR__ . '/views/view-task.php';

} else {
    
    $client = $clientrepo->getClients();
    require_once __DIR__ . '/views/home.php';    
    
}












