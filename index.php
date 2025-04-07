<?php

require_once __DIR__ .'/lib/database.php';
require_once __DIR__ .'/Models/Client.php';

$db = new DatabaseConnection();

$clients = $db->getConnection()->query('SELECT * FROM clients')->fetchAll();

var_dump($clients);













