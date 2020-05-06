<?php

require('model.php');
$bdd = GetDataBase();

if (isset($_GET["searchBar"]))
{
    $toSearch = $_GET["searchBar"];
    $req = $bdd->prepare('SELECT id, lastname, firstname, birthdate, mail, phone FROM patients 
    WHERE lastname LIKE "%'.$toSearch.'%" 
    OR firstname LIKE "%'.$toSearch.'%"
    OR birthdate LIKE "%'.$toSearch.'%"
    OR mail LIKE "%'.$toSearch.'%"
    OR phone LIKE "%'.$toSearch.'%"
    ');
    $req->execute();

}

?>

<table class="table table-bordered table-striped table-hover mt-1 text-center">
    <thead>
        <tr>
            <th>Patient</th>
            <th>Date de naissance</th>
            <th>e-mail</th>
            <th>Téléphone</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php
        $test = $req->rowCount();

        if ($test >= 1)
        {
            while ($donnees = $req->fetch())
            {
            ?>
                <tr>
                    <td class="font-weight-bold"> <?= htmlspecialchars($donnees['lastname']); ?> <?= htmlspecialchars($donnees['firstname']); ?> </td>
                    <td> <?= htmlspecialchars($donnees['birthdate']); ?> </td> 
                    <td> <?= htmlspecialchars($donnees['mail']); ?> </td>
                    <td> <?= htmlspecialchars($donnees['phone']); ?> </td>
                    <td> <a class="btn btn-dark" href='profil-patient.php?ID=<?= htmlspecialchars($donnees["id"]); ?>'><i class="fas fa-file-medical-alt"></i> Profil</a> </td>
                    <td> <button class="btn btn-danger" type="submit" name="deletePatient" id="deletePatient" value="<?= $donnees["id"]; ?>"> X </button> </td>
                </tr>
            
            <?php
            }
            $req->closeCursor();
        }
        else
        {
            ?> 
            <tr>
                <td  colspan="6" class="text-danger">Aucun patient ne correspond à votre recherche...</td>
                </tr> <?php
        }
        ?>
    </tbody>
</table>

