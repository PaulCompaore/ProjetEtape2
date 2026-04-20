<?php
require_once __DIR__ . '/../identifiant.php';
require_once __DIR__ . '/../connexion.php';

/**
 *fonction qui permet de recuperer une episode grace a son identifiant
 * pg_fetch_assoc() permet de recuperer le resultat apres execution de la requete
 *
 * */
function getEpisodeById(string $id): array
{
    $ptrDB = connexion();
    $query = " SELECT * FROM episode WHERE episode_id = $1 ";
    $resultat = pg_prepare($ptrDB, "getEpisodeById", $query);
    $ptrQuery = pg_execute($ptrDB, "getEpisodeById", array($id));

    if (isset($ptrQuery)) {
        $resultat = pg_fetch_assoc($ptrQuery);
    }
    if (empty($resultat)) {
        $resultat = array("message" => "Identifiant de episode non valide : $id");
    }
    pg_free_result($ptrQuery); //libere toutes les ressources
    pg_close($ptrDB); // ferme la connexion

    return $resultat;
}

/**
 * fonction qui recupere toutes les episodes de notre base de donnée
 * pg_fetch_all() recupere toutes les series apres une execution reussi de la requete
 * */
function getAllEpisode(): array
{
    $ptrDB = connexion();
    $query = " SELECT * FROM episode";
    $resultat = pg_prepare($ptrDB, "getAllEpisode", $query);
    $ptrQuery = pg_execute($ptrDB, "getAllEpisode", array());
    if (isset($ptrQuery)) {
        $resultat = pg_fetch_all($ptrQuery);
    }
    pg_free_result($ptrQuery);
    pg_close($ptrDB);
    return $resultat;
}

/**
 * fonction qui permet de inserer une nouvelle episode
 * pg_last_error nous renvoie l'erreur exacte sur notre ecran
 *  dans notre condition if on recupere l'id de la  nouvelle epsisode via la variable nouvelleId
 * qui nous permettra d'afficher l'episode inserer via la fonction getEpisodeById($nouvelleId)
 */
function insertEpisode(array $Episode): array
{
    $ptrDB = connexion();
    $query = "INSERT INTO episode (num_episode, saison_id, date_diffusion, titre, duree, descriptions)
              VALUES ($1, $2, $3, $4, $5, $6)
              RETURNING episode_id";

    pg_prepare($ptrDB, "insertEpisode", $query);
    $ptrQuery = pg_execute($ptrDB, "insertEpisode", array(
        $Episode["num_episode"],
        $Episode["saison_id"],
        $Episode["date_diffusion"],
        $Episode["titre"],
        $Episode["duree"],
        $Episode["descriptions"]
    ));

    if ($ptrQuery) {
        echo "Inséré avec succès !";
        $ligne = pg_fetch_assoc($ptrQuery);// on recupere dans la variable ligne  la ligne entiere de la saison ajouter
        $nouvelleId = $ligne["episode_id"];// puis on stocke son id dans nouvelle id
    } else {
        echo "Erreur : " . pg_last_error($ptrDB);
    }
    pg_free_result($ptrQuery);
    pg_close($ptrDB);
    return getEpisodeById($nouvelleId);
}

/** Fonction qui met a jour  une episode elle prend en parametre un tableau
 * et retourne un tableau avec les different variable inserer
 */
function updateEpisode(array $Episode): array
{
    $ptrDB = connexion();
    $query = "UPDATE episode SET num_episode = $2, duree = $3, descriptions = $4, date_diffusion= $5,
              saison_id=$6, titre=$7
               WHERE episode_id = $1";


    pg_prepare($ptrDB, "Update", $query);
    $ptrQuery = pg_execute($ptrDB, "Update", array(
        $Episode["episode_id"],
        $Episode["num_episode"],
        $Episode["duree"],
        $Episode["descriptions"],
        $Episode["date_diffusion"],
        $Episode["saison_id"],
        $Episode["titre"]
    ));
    if ($ptrQuery) {
        echo "Modifié avec succès : " . $Episode["episode_id"];// message lorsque pg_execute s'execute
        echo "<br/>";
    } else {
        echo "Erreur : " . pg_last_error($ptrDB);
    }

    //$result = getEpisodeById($Episode["episode_id"]);
    pg_free_result($ptrQuery);// rehydrater  pour eviter les erreurs
    pg_close($ptrDB);
    return getEpisodeById($Episode["episode_id"]);
}

/**
 * fonction delete qui permet de supprimer une episode qui prend en
 * parametre l'id de l'episode  et renvoie un message de succes ou un message d'erreur
 * suivi de l'erreur exacte grace a pg_last_error()
 */
function deleteEpisode(string $id): void
{
    $ptrDB = connexion();
    $query = " DELETE FROM episode WHERE episode_id = $1";
    pg_prepare($ptrDB, "delete", $query);
    $ptrQuery = pg_execute($ptrDB, "delete", array($id));

    if ($ptrQuery) {
        echo "supprimer avec succes :" . $id;
    } else {
        echo " erreur de connexion:" . pg_last_error($ptrDB);
    }
    pg_free_result($ptrQuery);
    pg_close($ptrDB);
}

/** Fontion getAllsaisonavecserie () ici permet de recuperer toutes les saison des differentes serie
 * elle nous permet ici d'afficher une liste deroulante pour selection la
 * saison de la serie dans laquelle on ajoute une nouvelle episode
 */
function getAllSaisonAvecSerie()
{
    $ptrDB = connexion();
    $resultat = [];

    $query = "SELECT saison.saison_id, saison.num_saison, serie.nom AS nom_serie
              FROM saison
              JOIN serie ON saison.serie_id = serie.serie_id
              ORDER BY serie.nom, saison.num_saison";


    pg_prepare($ptrDB, "getAllSaisonAvecSerie", $query);
    $ptrQuery = pg_execute($ptrDB, "getAllSaisonAvecSerie", array());

    // On vérifie que la requête a bien fonctionné
    if ($ptrQuery !== false) {
        $lignes = pg_fetch_all($ptrQuery);
        // pg_fetch_all renvoie false si le tableau est vide
        if ($lignes !== false) {
            $resultat = $lignes;
        }
        pg_free_result($ptrQuery);
    }

    pg_close($ptrDB);

    return $resultat;
}

function getEpisodesBySaisonId(string $saison_id): array
{
    $ptrDB = connexion();
    // On sélectionne les épisodes liés à cette saison
    $query = "SELECT * FROM episode WHERE saison_id = $1 ORDER BY num_episode ASC";

    pg_prepare($ptrDB, "EpisodesSaison", $query);
    $ptrQuery = pg_execute($ptrDB, "EpisodesSaison", array($saison_id));

    $episodes = array(); // On prépare un tableau vide

    if ($ptrQuery) {
        // Tant qu'il y a des épisodes trouvés, on les ajoute dans notre tableau
        while ($ligne = pg_fetch_assoc($ptrQuery)) {
            $episodes[] = $ligne;
        }
    }

    pg_free_result($ptrQuery);
    pg_close($ptrDB);

    return $episodes; // On renvoie la liste complète (qui peut être vide)
}