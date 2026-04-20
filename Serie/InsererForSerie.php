<?php
require_once 'fonctionSerie.php';
$toutesLesSeries = getAllSerie();

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../CSS/style.css">
    <title>Insertion d'une nouvelle serie</title>
</head>
<body>
<div>
    <h1>Bienvenu ! ici vous pouvez inserer une serie :</h1>
</div>
<div>
    <form action="InsererSerie.php" method="post">
        <p>Nom :</p>
        <input type="text" name="nom" required><br>

        <p>Description :</p>
        <textarea name="descriptions" rows="5" cols="40"></textarea><br>

        <p>Annee de debut :</p>
        <input type="date" name="annee_debut" required><br>

        <p>Annee de fin:</p>
        <input type="date" name="annee_fin" required><br>

        <p> Quel Spin_off_id :</p>
        <select name="serie_id" required>
            <option value="">-- Choisissez une série --</option>
            <option value="-1">Aucun spin-off</option>
            <?php
            foreach ($toutesLesSeries as $serie) {
                echo '<option value="' . $serie['serie_id'] . '">' . $serie['nom'] . '</option>';
            }
            ?>
        </select><br>

        <p>
            <input type="submit" name="Inserer le formulaire" value="Inserer le formulaire ">
        </p>

    </form>
</div>
<a href="AfficheSerie.php">Retour</a>
</body>
</html>

