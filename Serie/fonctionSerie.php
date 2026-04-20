<?php
require_once __DIR__ . '/../identifiant.php';
require_once __DIR__ . '/../connexion.php';


/**
 *fonction qui permet de recuperer une serie grace a son identifiant
 * pg_fetch_assoc() permet de recuperer le resultat apres execution de la requete
 * */
function getSerieById(string $id): array
{
    $ptrDB = connexion();
    $query = " SELECT * FROM serie WHERE serie_id = $1 ";
    $resultat = pg_prepare($ptrDB, "getSerieById", $query);
    $ptrQuery = pg_execute($ptrDB, "getSerieById", array($id));

    if (isset($ptrQuery)) {
        $resultat = pg_fetch_assoc($ptrQuery);
    }
    if (empty($resultat)) {
        $resultat = array("message" => "Identifiant de serie non valide : $id");
    }
    pg_free_result($ptrQuery); //libere toutes les ressources
    pg_close($ptrDB); // ferme la connexion

    return $resultat;
}

/**
 * fonction qui recupere toutes les series de notre base de donnée
 * pg_fetch_all() recupere toutes les series apres une execution reussi de la requete
 * */
function getAllSerie(): array
{
    $ptrDB = connexion();
    $query = " SELECT * FROM serie";
    $resultat = pg_prepare($ptrDB, "getAllSerie", $query);
    $ptrQuery = pg_execute($ptrDB, "getAllSerie", array());
    if (isset($ptrQuery)) {
        $resultat = pg_fetch_all($ptrQuery);
    }
    pg_free_result($ptrQuery);
    pg_close($ptrDB);
    return $resultat;
}

/**
 * fonction qui permet de inserer une nouvelle serie
 * pg_last_error nous renvoie l'erreur exacte sur notre ecran
 *  dans notre condition if on recupere l'id de la  nouvelle serie via la variable nouvelleId
 * qui nous permettra d'afficher la serie inserer via la fonction getSerieById($nouvelleId)
 */
function insertSerie(array $Serie): array
{
    $ptrDB = connexion();
    $query = " INSERT INTO serie (nom,descriptions,annee_debut,annee_fin,spin_off_id)
               VALUES ($1,$2,$3,$4,$5)
               RETURNING serie_id";
    pg_prepare($ptrDB, "insertSerie", $query);
    // Si la valeur est "-1" (ou vide), on la transforme en 'null' pour le SQL
    $vraiSpinOffId = ($Serie["spin_off_id"] == "-1" || $Serie["spin_off_id"] == "") ? null : $Serie["spin_off_id"];
    $ptrQuery = pg_execute($ptrDB, "insertSerie", array(
        $Serie["nom"],
        $Serie["descriptions"],
        $Serie["annee_debut"],
        $Serie["annee_fin"],
        $vraiSpinOffId
    ));
    if ($ptrQuery) {
        echo " Inserer avec succes !";
        $ligne = pg_fetch_assoc($ptrQuery);
        $nouvelleId = $ligne["serie_id"];
    } else {
        echo "Erreur d'insertion" . pg_last_error($ptrDB);
        return []; // retourne un tableau vide si $nouvelle_id est indefinie
    }
    pg_free_result($ptrQuery);
    pg_close($ptrDB);
    return getSerieById($nouvelleId);
}

/** Fonction qui met a jour  une serie elle prend en parametre un tableau
 * et retourne un tableau avec les different variable inserer
 */
function updateSerie(array $Serie): array
{
    $ptrDB = connexion();
    $query = "UPDATE serie SET nom = $2, descriptions = $3,annee_debut=$4, annee_fin= $5, spin_off_id=$6
               WHERE serie_id = $1";

    pg_prepare($ptrDB, "reqPrepUpdate", $query);
    $vraiSpinOffId = ($Serie["spin_off_id"] == "-1" || $Serie["spin_off_id"] == "") ? null : $Serie["spin_off_id"];
    $ptrQuery = pg_execute($ptrDB, "reqPrepUpdate", array(
        $Serie["serie_id"],
        $Serie["nom"],
        $Serie["descriptions"],
        $Serie["annee_debut"],
        $Serie["annee_fin"],
        $vraiSpinOffId
    ));
    if ($ptrQuery) {
        echo "Modifié avec succès la serie a l'id  = " . $Serie["serie_id"];// message lorsque pg_execute s'execute
        echo "<br/>";

    } else {
        echo "Erreur : mise a jour echoué " . pg_last_error($ptrDB);
    }
    pg_free_result($ptrQuery);
    pg_close($ptrDB);
    return getSerieById($Serie["serie_id"]);
}

/**
 * fonction delete qui permet de supprimer une serie qui prend en
 * parametre l'id de la serie  et renvoie un message de succes ou un message d'erreur
 * suivi de l'erreur exacte grace a pg_last_error
 */
function deleteSerie(string $id): void
{
    $ptrDB = connexion();
    $query = " DELETE FROM serie WHERE serie_id = $1";
    pg_prepare($ptrDB, "delete", $query);
    $ptrQuery = pg_execute($ptrDB, "delete", array($id));

    if ($ptrQuery) {
        echo "supprimer avec succes : $id";
    } else {
        echo " erreur de suppression" . pg_last_error($ptrDB);
    }
    pg_free_result($ptrQuery);
    pg_close($ptrDB);
}