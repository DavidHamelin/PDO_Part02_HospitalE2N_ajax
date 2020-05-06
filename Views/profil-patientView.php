
<?php $title = "Profil du patient - PDO Part II" ?>

<?php ob_start(); ?>

<?php
$idGet = $_GET['ID'];
?>

    <header>
    <h2><i class="fas fa-file-medical-alt"></i> Profil du patient</h2>
    </header>


    <?php
    if(!isset($_POST['updatePatient']))
    {
    ?>
    <section class="container">
        <form method="POST" action="profil-patient.php?ID=<?= $idGet ?>">
        <table>
        <thead>
        <tr>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Date de naissance</th>
            <th>e-mail</th>
            <th>Téléphone</th>
        </tr>
        </thead>
        <tbody>
            <?php
            while ($donnees = $req->fetch())
            {
            ?>
                <tr>
                    <td> <input type="text" name="lastname" value="<?= htmlspecialchars($donnees['lastname']); ?>"> </td>
                    <td> <input type="text" name="firstname" value="<?= htmlspecialchars($donnees['firstname']); ?>">  </td>
                    <td> <input type="text" name="birthdate" value="<?= htmlspecialchars($donnees['birthdate']); ?>">  </td>
                    <td> <input type="text" name="mail" value="<?= htmlspecialchars($donnees['mail']); ?> "> </td>
                    <td> <input type="text" name="phone" value="<?= htmlspecialchars($donnees['phone']); ?> "> </td>
                </tr>
            <?php
            }
            $req->closeCursor();
            ?>
            
        </tbody>
        </table>
        <button class="btn btn-warning text-white mb-3" name="updatePatient" id="updatePatient" type="submit">Modifier</button>
        <a class="btn btn-secondary mb-3 text-white" href="liste-patients.php"> Retour </a> 
        
        </form>

        <aside>
        <h4><i class="fas fa-user-clock"></i> Rendez-vous planifié(s)</h4>

            <table>
                <thead>
                    <tr>
                        <th>RDV</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($donneesRdv = $reqRdv->fetch())
                    {
                        if (is_null($donneesRdv['dateHour']))
                        {
                            // var_dump($donneesRdv);
                            ?>
                            <tr>
                                <td>
                                    <h5 class="text-warning"> Pas de rendez-vous...</h5>
                                </td>
                            </tr>
                            <?php
                        }
                        else
                        {
                            ?>
                        <tr>
                            <td> <?= datetimeFr($donneesRdv['dateHour']); ?> </td>  
                        </tr>
                    <?php
                        }
                    }
                    $reqRdv->closeCursor();
                    ?>
                </tbody>
            </table>
        </aside>
    </section>
    <?php } ?>

<?php $content = ob_get_clean(); ?>

<?php require('Shared/_layout.php'); ?>
