<?php
ob_start();
require('model.php');
$bdd = GetDataBase();
$req = $bdd->query('SELECT idPatients, appointments.id, dateHour, lastname, firstname FROM appointments
LEFT JOIN patients on patients.id = appointments.idPatients ORDER BY appointments.dateHour ASC');

require('Views/liste-rendezvousView.php');

if (isset($_POST["deleteRdv"]))
{
    $deleteQuery = "DELETE FROM appointments WHERE id = ' " . $_POST["deleteRdv"] . "' ";

    $req = $bdd->prepare($deleteQuery);
    $req->execute();
    echo '<h3 class="text-success text-center">Le rendez-vous a bien été supprimé !</h3>';
    // header('Location: liste-rendezvous.php');
    header("refresh:1;url=liste-rendezvous.php");
}
ob_end_flush();

// /* Configure le script en français */
// setlocale (LC_TIME, 'fr_FR','fra');
// //Définit le décalage horaire par défaut de toutes les fonctions date/heure  
// date_default_timezone_set("Europe/Paris");
// //Definit l'encodage interne
// mb_internal_encoding("UTF-8");
// //Convertir une date US en françcais
// function dateFr($dateHour){
//     @list($date, $hour)=explode(' ',$dateHour);
// return strftime('%d-%m-%Y',strtotime($date)) . " " . $hour;
// }

