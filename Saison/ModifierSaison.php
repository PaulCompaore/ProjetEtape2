<?php
require_once 'fonctionSaison.php';

$saison = [
    "saison_id" => $_POST["saison_id"],
    "num_saison" => $_POST['num_saison'],
    "serie_id" => $_POST['serie_id'],
    "annee_sortie" => $_POST['date'],
    "nbre_episodes" => $_POST['nbre_episodes'],
];
updateSaison($saison);
header('Location: AfficheSaison.php');