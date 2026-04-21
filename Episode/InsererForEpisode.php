<?php
require 'fonctionEpisode.php';
$toutesLesSaisons = getAllSaisonAvecSerie(); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../CSS/style.css">
    <title>Insertion d'une nouvelle épisode</title>
</head>
<body>
<div>
    <h1>Bienvenu ! ici vous pouvez inserer une episode :</h1>
</div>
<div>
    <form action="InsererEpisode.php" method="post">
        <p>Numéro épisode :</p>
        <input type="number" name="num_episode" required><br>

        <p>Saison correspondante :</p>
        <select name="saison_id" required>
            <option value="">-- Choisissez la série et la saison --</option>

            <?php

            foreach ($toutesLesSaisons as $saison) {
                echo "<option value='{$saison['saison_id']}'>{$saison['nom_serie']} - Saison {$saison['num_saison']}</option>";
            }
            ?>

        </select><br>


        <p>Date de diffusion:</p>
        <input type="date" name="date" required><br>

        <p>Titre :</p>
        <input type="text" name="titre" required><br>

        <p>Durée :</p>
        <input type="text" name="duree" placeholder="HH:MM:SS" required><br>

        <p>Description :</p>
        <textarea name="descriptions" rows="5" cols="40"></textarea><br>

        <p>
            <input type="submit" name="Inserer le formulaire" value="Inserer l'episode ">
        </p>

    </form>
</div>
</body>
</html>

