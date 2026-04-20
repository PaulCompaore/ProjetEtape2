<?php
require_once 'fonctionSaison.php';

$Saison = [
    "num_saison" => $_POST['num_saison'],
    "serie_id" => $_POST['serie_id'],
    "annee_sortie" => $_POST['date'],
    "nbre_episodes" => $_POST['nbre_episodes'],
];
insertSaison($Saison);
header('Location: AfficheSaison.php');
