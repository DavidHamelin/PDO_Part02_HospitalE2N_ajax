<?php
ob_start();
require('model.php');
$bdd = GetDataBase();
require('Views/ajout-patientView.php');

if(isset($_POST['addPatient']))
{
    if( isset($_POST['lastname']) && isset($_POST['firstname']) && isset($_POST['birthdate']) && isset($_POST['mail']) && isset($_POST['phone']) )
    {
        $lastname = $_POST['lastname'];
        $firstname = $_POST['firstname'];
        $birthdate = $_POST['birthdate'];
        $mail = $_POST['mail'];
        $phone = $_POST['phone'];

        $isValid = true;
        $regexName = "#^[a-zA-Z-'éèëëïàù ]+$#";
        $regexDoB = "#(([0-9]+)-([0-9]+)-([0-9]+))|(([0-9]+)\/([0-9]+)\/([0-9]+))#";
        $regexPhone = "#^(?:(?:\+|00)33|0)\s*[1-9](?:[\s.-]*\d{2}){4}$#";
        if ((!preg_match($regexName, $lastname)) || $lastname == null)
        {
            $isValid = false;
            echo '<h3 class="text-danger text-center">Nom invalide !</h3>';
            header("refresh:1;url=ajout-patient.php");
        }
        if ((!preg_match($regexName, $firstname)) || $firstname == null)
        {
            $isValid = false;
            echo '<h3 class="text-danger text-center">Prénom invalide !</h3>';
            header("refresh:1;url=ajout-patient.php");
        }
        if ((!preg_match($regexDoB, $birthdate)) || $birthdate == null)
        {
            $isValid = false;
            echo '<h3 class="text-danger text-center">'.$birthdate.' : Date de naissance invalide !</h3>';
            // var_dump($birthdate);
            header("refresh:1;url=ajout-patient.php");
        }
        if ((!filter_var($mail, FILTER_VALIDATE_EMAIL)) || $mail == null)
        {
            $isValid = false;
            echo '<h3 class="text-danger text-center">Mail invalide !</h3>';
            header("refresh:1;url=ajout-patient.php");
        }
        if ((!preg_match($regexPhone, $phone)) || $phone == null)
        {
            $isValid = false;
            echo '<h3 class="text-danger text-center">Numéro de téléphone invalide !</h3>';
            header("refresh:1;url=ajout-patient.php");
        }
        if ($isValid == true)
        {
            $req = $bdd->prepare('INSERT INTO patients(lastname, firstname, birthdate, mail, phone) VALUES(:lastname, :firstname, :birthdate, :mail, :phone)');
            $req->execute(array(
                'lastname' => $lastname,
                'firstname' => $firstname,
                'birthdate' => $birthdate,
                'mail' => $mail,
                'phone' => $phone
                ));

            echo '<h3 class="text-success text-center">Le patient a bien été enregistré !</h3>';
            header("refresh:1;url=liste-patients.php");
        }

    }
    
}
ob_end_flush();