<?php
require_once 'identifiant.php';
function connexion()
{
    $strConnex = "host=" . $_ENV['dbHost'] . " dbname=" . $_ENV['dbName'] . " user=" . $_ENV['dbUser'] . " password=" . $_ENV['dbPasswd'];
    $ptrDB = pg_connect($strConnex);
    return $ptrDB;
}
