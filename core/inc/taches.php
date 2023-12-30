<?php

/*
 * Mr.SKOLKOV
 * LAFONTAINE Cédric Camille - codelibre.fr - tous droits reservés
 * https://github.com/framboise-pi/
 * core/taches.php
 * 
*/
?>
<style>

    body {
      height: 100%;
      overflow-x: hidden;
    }

.creative-bg {
  position: fixed;
  bottom: 0;
  right: 0;
  width: 100%;
  height: auto;
  z-index: -10;
  opacity: 20%;
}

img, svg {
  vertical-align: middle;
}


</style>

<img src="./core/imgz/background/background_MrSkolkov_05.jpg" class="creative-bg">


<div class="container">

  <div class="row justify-content-center mt-3">
    
    <div class="text-dark">
    
      <div style="background: rgba(256, 256, 256, 0.6); border-radius: 10px">
	<div class="d-flex justify-content-around p-2" style="font-family: 'Urbanist';font-size: 24px;">

	  <div id="daytoday"></div>

	  <div style="width: 50px" id="clock"></div>

	    <?php
	    $multiavatar = new Multiavatar($_SESSION["avatar"], null, null);
	    ?>

          <div style="width: 28px; height: 28px;">
            <?php echo($multiavatar->svgCode); ?>
          </div>
	  
	  <?php echo $_SESSION['skolkov_identifiant']; ?>
	  
	</div>
      </div>
    </div>

    <div class="text-white mt-1">
    
      <div style="background: rgba(256, 256, 256, 0.6); border-radius: 10px">
	<div class="d-flex justify-content-around p-2" style="font-family: 'Urbanist';font-size: 24px;">

	  <a class="btn btn-white text-dark" href="index.php"><i class="fas fa-home fa-2x"></i></a>

	  <form method="POST" action="index.php">
	    <div class="" data-bs-toggle="tooltip" data-bs-placement="bottom" title="voir les compteurs">
	      <button type="submit" name="compteurs"  class="btn btn-info text-white">
		<i class="fas fa-stopwatch fa-2x"></i></button>
	    </div>
	  </form>

	  <div class="">
	    <button data-title="ajouter une tâche"   data-bs-toggle="modal" data-bs-target="#Modal-tache"
	     class="btn btn-primary text-white">
	    <i class="fas fa-plus-square fa-2x"></i></button>
	  </div>

	</div>
	  
      </div>
    </div>
  </div>
<!--
  <div class="row justify-content-center mt-3">
    <a class="btn btn-info text-white" href="index.php"><i class="fas fa-home fa-2x"></i></a>
  </div>

  <form method="POST" action="index.php">
    <div class="row justify-content-center mt-3">
      <button type="submit" name="compteurs"  class="btn btn-light text-dark"><i class="fas fa-stopwatch fa-2x"></i></button>
    </div>
  </form>
  
  <div class="row justify-content-center mt-3">
    <button data-title="ajouter une tâche"   data-bs-toggle="modal" data-bs-target="#Modal-tache"
     class="btn btn-primary text-white">
    <i class="fas fa-plus-square fa-2x"></i></button>
  </div>
-->
  
  <!--<div data-title="taches" class="row justify-content-center mt-3">
    <a class="btn btn-light text-dark" href="#taches"><i class="fas fa-tasks fa-2x"></i></a>
  </div>-->
	
  <?php
  if (isset($_SESSION["skolkov_id"]))
  {
    $membre_id = $_SESSION["skolkov_id"];
  ?>

<!-- TACHES LISTE DISPONIBLES-->

    <div class="row justify-content-center mt-5">
      <div class="card" style="border-radius: 10px;">
	
	<?php
	$app = new Skolkov_Fonctions();
	$membre_taches = $app->SkolkovTachesMembre($membre_id, 1);
	
	?>
	<h4 class="text-center p-2">TACHES DISPONIBLES</h4>
	<small class="text-center">compteurs en cours pris en compte dans le calcul!</small>
	<table class="table table-striped">
	<thead>
	  <tr>
	    <!--<th scope="col">#</th>-->
	    <th scope="col"></th>
	    <th scope="col">TITRE</th>
	    <th scope="col">TEMPS TOTAL</th>
	    <th scope="col" class="text-center">ARCHIVER</th>

	  </tr>
	</thead>
	<tbody>
	<?php
	  foreach ($membre_taches as $tache)
	  {
	    $tache_id = $tache['ID'];
	    $tache_icone = $tache['ICONE'];
	    $tache_titre = $tache['TITRE'];
	    
	    //chaque tache ->  récupérer tous les compteurs
	    $app = new Skolkov_Fonctions();
	    $tache_compteurs = $app->SkolkovQuelCompteursPourCetteTache($tache_id);
	    //additionner les temps
	    
	    $duree = 0;
	    $tache_total = 0;
	    foreach ($tache_compteurs as $tache_compteur)
	    {
	      //$round = $round + 1;
	      //$duree = "à calculer";
	      $maintenant = date('Y-m-d H:i:s');
	      $debut = strtotime($tache_compteur['DATE_DEBUT']);
	      if (!isset($tache_compteur['DATE_FIN'])) { $tache_compteur['DATE_FIN'] = $maintenant; }
	      $fin = strtotime($tache_compteur['DATE_FIN']);
	      $duree = $fin - $debut;
	      $tache_total = $tache_total + $duree ;
	      	      
	    }
	      //$duree_h = gmdate("H:i:s", $duree);
	      $tache_total_d = gmdate("d", $tache_total);
	      $tache_total_h = gmdate("H", $tache_total);
	      $tache_total_h = $tache_total_h + (($tache_total_d-1) * 24);
	      $tache_total_m = gmdate("i", $tache_total);
	      $tache_total_s = gmdate("s", $tache_total);
	      $tache_total = $tache_total_h."h ".$tache_total_m."min ".$tache_total_s."s";
	    
	?>

	    <tr>
	      <!--<td><?php echo $tache['ID'] ?></td>-->
	      <td><?php echo $tache['ICONE'] ?></td>
	      <td><?php echo $tache['TITRE'] ?></td>
	      <td><?php echo $tache_total ?></td>

	      <form method="POST" action="index.php">
	      <td class="text-center"><button class="btn bg-transparent" type="submit"
	      name="tache_archiver" value="<?php echo $tache['ID'] ?>"
	      data-bs-toggle="tooltip" data-bs-placement="right" title="archiver ce compteur">
		<i class="text-primary fas fa-archive"></i>
		</button>
	      <input type="hidden" id="" name="tache_archiver_total" value="<?php echo $tache_total ?>">
	      </td>
	      </form>
	    
	    </tr>
				
	  <?php
	  }
          ?>
    
	  </tbody>
	  </table>	

	</div><!-- card -->
      </div><!-- row -->
		

<!-- TACHES LISTE ACRHIVES-->

    <div class="row justify-content-center mt-5 mb-5">
      <div class="card" style="border-radius: 10px;">
	
	<?php
	//taches désactivées du membre
	$app = new Skolkov_Fonctions();
	$membre_taches = $app->SkolkovTachesMembre($membre_id, 0);
	
	?>
	<h4 class="text-center p-2">TACHES ARCHIVE</h4>
	<table class="table table-striped">
	<thead>
	  <tr>
	    <!--<th scope="col">#</th>-->
	    <th scope="col"></th>
	    <th scope="col">TITRE</th>
	    <th scope="col">TEMPS TOTAL</th>
	    <th scope="col">options</th>

	  </tr>
	</thead>
	<tbody>
	<?php
	  foreach ($membre_taches as $tache)
	  {
	    $tache_id = $tache['ID'];
	    $tache_icone = $tache['ICONE'];
	    $tache_titre = $tache['TITRE'];
	?>

	  <tr>
	    <!--<td><?php echo $tache['ID'] ?></td>-->
	    <td><?php echo $tache['ICONE'] ?></td>
	    <td><?php echo $tache['TITRE'] ?></td>
	    <td><?php echo $tache['TOTAL'] ?></td>
	    
	  </tr>
				
	  <?php
	  }
          ?>
    
	  </tbody>
	  </table>	

	</div><!-- card -->
      </div><!-- row -->
		
  <?php
  }//--if
  ?>

</div><!-- container -->
