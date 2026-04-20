<?php
require_once 'fonctionSaison.php';
require_once '../Serie/fonctionSerie.php';


$id = $_GET['id'];
$saison=getSaisonById($id);
$toutesLesSeries = getAllSerie();
?>

    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../CSS/style.css">
        <title>Insertion d'une nouvelle saison</title>
    </head>
    <body>
    <div>
        <h1>Modifier la saison n° <?= $saison['num_saison'] ?></h1>
    </div>
    <div>
        <form action="ModifierSaison.php" method="post">

            <input type="hidden" name="saison_id" value="<?= $saison['saison_id'] ?>">

            <p>Numéro de la saison :</p>
            <input type="number" name="num_saison" value="<?= $saison['num_saison'] ?>" required><br>

            <p>Série correspondante :</p>
            <select name="serie_id" required>
                <option value="">-- Choisissez une série --</option>
                <?php
                foreach ($toutesLesSeries as $serie) {
                    // Si la série du menu déroulant correspond à la série de cette saison, on la présélectionne
                    $selection = ($serie['serie_id'] == $saison['serie_id']) ? 'selected' : '';
                    echo '<option value="' . $serie['serie_id'] . '" ' . $selection . '>' . $serie['nom'] . '</option>';
                }
                ?>
            </select><br>

            <p>Date de sortie:</p>
            <input type="date" name="date" value="<?= $saison['annee_sortie'] ?>"><br>

            <p>Nombres d'épisodes :</p>
            <input type="number" name="nbre_episodes" min="1" value="<?= $saison['nbre_episodes'] ?>"><br>

            <p>
                <input type="submit" value="Modifier la saison">
            </p>

        </form>
    </div>
    <a href="AfficheSaison.php">Retour</a>
    </body>
    </html>

