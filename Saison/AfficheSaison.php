<?php
require_once'fonctionSaison.php';
$saison = getAllSaison();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../CSS/style.css">
    <title>Les Saisons</title>
</head>
<body>
<div class="insererSerie">
    <a href="InsererForSaison.php"> Inserer une nouvelle saison</a>
</div>
<table border="1" class="tableau_saison">
    <tr>
        <th>Saison_Id</th>
        <th>Numero De Saison</th>
        <th>Serie_Id</th>
        <th>Annee De Sortie</th>
        <th>Nombre D'Episode</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($saison as $saisons) : ?>
        <tr>
            <td><?= $saison['saison_id'] ?></td>
            <td><?= $saison['num_saison'] ?></td>
            <td><?= $saison['serie_id'] ?></td>
            <td><?= $saison['annee_sortie'] ?></td>
            <td><?= $saison['nbre_episodes'] ?></td>
            <td>
                <a href="DetailSaison.php?id=<?= $saison['saison_id'] ?>">Détail</a>
                <a href="ModifierForSaison.php?id=<?= $saison['saison_id'] ?>">Modifier</a>
                <a href="SupprimerSaison.php?id=<?= $saison['saison_id'] ?>">Supprimer</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<p>
    <a href="../index.php">Accueil</a>
</p>
</body>
</html>
