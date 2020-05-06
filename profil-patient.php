<?php
ob_start();
require('model.php');
$bdd = GetDataBase();
$queryPatient = "SELECT lastname, firstname, birthdate, mail, phone FROM patients 
WHERE patients.id = ' " . $_GET["ID"] . "'
";
$req = $bdd->query($queryPatient);

$queryRdv = "SELECT patients.id, appointments.dateHour FROM patients 
LEFT JOIN appointments on appointments.idPatients = patients.id
WHERE patients.id = ' " . $_GET["ID"] . "'
";
$reqRdv = $bdd->query($queryRdv);

require('Views/profil-patientView.php');

 $idToKeep = $_GET['ID'];
// var_dump($idToKeep);

if(isset($_POST['updatePatient']))
{ 
    if(isset($_POST['lastname']) && isset($_POST['firstname']) && isset($_POST['birthdate']) && isset($_POST['mail']) && isset($_POST['phone']) )
    {
    
        $id = $idToKeep;
        $lastname = $_POST['lastname'];
        $firstname = $_POST['firstname'];
        $birthdate = $_POST['birthdate'];
        $mail = $_POST['mail'];
        $phone = $_POST['phone'];
        $queryUpdatePatient = "UPDATE patients SET lastname = :lastname, firstname = :firstname, birthdate = :birthdate, mail = :mail, phone = :phone WHERE id = $id";
    $req = $bdd->prepare($queryUpdatePatient);
    $req->execute(array(
        'lastname' => $lastname,
        'firstname' => $firstname,
        'birthdate' => $birthdate,
        'mail' => $mail,
        'phone' => $phone
        ));
        echo '<h3 class="text-success text-center">Le patient a bien été modifié !</h3>';
        header("refresh:1;url=profil-patient.php?ID=".$id."");
    }
}
ob_end_flush();