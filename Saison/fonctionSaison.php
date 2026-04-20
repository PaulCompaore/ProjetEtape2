<?php
require_once __DIR__ . '/../identifiant.php';
require_once __DIR__ . '/../connexion.php';


/**
 *fonction qui permet de recuperer une saison grace a son identifiant
 * pg_fetch_assoc() permet de recuperer le resultat apres execution de la requete
 *
 * */
function getSaisonById(string $id): array
{
    $ptrDB = connexion();
    $query = " SELECT * FROM saison WHERE saison_id = $1 ";
    $resultat = pg_prepare($ptrDB, "getSaisonById", $query);
    $ptrQuery = pg_execute($ptrDB, "getSaisonById", array($id));

    if (isset($ptrQuery)) {
        $resultat = pg_fetch_assoc($ptrQuery);
    }
    if (empty($resultat)) {
        $resultat = array("message" => "Identifiant de saison non valide : $id");
    }
    pg_free_result($ptrQuery); //libere toutes les ressources
    pg_close($ptrDB); // ferme la connexion

    return $resultat;
}

/**
 * fonction qui recupere toutes les saisonss de notre base de donnée
 * pg_fetch_all() recupere toutes les series apres une execution reussi de la requete
 * */
function getAllSaison(): array
{
    $ptrDB = connexion();
    $query = " SELECT * FROM saison";
    $resultat = pg_prepare($ptrDB, "getAllSaison", $query);
    $ptrQuery = pg_execute($ptrDB, "getAllSaison", array());
    if (isset($ptrQuery)) {
        $resultat = pg_fetch_all($ptrQuery);
    }
    pg_free_result($ptrQuery);
    pg_close($ptrDB);
    return $resultat;
}

/**
 * fonction qui permet de inserer une nouvelle saison
 * pg_last_error nous renvoie l'erreur exacte sur notre ecran
 *  dans notre condition if on recupere l'id de la  nouvelleaison via la variable nouvelleId
 * qui nous permettra d'afficher la saison inserer via la fonction getSaisonById($nouvelleId)
 */
function insertSaison(array $Saison): array
{
    $ptrDB = connexion();
    $query = "INSERT INTO saison (num_saison, annee_sortie, nbre_episodes, serie_id)
              VALUES ($1, $2, $3, $4)
                RETURNING saison_id";

    pg_prepare($ptrDB, "insertSaison", $query);
    $ptrQuery = pg_execute($ptrDB, "insertSaison", array(
        $Saison["num_saison"],
        $Saison["annee_sortie"],
        $Saison["nbre_episodes"],
        $Saison["serie_id"]
    ));

    if ($ptrQuery) {
        echo "Inséré avec succès !";
        $ligne = pg_fetch_assoc($ptrQuery);// on recupere dans la variable ligne  la ligne entirer de la saison ajouter
        $nouvelleId = $ligne["saison_id"];// puis on stocke son id dans nouvelle id
    } else {
        echo "Erreur : " . pg_last_error($ptrDB); // renvoie l'erreur exact
    }

    pg_free_result($ptrQuery);
    pg_close($ptrDB);
    return getSaisonById($nouvelleId); // renvoi la saison inserer
}

/** Fonction qui met a jour  une saison elle prend en parametre un tableau
 * et retourne un tableau avec les different variable inserer
 */
function updateSaison(array $Saison): array
{
    $ptrDB = connexion();
    $query = "UPDATE saison SET num_saison = $2, annee_sortie = $3,nbre_episodes=$4, serie_id=$5
               WHERE saison_id = $1";

    pg_prepare($ptrDB, "updateSaison", $query);
    $ptrQuery = pg_execute($ptrDB, "updateSaison", array(
        $Saison["saison_id"],
        $Saison["num_saison"],
        $Saison["annee_sortie"],
        $Saison["nbre_episodes"],
        $Saison["serie_id"]
    ));
    if ($ptrQuery) {
        echo "Modifié avec succès la saison a l'id = " . $Saison["saison_id"];// message lorsque pg_execute s'execute
        echo "<br/>";
    } else {
        echo "Erreur : " . pg_last_error($ptrDB);
    }

    pg_free_result($ptrQuery);
    pg_close($ptrDB);
    return getSaisonById($Saison["saison_id"]);
}

/**
 * fonction delete qui permet de supprimer une saison qui prend en
 * parametre l'id de la saison  et renvoie un message de succes ou un message d'erreur
 * suivi de l'erreur exacte grace a pg_last_error()
 */
function deleteSaison(string $id): void
{
    $ptrDB = connexion();
    $query = " DELETE FROM saison WHERE saison_id = $1";
    pg_prepare($ptrDB, "deleteSaison", $query);
    $ptrQuery = pg_execute($ptrDB, "deleteSaison", array($id));

    if ($ptrQuery) {
        echo "supprimer avec succes : $id";
    } else {
        echo " erreur de connexion:" . pg_last_error($ptrDB);
    }
    pg_free_result($ptrQuery);
    pg_close($ptrDB);
}