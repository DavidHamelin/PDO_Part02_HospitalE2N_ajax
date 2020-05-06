<?php
ob_start();
require('model.php');
$bdd = GetDataBase();

if (!isset($_GET["searchBar"]) || ($_GET["searchBar"]) == null)
{
    if(isset($_GET["searchBar"]) && ($_GET["searchBar"]) == null)
    {
        header("refresh:0;url=liste-patients.php");
    }
    // $req = $bdd->query('SELECT id, lastname, firstname, birthdate, mail, phone FROM patients');
    $page = (!empty($_GET['page']) ? $_GET['page'] : 1);
    $limite = 5;
    $debut = ($page - 1) * $limite;
    $req = $bdd->prepare('SELECT SQL_CALC_FOUND_ROWS id, lastname, firstname, birthdate, mail, phone FROM patients LIMIT :limite OFFSET :debut');

    /* On lie ici une valeur à la requête, soit remplacer de manière sûre un marqueur par
    * sa valeur, nécessaire pour que la requête fonctionne. */
    $req->bindValue(
        'limite',         // Le marqueur est nommé « limite »
        $limite,         // Il doit prendre la valeur de la variable $limite
        PDO::PARAM_INT   // Cette valeur est de type entier
    );
    $req->bindValue('debut', $debut, PDO::PARAM_INT);
    /* Maintenant qu'on a lié la valeur à la requête, on peut l'exécuter */
    $req->execute();

    /* Ici on récupère le nombre d'éléments total. Comme c'est une requête, il ne
    * faut pas oublier qu'on ne récupère pas directement le nombre.
    * De plus, comme la requête ne contient aucune donnée client pour fonctionner,
    * on peut l'exécuter ainsi directement */
    $resultFoundRows = $bdd->query('SELECT found_rows()');
    /* On doit extraire le nombre du jeu de résultat */
    $nombredElementsTotal = $resultFoundRows->fetchColumn();
}

// Sans AJAX, avec submit :

// if (isset($_GET["searchBar"]))
// {
//     $toSearch = $_GET["searchBar"];
//     $req = $bdd->prepare('SELECT id, lastname, firstname, birthdate, mail, phone FROM patients 
//     WHERE lastname LIKE "%'.$toSearch.'%" 
//     OR firstname LIKE "%'.$toSearch.'%"
//     OR birthdate LIKE "%'.$toSearch.'%"
//     OR mail LIKE "%'.$toSearch.'%"
//     OR phone LIKE "%'.$toSearch.'%"
//     ');
//     $req->execute();
// }

require('Views/liste-patientsView.php');

if (isset($_POST["deletePatient"]))
{
    $id = $_POST["deletePatient"];
    $deleteQuery = "DELETE FROM appointments 
    WHERE appointments.idPatients = ' " . $id . "';
    DELETE FROM patients 
    WHERE patients.id = ' " . $id . "' 
     ";

    $req = $bdd->prepare($deleteQuery);
    $req->execute();
    echo '<h3 class="text-success text-center">Le patient a bien été supprimé !</h3>';
    header("refresh:1;url=liste-patients.php");
}

ob_end_flush();
