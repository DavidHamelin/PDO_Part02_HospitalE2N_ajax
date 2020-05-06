
<?php $title = "Liste des Patients - PDO Part II" ?>

<?php ob_start(); ?>

    <header>
    <h2><i class="fas fa-book-medical"></i> Liste des patients</h2>
    </header>

    <?php if (!isset($_POST["deletePatient"]))
    {
    ?>

    <section class="container">
    <a href="ajout-patient.php" id="removeIfSmall" class="btn btn-info float-right mb-2"><i class="fas fa-user-plus"></i> Ajouter un patient</a>

        <form action="liste-patients.php" method="get">
        <div class="row"> 
                <div class="col-md-4">
                    <!-- <div class="row ml-1">  -->
                        <!-- <input class="col-8" autocomplete="off" type="text" id="searchBar" name="searchBar" placeholder="Rechercher" /> -->
                        <input autocomplete="off" type="text" id="searchBar" name="searchBar" placeholder="Rechercher" />
<!--                         <button class="btn btn-info ml-2 col-3 col-md-3" type="submit" id="submitSearch">
                            <i class="fas fa-search"></i>
                        </button> -->
                  <!--   </div> -->
                </div>   
            </div>
        </form>

        <form id="formToUpdate" action="liste-patients.php" method="post">

            <table>
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
                    ?>
                </tbody>
            </table>
            <?php
                if (!isset($_GET["searchBar"]))
                {

                // Partie "Liens"
                /* On calcule le nombre de pages */
                $nombreDePages = ceil($nombredElementsTotal / $limite);

                /* Si on est sur la première page, on n'a pas besoin d'afficher de lien
                * vers la précédente. On va donc l'afficher que si on est sur une autre
                * page que la première */
                if ($page > 1):
                    ?><a href="?page=<?php echo $page - 1; ?>">Page précédente</a> — <?php
                endif;

                /* On va effectuer une boucle autant de fois que l'on a de pages */
                for ($i = 1; $i <= $nombreDePages; $i++):
                    ?><a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a> <?php
                endfor;

                /* Avec le nombre total de pages, on peut aussi masquer le lien
                * vers la page suivante quand on est sur la dernière */
                if ($page < $nombreDePages):
                    ?>— <a href="?page=<?php echo $page + 1; ?>">Page suivante</a><?php
                endif;
            }
            ?>
        </form>
    </section>

    <?php } ?>


<?php $content = ob_get_clean(); ?>

<?php require('Shared/_layout.php'); ?>

<script type="text/javascript">
    $(function () {
        $("#searchBar").keyup(function(){
            // Sans AJAX, avec submit :
            // $("#submitSearch").click();
            // e.preventDefault();

            // AJAX : MaJ des données en temps reel
            var name = $("#searchBar").val();
            $.get("testAjax.php", 
                {
                    searchBar : name
                     },
                function(data, status){
                    // console.log(data);
                    $("#formToUpdate").html(data);
            });

        })
    })    
</script>
