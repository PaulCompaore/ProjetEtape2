<?php
require_once 'fonctionSaison.php';
require_once '../Serie/fonctionSerie.php';
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
        <h1>Bienvenu ! ici vous pouvez inserer une saison :</h1>
    </div>
    <div>
        <form action="InsererSaison.php" method="post">
            <p>Numéro de la saison :</p>
            <input type="number" name="num_saison" required><br>

            <p>Série correspondante :</p>
            <select name="serie_id" required>
                <option value="">-- Choisissez une série --</option>
                <?php
                foreach ($toutesLesSeries as $serie) {
                    echo '<option value="' . $serie['serie_id'] . '">' . $serie['nom'] . '</option>';
                }
                ?>
            </select><br>

            <p>Annee de sortie:</p>
            <input type="date" name="date" required><br>

            <p>Nombres d'episode :</p>
            <input type="number" name="nbre_episodes" min="1" required><br>

            <p>
                <input type="submit" name="Inserer le formulaire" value="Inserer le formulaire ">
            </p>

        </form>
    </div>
    <a href="AfficheSaison.php">Retour</a>
    </body>
    </html>
<?php
