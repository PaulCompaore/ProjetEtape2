<?php
require "fonctionEpisode.php";

$Episode = [
    "num_episode" => $_POST['num_episode'],
    "saison_id" => $_POST['saison_id'],
    "date_diffusion" => $_POST['date'],
    "titre" => $_POST['titre'],
    "duree" => $_POST['duree'],
    "descriptions" => $_POST['descriptions']

];
insertEpisode($Episode);
header('Location: AfficheEpisode.php');
