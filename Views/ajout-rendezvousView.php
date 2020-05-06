
<?php $title = "Ajout Rendez-vous - PDO Part II" ?>

<?php ob_start(); ?>

    <header>
    <h2><i class="fas fa-user-clock"></i> Ajouter un Rendez-Vous</h2>
    </header>

    <?php
    // var_dump($_POST);
    if(!isset($_POST['addRdv']))
    {
    ?>
    <section class="container">
        <form method="POST" action="ajout-rendezvous.php" class="m-auto col-md-6">
            
                <div class="form-group">
                    <label for="listPatient">Nom du patient</label>
                    <select name="listPatient" id="listPatient">
                        <?php 
                        while ($donnees1 = $req1->fetch())
                        {
                        ?>
                        <option value="<?= $donnees1['id'] ?>"> <?= $donnees1['lastname'] ." ". $donnees1['firstname'] ?> </option>
                        
                        <?php
                        }
                        $req1->closeCursor();
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="dateRdv">Date du RDV</label>
                    <input type="datetime-local" name="dateRdv" id="dateRdv">
                </div>

                <div class="form-group">
                    <button class="btn btn-info" name="addRdv" id="addRdv" type="submit">Ajouter</button>
                </div>
            
        </form>
    </section>
    <?php } 
?>


<?php $content = ob_get_clean(); ?>

<?php require('Shared/_layout.php'); ?>
