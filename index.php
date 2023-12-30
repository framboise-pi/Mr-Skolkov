<!DOCTYPE html>
<html lang="en">
<?php
 
/*
 * Mr.SKOLKOV
 * LAFONTAINE Cédric Camille - codelibre.fr - tous droits reservés
 * https://github.com/framboise-pi/
 * index.php
 * fonticon to favicon: https://gauger.io/fonticon/
*/


//24h lifetime
session_start([
    'cookie_lifetime' => 86400,
]);

$start_time = microtime(TRUE);

require_once("core/config/config.php");
require_once("core/inc/classes.inc.php");
require_once("core/lib/Multiavatar-php/Multiavatar.php");

?>
<head>
  <title>Mr. Skolkov</title>

  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta name="author" content="">

  <!-- favicon -->
  <link rel="icon" href="core/imgz/iconz/fa-clock.ico" type="image/x-icon">

  <!-- Bootstrap CSS -->
  <link href="core/lib/bootstrap-5.0.1/css/bootstrap.css" rel="stylesheet">

	<!-- fa icons -->
	<script src="core/lib/fontawesome-free-6.4.0/js/all.js" crossorigin="anonymous"></script>
	
  <!-- Custom CSS -->
  <style>

@font-face {
  font-family: 'CairoPlay';
  font-style: normal;
  font-weight: 900;
  font-display: swap;
  src: url(core/lib/fonts/Cairoplay_latin.woff2) format('woff2');
  unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+0304, U+0308, U+0329, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
}

@font-face {
  font-family: 'Darumadrop';
  font-style: normal;
  font-weight: 400;
  font-display: swap;
  src: url(core/lib/fonts/darumadropone.woff2) format('woff2');
  unicode-range: U+fa10, U+fa12-fa6d, U+fb00-fb04, U+fe10-fe19, U+fe30-fe42, U+fe44-fe52, U+fe54-fe66, U+fe68-fe6b, U+ff02, U+ff04, U+ff07, U+ff51, U+ff5b, U+ff5d, U+ff5f-ff60, U+ff66, U+ff69, U+ff87, U+ffa1-ffbe, U+ffc2-ffc7, U+ffca-ffcf, U+ffd2-ffd6;
}

  @font-face {
  font-family: 'Urbanist';
  font-style: normal;
  font-weight: 200;
  font-display: swap;
  src: url(core/lib/fonts/urbanist.woff2) format('woff2');
  unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+0304, U+0308, U+0329, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
  }  

    .navbar {
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      z-index: 999;
    }

  footer {
    position: fixed;
    height: 25px;
    bottom: 0;
    width: 100%;
  }

*, ::after, ::before {
  box-sizing: border-box;
}

  </style>
  
</head>

<body>

<!-- -->


<!-- -->

<?php

if (isset($_POST['identifiant'])  && isset($_POST['secret']))
{
  
  $login_nom = $_POST['identifiant'];
  $login_secret = $_POST['secret'];

  $app = new Skolkov_Fonctions();
  $logged = $app->SkolkovLogin ($login_nom);

  if (($logged == 0) || (!isset($logged)))
  {
      //$errorMsg[] = "error";
  }
  else
  {
    
    if($login_secret == $logged['SECRET'])
    {
        $_SESSION["skolkov_identifiant"] = $login_nom;
        $_SESSION["skolkov_id"] = $logged['ID'];
        $membre_id = $_SESSION["skolkov_id"];
        $avatar_id  = $logged['AVATAR'];
        //sql get avatar string
        $app = new Skolkov_Fonctions();
        $avatar_string = $app->SkolkovAvatarString ($avatar_id);
        $_SESSION["avatar_id"] = $avatar_id;
        $_SESSION["avatar"] = $avatar_string['AVATAR'];
      }
    }
}

if (isset($_POST['logout']))
{
  session_unset();
  session_destroy();
}

if (isset($_POST['tache_archiver']) && isset($_SESSION["skolkov_id"]))
{

    $membre_id = $_SESSION["skolkov_id"];
    $tache_id = $_POST['tache_archiver'];
    $tache_total = $_POST['tache_archiver_total'];
    $app = new Skolkov_Fonctions();
    $tache_archivage = $app->SkolkovTacheArchiver ($membre_id, $tache_id, $tache_total);

}

if (isset($_POST['compteur_debut_bouton']))
{
  if (isset($_SESSION["skolkov_id"]))
  {
    $membre_id = $_SESSION["skolkov_id"];
    $compteur_id_tache = $_POST['tache_id'];
    $compteur_texte = $_POST['compteur_texte'];
    $app = new Skolkov_Fonctions();
    $compteur_lancement = $app->SkolkovCompteurDebut ($membre_id, $compteur_texte, $compteur_id_tache);

  }
  else
  {
    $errorMsg[] = "login nécessaire";
  }
}

if (isset($_POST['compteur_fin_bouton']))
{
  if (isset($_SESSION["skolkov_id"]) && isset($_POST['compteur_fin']))
  {
    $compteur_id = $_POST['compteur_fin'];
    $app = new Skolkov_Fonctions();
    $compteur_suppression = $app->SkolkovCompteurFin ($compteur_id);
  }
    else
  {
    $errorMsg[] = "login nécessaire";
  }
}

include 'core/inc/alerts.inc.php';

if (isset($_POST['compteurs'])) { include 'core/inc/compteurs.php'; }

else if (isset($_POST['reglages'])){ include 'core/inc/reglages.php'; }

else if (isset($_POST['historique'])){ include 'core/inc/historique.php'; }

else if (isset($_POST['taches']) || isset($_POST['tache_archiver'])) { include 'core/inc/taches.php'; }

else if (isset($_POST['tache_ajout']) && isset($_SESSION["skolkov_id"]))
{
  //ajouter la tache avec ID_MEMBRE
  $membre_id = $_SESSION["skolkov_id"];
  $tache_titre = $_POST['tache_ajout'];
  
  //vérifier doublon tache_ajout/membre_id
  $app = new Skolkov_Fonctions();
  $doublon = $app->SkolkovTacheDoublon ($membre_id, $tache_titre);
  
  if ($doublon)
  {
    $errorMsg[] = "cette tâche existe déjà";
    include 'core/inc/alerts.inc.php';
  }
  
  else
  {
    $app = new Skolkov_Fonctions();
    $membre_taches = $app->SkolkovTacheAjout($membre_id, $tache_titre);
    
  }

  include 'core/inc/taches.php';
}
//peut être découper pour voir des alert no_name no_secret

else if (isset($_POST['adduser_btn']) && isset($_POST['adduser_name']) && isset($_POST['adduser_secret']))
{
  $user_name = $_POST['adduser_name'];
  $user_secret = $_POST['adduser_secret'];
  //verif doublon user_name
  $app = new Skolkov_Fonctions();
  $membre_doublon = $app->SkolkovMembreDoublon($user_name);
    
  if (!isset($membre_doublon['NOM']))
  {
      
    $app = new Skolkov_Fonctions();
    $avatar_random = $app->AvatarRandomString();
      
    $app = new Skolkov_Fonctions();
    $membre_ajout = $app->SkolkovMembreAjout($user_name, $user_secret);

    //ajout d'un avatar random dans la table avatars, attaché au membre_id
    $app = new Skolkov_Fonctions();
    $membre_avatar_id = $app->SkolkovNouvelAvatar($membre_ajout, $avatar_random);

    //MaJ table membre avatar
    $app = new Skolkov_Fonctions();
    $membre_avatar_id = $app->SkolkovMembreAvatar($membre_ajout, $membre_avatar_id);
      
    if (isset($membre_ajout)) { $successMsg[] = "membre ajouté avec succès";}
    else { $errorMsg[] = "erreur lors de l'ajout";};
  }
  else
  {
    $errorMsg[] = "nom déjà existant";
  }
    
    include 'core/inc/alerts.inc.php';
    include 'core/inc/veille.php';
    
}
  
else if (isset($_POST['avatar_string']) && isset($_SESSION["skolkov_id"]))
{
  $membre_id = $_SESSION["skolkov_id"];
  $avatar = $_POST['avatar_string'];
  //echo $_POST['avatar_string'];
  //SQL id_membre ajout dans la table avatars
  $app = new Skolkov_Fonctions();
  $avatar_id = $app->SkolkovNouvelAvatar($membre_id, $avatar);

  //alert
  if (!isset($avatar_id))
  {
    $errorMsg[] =  "erreur à la création de l'avatar";
  }
  else
  {
    //SQL update id_membre avec nouvel avatar
    $app = new Skolkov_Fonctions();
    $membre_avatar = $app->SkolkovMembreAvatar($membre_id, $avatar_id);
    //alert
      
    $_SESSION["avatar"]  = $avatar;
  }
  include 'core/inc/reglages.php';
}
  
else if (isset($_POST['avatar_changer']) && isset($_SESSION["skolkov_id"]))
{
  $membre_id = $_SESSION["skolkov_id"];
  $avatar_id = $_POST['avatar_changer'];
  //SQL update id_membre avec nouvel avatar
  $app = new Skolkov_Fonctions();
  $membre_avatar = $app->SkolkovMembreAvatar($membre_id, $avatar_id);
  //alert
  
  $app = new Skolkov_Fonctions();
  $avatar_string = $app->SkolkovAvatarString($avatar_id);
  $_SESSION["avatar"]  = $avatar_string['AVATAR'];

  include 'core/inc/reglages.php';
    
}

else if ((isset($_POST['rapide']) || isset($_POST['onoff'])) && isset($_SESSION["skolkov_id"]) )
{
  //include 'core/inc/alerts.inc.php';

  if (isset($_POST['onoff']) && isset($_POST['onoff_etat']))
  {
    $tache_id = $_POST['onoff'];
    $compteur_id = $_POST['onoff_compteur'];

    

      
      //$etat = 0;
      //quand il y a un compteur
      if ($_POST['onoff_etat'] == 1)
      {
          $app = new Skolkov_Fonctions();
          $change = $app->SkolkovCompteurFin($compteur_id);
      }
      
      //sinon nouveau compteur
      if ($_POST['onoff_etat'] == 0)
      {
          $membre_id = $_SESSION["skolkov_id"];
          $compteur_texte = "";
          $compteur_id_tache = $tache_id;
          $app = new Skolkov_Fonctions();
          $change = $app->SkolkovCompteurDebut ($membre_id, $compteur_texte, $compteur_id_tache);
      }
    }
      include 'core/inc/veille2.php';
      
    
}

  
else { include 'core/inc/veille.php'; }

$end_time = microtime(TRUE);
$temps_chargement =($end_time - $start_time);
$temps_chargement = round($temps_chargement,5);
 

?>

<!-- FOOTER -->

<!-- <footer class="fixed-bottom mt-auto py-3 bg-light">-->
<footer class="fixed-bottom bg-light">
  <div class="container">
      <span class="text-muted" style="font-size:10px">Aucune utilisation de 'cookies' ou autres données numériques
$SkolkovVersion = "0.1 - Apprenti Alchimiste";
       - version <?php echo $SkolkovVersion ?> - 
       Ce site est codé sur <i class="text-primary fab fa-raspberry-pi"></i> et Geany <i class="text-info fas fa-heart"></i>
        par codelibre.fr - Lafontaine Camille - Tous droits réservés 2023 - php8.2 - <?php echo $version_bs; echo (' - ');  $version_fa; echo ' - Page generated in '.$temps_chargement.' seconds.'; ?>
        <!-- <a href="https://getbootstrap.com/" target="_blank"><i class="fab fa-bootstrap"></i> </a>
        <a href="https://fontawesome.com/v5/search?m=free" target="_blank"><i class="fab fa-font-awesome-alt"></i> </a>
        -->
      </span>
    </div>
</footer>

<?php

include("core/inc/backtotop.inc.php");

?>

<!-- MODALS -->

<?php

include("core/inc/modals.inc.php");

?>

  
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <!-- <script src="js/jquery-3.6.0.min.js"></script>
  <script src="js/popper.min.js"></script>
  -->
  <script src="core/lib/bootstrap-5.0.1/js/bootstrap.js"></script>
  <!-- videoplayer -->
  <script src="core/lib/bootstrap-5.0.1/js/bootstrap.bundle.min.js"></script>


<script>
  var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
  var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
  return new bootstrap.Tooltip(tooltipTriggerEl)
})


</script>

<!-- clock script -->
<script>
  setInterval(showTime, 1000);
  
function showTime() {
    let time = new Date();
    let day = time.getDate();
    let today = time.getDay();
    let month = time.getMonth();
    let hour = time.getHours();
    let min = time.getMinutes();
    let sec = time.getSeconds();
 
    hour = hour < 10 ? "0" + hour : hour;
    min = min < 10 ? "0" + min : min;
    sec = sec < 10 ? "0" + sec : sec;
    
    const monthNames = ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Aout", "Septembre", "Octobre", "Novembre", "Decembre"];
    const dayNames = ["Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi"];
 
    let currentTime = hour + ":"
            + min + ":" + sec;
    let currentDay = day + " " + monthNames[month];
    let currentToday = dayNames[today] + " " + currentDay;

    document.getElementById("daytoday")
            .innerHTML = currentToday;
 
    document.getElementById("clock")
            .innerHTML = currentTime;
}
showTime();

</script>

</body>

</html>
