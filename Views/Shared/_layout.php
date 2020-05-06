       
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css" integrity="sha256-UzFD2WYH2U1dQpKDjjZK72VtPeWP50NoJjd26rnAdUI=" crossorigin="anonymous" />

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.css" integrity="sha256-DOS9W6NR+NFe1fUhEE0PGKY/fubbUCnOfTje2JMDw3Y=" crossorigin="anonymous" />

        <link rel="stylesheet" href="../../Public/css/style.css">

        <title><?= $title ?></title>
    </head>

    <body>

        <?php
        include("_navbar.php");
        ?>

        <?= $content ?>

        <br>
        <br>
        <!-- Besoin d'un peu d'espace... -->
        <br>

        <?php
        include("_footer.php"); 
        ?>

       <!--  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha256-pasqAKBDmFT4eHoN2ndd6lN370kFiGUFyTiUHWhU7k8="
        crossorigin="anonymous">
        </script> -->

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

        <!-- Bootstrap -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" 
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" 
        crossorigin="anonymous">
        </script>

        <!-- FontAwesome -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/js/all.min.js" 
        integrity="sha256-xzrHBImM2jn9oDLORlHS1/0ekn1VyypEkV1ALvUx8lU=" 
        crossorigin="anonymous">
        </script>  

        <!-- DateTimePicker -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js" integrity="sha256-FEqEelWI3WouFOo2VWP/uJfs1y8KJ++FLh2Lbqc8SJk=" crossorigin="anonymous"></script>

        <script>
        $("document").ready(function () { 

            // Design des formulaires :
            $("h1, h2").addClass("text-center p-2 text-info");
            $("input, select").addClass("form-control");
            $(".btn-sm").css("cursor","pointer");
            $("table").addClass("table table-bordered table-striped table-hover mt-1 text-center");
            // $("thead").addClass("thead-light");

            // DateTimePicker pour Firefox
            // Détection du navigateur Firefox avec typeof InstallTrigger
            var isFirefox = typeof InstallTrigger !== 'undefined';
            if(isFirefox == true)
            {
                $('input[type=datetime-local]').datetimepicker();
            }
            

        });
        </script>

    </body>
</html>