<?php
ob_start();
require('model.php');
$bdd = GetDataBase();

$req1 = $bdd->query('SELECT id, lastname, firstname FROM patients');

require('Views/ajout-rendezvousView.php');

// function datefr2en($mydate){
//     @list($jour,$mois,$annee)=explode('-',$mydate);
//     return @date('Y-m-d',mktime(0,0,0,$mois,$jour,$annee));
//  }

if(isset($_POST['addRdv']))
{
    if( isset($_POST['listPatient']) && isset($_POST['dateRdv']) )
    {
        $idPatients = $_POST['listPatient'];
        $dateHour = $_POST['dateRdv'];
        
        $checkDoublonQuery = "SELECT dateHour, idPatients, lastname, firstname FROM appointments
        LEFT JOIN patients ON appointments.idPatients = patients.id
        WHERE dateHour = :dateHour ";
        // idPatients = :idPatients AND
        $reqDoublon = $bdd->prepare($checkDoublonQuery);
        $reqDoublon->execute(array(
            // 'idPatients' => $idPatients,
            'dateHour' => $dateHour
            ));

        $checkDoublon = $reqDoublon->fetchAll();
        if (count($checkDoublon) == 0) {
            // echo "aucune ligne renvoyée";
            // var_dump($dateHour);
            $req = $bdd->prepare('INSERT INTO appointments(dateHour, idPatients) VALUES(:dateHour, :idPatients)');
            $req->execute(array(
                'dateHour' => $dateHour,
                'idPatients' => $idPatients,
                ));
            
            echo '<h3 class="text-success text-center">Le rendez-vous a bien été enregistré !</h3>';
            header("refresh:1;url=liste-rendezvous.php");
        } 
        else
        {
            foreach ($checkDoublon as $row) 
            {
                // var_dump($row);
                echo '<h3 class="text-center text-danger">Le créneau '.datetimeFrWithT($dateHour).' est déja pris par '.$row['lastname'].' '.$row['firstname'].' !</h3>' ;
                // traiter $row
            }
        }
        
    }
    
}
ob_end_flush();