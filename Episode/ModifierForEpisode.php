<?php
require 'fonctionEpisode.php';
$id = $_GET['id'];
$episode= getEpisodeById($id);
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
    <h1>Bienvenu ! ici vous pouvez modifier  une episode :</h1>
</div>
<div>
    <form action="ModifierEpisode.php" method="post">

        <input type="hidden" name="episode_id" value="<?= $episode['episode_id'] ?>">
        <p>Numéro épisode :</p>
        <input type="number" name="num_episode" value="<?= $episode['num_episode'] ?>"><br>

        <p>Saison correspondante :</p>
        <select name="saison_id" required>
            <option value="">-- Choisissez la série et la saison --</option>

            <?php
            foreach ($toutesLesSaisons as $saison) {
                $sel = ($saison['saison_id'] == $episode['saison_id']) ? 'selected' : '';
                echo "<option value='{$saison['saison_id']}' $sel>{$saison['nom_serie']} - Saison {$saison['num_saison']}</option>";
            }
            ?>

        </select><br>


        <p>Date de diffusion:</p>
        <input type="date" name="date" value="<?= $episode['date_diffusion'] ?>" ><br>

        <p>Titre :</p>
        <input type="text" name="titre" value="<?= $episode['titre'] ?>"><br>

        <p>Durée :</p>
        <input type="text" name="duree" placeholder="HH:MM:SS" value="<?= $episode['duree'] ?>"><br>

        <p>Description :</p>
        <textarea name="descriptions" rows="5" cols="40"><?= $episode['descriptions'] ?></textarea><br>

        <p>
            <input type="submit" name="Inserer le formulaire" value="Inserer l'episode ">
        </p>

    </form>
</div>
<a href="AfficheEpisode.php">Retour</a>
</body>
</html>


