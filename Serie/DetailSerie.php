<?php
require_once 'fonctionSerie.php';

$id = $_GET['id'];
$serie = getSerieById($id);

$texteSpinOff = "Aucun spin-off"; // Texte lorqu'il y'a pas de spin off
if ($serie["spin_off_id"] != null) {
    $serieParente = getSerieById($serie["spin_off_id"]);
    $texteSpinOff = $serieParente["nom"];
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../CSS/style.css">
    <title>Détail série</title>
</head>
<body>
<div class="detail">
<h1><?= $serie['nom'] ?></h1>

    <ul>
    <li><strong>Description de la serie: </strong></li>
    <p><?= $serie['descriptions'] ?></p>
        <p><li><strong>Année de début :</strong> <?= $serie['annee_debut'] ?></li></p>
        <p><li><strong>Année de fin :</strong> <?= $serie['annee_fin'] ?></li></p>
        <p><li><strong>Spin-off :</strong> <?= $texteSpinOff ?></li></p>
    </ul>
</div>
<a href="AfficheSerie.php">Retour</a>
</body>
</html>