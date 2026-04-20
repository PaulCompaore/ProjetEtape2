<?php

require_once'fonctionSerie.php';

$Serie = [
    "nom" => $_POST['nom'],
    "descriptions" => $_POST['descriptions'],
    "annee_debut" => $_POST['annee_debut'],
    "annee_fin" => $_POST['annee_fin'],
    "spin_off_id" => $_POST['serie_id'] ?? null,
];
insertSerie($Serie);
// redirection automatique vers la page qui affiche toutes les series
header('Location: AfficheSerie.php');