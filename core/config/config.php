<?php
/*
 * Mr.SKOLKOV
 * LAFONTAINE Cédric Camille - codelibre.fr - tous droits reservés
 *
 * config/config.php
 *
*/

// database Connection variables
define('HOST', 'localhost'); // Database host name
define('USER', 'your_user'); // Database user
define('PASSWORD', 'your_password'); // user password
define('DATABASE', 'your_database'); // Database name

//misc configuration
$register_user = true;
date_default_timezone_set("Europe/Paris");

//versions info
$SkolkovVersion = "0.1 - Apprenti Alchimiste";
$version_fa = "FontAwesome 6.4.0";
$version_bs = "Bootstrap 5.0.1";

function DB()
{
    //debug echo ("DB ACCESS");
    try {
        $db = new PDO('mysql:host='.HOST.';dbname='.DATABASE.'', USER, PASSWORD);
        //$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
    } catch (PDOException $e) {
        return "Error!: " . $e->getMessage();
        die();
    }
}

// for future
#FAVICON
//$FAVICON_path = "";

#LANG:DEFAULT
//$default_language = "fr";
//$languages = [ "fr", "en, "ru" ];

?>