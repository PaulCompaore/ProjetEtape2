<?php
require "fonctionEpisode.php";

$Episode = [
    "episode_id" => $_POST['episode_id'],
    "num_episode" => $_POST['num_episode'],
    "saison_id" => $_POST['saison_id'],
    "date_diffusion" => $_POST['date'],
    "titre" => $_POST['titre'],
    "duree" => $_POST['duree'],
    "descriptions" => $_POST['descriptions']

];
updateEpisode($Episode);
header('Location: AfficheEpisode.php');
