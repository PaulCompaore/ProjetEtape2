<?php
require_once 'fonctionSaison.php';

$id = $_GET['id'];
deleteSaison($id);
header('Location: AfficheSaison.php');
