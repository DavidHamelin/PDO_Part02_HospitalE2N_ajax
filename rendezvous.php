<?php
ob_start();
require('model.php');
$bdd = GetDataBase();
$queryThisRdv = "SELECT appointments.id, appointments.idPatients, appointments.dateHour, patients.lastname, patients.firstname, patients.birthdate, patients.mail, patients.phone FROM appointments
LEFT JOIN patients on patients.id = appointments.idPatients WHERE appointments.id = ' " . $_GET["ID"] . "'";
$req = $bdd->query($queryThisRdv);

require('Views/rendezvousView.php');

 $idToKeep = $_GET['ID'];
// var_dump($idToKeep);

if(isset($_POST['updateRdv']))
{ 
    if(isset($_POST['dateHour']) )
    {
    
        $id = $idToKeep;
        $dateHour = $_POST['dateHour'];

        $queryUpdateRdv = "UPDATE appointments SET dateHour = :dateHour WHERE appointments.id = $id";
    $req = $bdd->prepare($queryUpdateRdv);
    $req->execute(array(
        'dateHour' => $dateHour

        ));
        echo '<h3 class="text-success text-center">Le rendez-vous a bien été modifié !</h3>';
        header("refresh:1;url=rendezvous.php?ID=".$id."");
    }
}
ob_end_flush();
