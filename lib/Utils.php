<?php

function isConnected() {
    if (isset($_SESSION['id_admin']) && !empty($_SESSION['id_admin'])) {
        return true;
    }
    header('Location: ?');
    exit;

   
}

