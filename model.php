<?php

function GetDataBase()
{
    try
    {
        $bdd = new PDO('mysql:host=localhost;dbname=hospitalE2N;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        return $bdd;
    }
    catch (Exception $e)
    {
            die('Erreur : ' . $e->getMessage());
    }
}

/* Configure le script en français */
setlocale (LC_TIME, 'fr_FR','fra');
//Définit le décalage horaire par défaut de toutes les fonctions date/heure  
date_default_timezone_set("Europe/Paris");
//Definit l'encodage interne
mb_internal_encoding("UTF-8");
//Convertir une date US en français
// Pour datetime
function datetimeFr($dateHour){
    @list($date, $hour)=explode(' ',$dateHour);
return strftime('%d-%m-%Y',strtotime($date)) . " " . $hour;
}
function datetimeFrWithT($dateHour){
    @list($date, $hour)=explode('T',$dateHour);
return strftime('%d-%m-%Y',strtotime($date)) . " " . $hour;
}
// Pour date uniquement
function dateFr($date){
    return strftime('%d-%m-%Y',strtotime($date));
}

// I needed to identify email addresses in a data table that were replicated, 
// so I wrote the array_not_unique() function:
    
// function array_not_unique($raw_array) {
//     $dupes = array();
//     natcasesort($raw_array);
//     reset ($raw_array);

//     $old_key    = NULL;
//     $old_value    = NULL;
//     foreach ($raw_array as $key => $value) {
//         if ($value === NULL) { continue; }
//         if ($old_value == $value) {
//             $dupes[$old_key]    = $old_value;
//             $dupes[$key]        = $value;
//         }
//         $old_value    = $value;
//         $old_key    = $key;
//     }
// return $dupes;
// }

// $raw_array     = array();
// $raw_array[1]    = 'abc@xyz.com';
// $raw_array[2]    = 'def@xyz.com';
// $raw_array[3]    = 'ghi@xyz.com';
// $raw_array[4]    = 'abc@xyz.com'; // Duplicate

// $common_stuff    = array_not_unique($raw_array);
// var_dump($common_stuff);
