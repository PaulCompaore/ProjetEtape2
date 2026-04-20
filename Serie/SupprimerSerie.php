<?php
require_once 'fonctionSerie.php';

$id = $_GET['id'];
deleteSerie($id);
header('Location: AfficheSerie.php');