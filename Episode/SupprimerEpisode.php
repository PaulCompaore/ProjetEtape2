<?php
require_once 'fonctionEpisode.php';

$id = $_GET['id'];
deleteEpisode($id);
header('Location: AfficheEpisode.php');
