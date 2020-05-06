
<?php $title = "Détails du Rendez-vous - PDO Part II" ?>

<?php ob_start(); ?>

<?php
$idGet = $_GET['ID'];
?>

    <header>
    <h2><i class="fas fa-info-circle"></i> Détails du Rendez-Vous</h2>
    </header>


    <?php
    if(!isset($_POST['updateRdv']))
    {
    ?>
    <section class="container">
        <form method="POST" action="rendezvous.php?ID=<?= $idGet ?>">
        <table>
        <thead>
        <tr>
            <th></th>
            <th>Date du RDV</th>
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
                    <td><span id="modif" class="btn-sm btn-info "> modifier le RDV </span></td>
                    <td>
                        <span id="showDateHour"><?= datetimeFr($donnees['dateHour']); ?> </span>
                        <input type="datetime-local" name="dateHour" id="dateHour"/> 
                    </td> 
                    
                    <td> <span><?= $donnees['lastname']; ?> </span> </td>
                    <td> <span><?= $donnees['firstname']; ?> </span> </td>
                    <td> <span><?= $donnees['birthdate']; ?> </span> </td>
                    <td> <span><?= $donnees['mail']; ?> </span> </td>
                    <td> <span> <?= $donnees['phone']; ?> </span> </td>
                </tr>
            <?php
            }
            $req->closeCursor();
            ?>
            
        </tbody>
        </table>
        <button class="btn btn-warning text-white mb-3" name="updateRdv" id="updateRdv" type="submit">Enregistrer</button>
        <!-- <button class="btn btn-danger mb-3" name="deleteRdv" id="deleteRdv" type="submit">Supprimer</button> -->
        <a class="btn btn-secondary mb-3 text-white" href="liste-rendezvous.php"> Retour </a> 
        
        </form>
    </section>
    <?php } ?>

<?php $content = ob_get_clean(); ?>

<?php require('Shared/_layout.php'); ?>

<script>
    $("document").ready( function () {
        $("#dateHour").css("display", "none");
        $("#updateRdv").css("display", "none");
        $("#modif").click( function () {
            $("#dateHour").toggle();
            $("#showDateHour").toggle();
            $("#updateRdv").toggle();
            
        });
        
    });
</script>