<?php
require_once 'fonctionSerie.php';

$id = $_GET['id'];
$serie = getSerieById($id);
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
<p>Description : <?= $serie['descriptions'] ?></p>
<p>Année de début : <?= $serie['annee_debut'] ?></p>
<p>Année de fin : <?= $serie['annee_fin'] ?></p>
<p>Spin-off : <?= $serie['spin_off_id'] ?></p>
</div>
<a href="AfficheSerie.php">Retour</a>
</body>
</html>