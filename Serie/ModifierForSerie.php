<?php
require_once 'fonctionSerie.php';

$id = $_GET['id'];
$serie = getSerieById($id);
$toutesLesSeries = getAllSerie();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../CSS/style.css">
    <title>Modifier une série</title>
</head>
<body>
<h1>Modifier la série : <?= $serie['nom'] ?></h1>

<form action="ModifierSerie.php" method="post">
    <input type="hidden" name="serie_id" value="<?= $serie['serie_id'] ?>">

    <p>Nom :</p>
    <input type="text" name="nom" value="<?= $serie['nom'] ?>" required><br>

    <p>Description :</p>
    <textarea name="descriptions" rows="5" cols="40"><?= $serie['descriptions'] ?></textarea><br>

    <p>Annee de debut :</p>
    <input type="date" name="annee_debut" value="<?= $serie['annee_debut'] ?>" required><br>

    <p>Annee de fin :</p>
    <input type="date" name="annee_fin" value="<?= $serie['annee_fin'] ?>" required><br>

    <p>Spin-off :</p>
    <select name="serie_id_spinoff">
        <option value="">-- Choisissez --</option>
        <?php foreach ($toutesLesSeries as $s) : ?>
            <option value="<?= $s['serie_id'] ?>"
                <?= $s['serie_id'] == $serie['spin_off_id'] ? 'selected' : '' ?>>
                <?= $s['nom'] ?>
            </option>
        <?php endforeach; ?>
    </select><br>

    <input type="submit" value="Modifier">
</form>
</body>
</html>