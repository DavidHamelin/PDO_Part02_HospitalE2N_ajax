
<?php $title = "Ajout Patient - PDO Part II" ?>

<?php ob_start(); ?>

    <header>
    <h2><i class="fas fa-user-plus"></i> Ajouter un patient</h2>
    </header>

    <?php
    if(!isset($_POST['addPatient']))
    {
    ?>
    <section class="container">
        <form method="POST" action="ajout-patient.php" class="m-auto col-md-6">
            
                <div class="form-group">
                    <label for="lastname">Nom</label>
                    <input type="text" name="lastname" id="lastname" placeholder="Dupont">
                </div>
                <div class="form-group">
                    <label for="firstname">Prénom</label>
                    <input type="text" name="firstname" id="firstname" placeholder="Jean">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Date de naissance</label>
                    <input type="date"  name="birthdate" id="birthdate" placeholder="31/12/1999">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Adresse e-mail</label>
                    <input type="email" name="mail" id="mail" placeholder="name@example.com">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Numéro de téléphone</label>
                    <input type="tel" name="phone" id="phone" placeholder="0611223344">
                </div>
                <div class="form-group">
                    <button class="btn btn-info" name="addPatient" id="addPatient" type="submit">Ajouter</button>
                </div>
            
        </form>
    </section>
    <?php } 
?>


<?php $content = ob_get_clean(); ?>

<?php require('Shared/_layout.php'); ?>
