
<?php $title = "Liste des Rendez-Vous - PDO Part II" ?>

<?php ob_start(); ?>

    <header>
    <h2><i class="fas fa-clock"></i> Liste des Rendez-Vous</h2>
    </header>

    <?php
    if (!isset($_POST["deleteRdv"]))
    {
    ?>
    
    <section class="container">
    <a href="ajout-rendezvous.php" class="btn btn-info float-right mb-2"><i class="fas fa-user-clock"></i> Ajouter un RDV</a>

    <form action="liste-rendezvous.php" method="post">

    <table>
    <thead>
    <tr>
        <th>RDV</th>
        <th>Patient</th>
        <th></th>
        <th></th>

    </tr>
    </thead>
    <tbody>
        <?php
        while ($donnees = $req->fetch())
        {
        ?>
            <tr>
                
                <td class="font-weight-bold"> <?= datetimeFr($donnees['dateHour']); ?> </td> 
                <td> <?= $donnees['lastname'] . ' ' . $donnees['firstname']; ?> </td> 
                <td> <a class="btn btn-dark" href='rendezvous.php?ID=<?= $donnees["id"]; ?>'><i class="fas fa-info-circle"></i> Détails</a> </td>
                <td> <button class="btn btn-danger" type="submit" name="deleteRdv" id="deleteRdv" value="<?= $donnees["id"]; ?>"> X </button> </td>
                
                
            </tr>
        
        <?php
        }
        $req->closeCursor();
        ?>
        </tbody>
        </table>

        </form>

        </section>
    <?php } ?>


<?php $content = ob_get_clean(); ?>

<?php require('Shared/_layout.php'); ?>
