<?php
require_once 'fonctionEpisode.php';
require_once '../Serie/fonctionSerie.php';
require_once '../Saison/fonctionSaison.php';

$id = $_GET['id'];
$episode = getEpisodeById($id);
$saison = getSaisonById($episode["saison_id"]);
$serie = getSerieById($saison["serie_id"]);

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
    <title>Détail de l'episode</title>
</head>
<body>
<div class="detail">
    <h1><?= $serie['nom'] ?> - Saison <?= $saison['num_saison'] ?> - Episode <?= $episode['num_episode'] ?></h1>
    <div class="infos-groupe">
        <h2>Informations de l'épisode</h2>
        <ul>
            <li><strong>Titre :</strong> <?= $episode['titre'] ?></li>
            <li><strong>Numéro :</strong> <?= $episode['num_episode'] ?></li>
            <li><strong>Durée :</strong> <?= $episode['duree'] ?></li>
            <li><strong>Date de diffusion :</strong> <?= $episode['date_diffusion'] ?></li>
            <li><strong>Description :</strong> <?= $episode['descriptions'] ?></li>
            <li><strong>Nom de la série:</strong> <?= $serie['nom'] ?></li>
            <li><strong>Spin-off  :</strong> <?= $texteSpinOff ?></li>
            <li><strong>Numéro de la saison  :</strong> <?= $saison['num_saison'] ?></li>
        </ul>
    </div>
</div><br>
<a href="AfficheEpisode.php">Retour</a>
</body>
</html>

