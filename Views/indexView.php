<?php $title = "Accueil - PDO Part II" ?>

<?php ob_start(); ?>

<style>
/* Empêcher l'apparition d'une barre de défilement */
html { overflow-y: hidden; } 
</style>

<header id="homePage">
<div>
<h1 class="animateTitle1"><i class="fas fa-user-md"></i> Hôpital E2N <i class="fas fa-user-nurse"></i></h1>
<h2 class="animateTitle2">- Bienvenue -</h2>
</div>
</header>

<?php $content = ob_get_clean(); ?>

<?php require('Shared/_layout.php'); ?>

<script>
    $("document").ready(function () {
        $("#homePage").children().css("display", "none");
        setTimeout(function() 
        {
            $("#homePage img").ready( function () {
                $("#homePage").children().css("display", "block"); 
                $(".animateTitle1").css("animation", "animTitle 1.5s ease-out");
                $(".animateTitle2").css( {
                    "opacity" : 0,
                    "animation" : "animTitle 1s ease-out forwards",
                    "animation-delay" : "1s"
                }
                );
            });
        }, 1000);

    });
</script>