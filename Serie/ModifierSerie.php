<?php

require_once 'fonctionSerie.php';

$serie = [
    'serie_id' => $_POST['serie_id'],
    'nom' => $_POST['nom'],
    'descriptions' => $_POST['descriptions'],
    'annee_debut' => $_POST['annee_debut'],
    'annee_fin' => $_POST['annee_fin'],
    'spin_off_id' => $_POST['spin_off_id'] ?? null, // teste si la valeur existe et n'est pas null  si non prend null comme valeur
];
updateSerie($serie);
header('Location: AfficheSerie.php');