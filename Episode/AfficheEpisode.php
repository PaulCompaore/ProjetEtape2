<?php
require_once'fonctionEpisode.php';
$episodes = getAllEpisode();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../CSS/style.css">
    <title>Les Episodes</title>
</head>
<body>
<div class="insererSerie">
    <a href="InsererForEpisode.php"> Inserer une nouvelle episode</a>
</div>
<table border="1" class="tableau_saison">
    <tr>
        <th>Episode_Id</th>
        <th>Numero De Episode</th>
        <th>Titre</th>
        <th>Descriptions</th>
        <th>Saison_id</th>
        <th>Durée</th>
        <th>Date De Diffusion</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($episodes as $episode) : ?>
        <tr>
            <td><?= $episode['episode_id'] ?></td>
            <td><?= $episode['num_episode'] ?></td>
            <td><?= $episode['titre'] ?></td>
            <td><?= $episode['descriptions'] ?></td>
            <td><?= $episode['saison_id'] ?></td>
            <td><?= $episode['duree'] ?></td>
            <td><?= $episode['date_diffusion'] ?></td>
            <td>
                <a href="DetailEpisode.php?id=<?= $episode['episode_id'] ?>">Détail</a>
                <a href="ModifierForEpisode.php?id=<?= $episode['episode_id'] ?>">Modifier</a>
                <a href="SupprimerEpisode.php?id=<?= $episode['episode_id'] ?>">Supprimer</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<p>
    <a href="../index.php">Accueil</a>
</p>
</body>
</html>
