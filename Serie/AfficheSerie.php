<?php
require_once 'fonctionSerie.php';
$serie = getAllSerie();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../CSS/style.css">
    <title>Les Séries</title>
</head>
<body>
<div class="insererSerie">
    <a href="InsererForSerie.php"> Inserer une nouvelle serie</a>
</div>
<table border="1">
    <tr>
        <th>Serie_Id</th>
        <th>Nom</th>
        <th>Description</th>
        <th>Annee De Debut</th>
        <th>Annee De Fin</th>
        <th>Spin_Off_Id</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($serie as $series) : ?>
        <tr>
            <td><?= $serie['serie_id'] ?></td>
            <td><?= $serie['nom'] ?></td>
            <td><?= $serie['descriptions'] ?></td>
            <td><?= $serie['annee_debut'] ?></td>
            <td><?= $serie['annee_fin'] ?></td>
            <td><?= $serie['spin_off_id'] ?></td>
            <td>
                <a href="DetailSerie.php?id=<?= $serie['serie_id'] ?>">Détail</a>
                <a href="ModifierForSerie.php?id=<?= $serie['serie_id'] ?>">Modifier</a>
                <a href="SupprimerSerie.php?id=<?= $serie['serie_id'] ?>">Supprimer</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<p>
    <a href="../index.php">Accueil</a>
</p>
</body>
</html>
