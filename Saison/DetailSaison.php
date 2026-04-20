<?php
require_once 'fonctionSaison.php';
require_once '../Serie/fonctionSerie.php';
require_once '../Episode/fonctionEpisode.php';

$id = $_GET['id'];
$saison = getSaisonById($id);
$serie = getSerieById($saison["serie_id"]);
$tousLesEpisodes = getEpisodesBySaisonId($id);

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
    <title>Détail de la saison</title>
</head>
<body>
<div class="detail">
    <h1><?= $serie['nom'] ?> - Saison <?= $saison['num_saison'] ?></h1>
    <div class="infos-groupe">
        <h2>Informations de la Saison</h2>
        <ul>
            <li><strong>Numéro de la saison :</strong> <?= $saison['num_saison'] ?></li>
            <li><strong>Année de sortie :</strong> <?= $saison['annee_sortie'] ?></li>
            <li><strong>Nombre d'épisodes :</strong> <?= $saison['nbre_episodes'] ?> épisodes</li>
            <li><strong>Origine :</strong> Spin-off de <em><?= $texteSpinOff ?></em></li>
        </ul>

    </div>
    <div class="infos-groupe">
        <h2> Épisodes de cette saison</h2>

        <?php if (empty($tousLesEpisodes)): ?>
            <p><em>Aucun épisode n'a encore été inséré pour cette saison.</em></p>
        <?php else: ?>
            <ul>
                <?php foreach ($tousLesEpisodes as $ep): ?>
                    <li><?= $ep['titre'] ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
</div><br>
<a href="AfficheSaison.php">Retour</a>
</body>
</html>

