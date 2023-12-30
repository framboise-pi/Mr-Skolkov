<?php
/*
 * Mr.SKOLKOV
 * LAFONTAINE Cédric Camille - codelibre.fr - tous droits reservés
 * https://github.com/framboise-pi/
 * core/compteurs.php
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

	    <button type="submit" name="taches"  class="btn btn-info text-white"><i class="fas fa-tasks fa-2x"></i></button>

	  </form>

	</div>
	  
      </div>
    </div>
  </div>
  




  <?php
  if (isset($_SESSION["skolkov_id"]))
  { 
  ?>
    <div class="row justify-content-center mt-5">
      <div class="card border-warning">
	
      <?php

	$membre_id = $_SESSION["skolkov_id"];
	$app = new Skolkov_Fonctions();
	$compteurs_compte = $app->SkolkovMembreCompteurs ($membre_id, 1);
            
      ?>
      
	<h4 class="text-center p-2">COMPTEURS EN COURS</h4>
	<table class="table table-striped">
	<thead>
	  <tr>
	    <th scope="col">#</th>
	    <th scope="col">début</th>
	    <th scope="col">fin</th>
	    <th scope="col">tâche</th>
	    <th scope="col">texte</th>
	  </tr>
	</thead>
	<tbody>

	<?php
	  foreach ($compteurs_compte as $compteur)
	  {
            $tache_id = $compteur['ID_TACHE'];
            $app = new Skolkov_Fonctions();
            $compteurs_compte = $app->SkolkovCompteurTache ($tache_id);

	?>
	    <tr>
	      <td><?php echo $compteur['ID'] ?></td>
	      <td><?php echo $compteur['DATE_DEBUT'] ?></td>
	      <td><?php echo $compteur['DATE_FIN'] ?></td>
	      <td><?php echo $compteurs_compte['TITRE'] ?></td>
	      <td><?php echo $compteur['TEXTE'] ?></td>
	    </tr>
    
	<?php
	    }
	?>


	</tbody>
	</table>	

      </div><!-- card -->
    </div><!-- row -->

    <div class="row justify-content-center mt-3">
      <div class="card">
	
	<?php
    	//INACTIFS
	$app = new Skolkov_Fonctions();
	$compteurs_compte = $app->SkolkovMembreCompteurs ($membre_id, 0);
	
	?>
	<h4 class="text-center text-white p-2 bg-secondary">ANCIENS COMPTEURS</h4>
	<table class="table table-striped">
	<thead>
	  <tr>
	    <!-- <th scope="col">#</th> -->
	    <th scope="col">durée</th>
	    <th scope="col">début</th>
	    <th scope="col">fin</th>
	    <th scope="col">tâche</th>
	    <th scope="col">texte</th>
	  </tr>
	</thead>
	<tbody>
	<?php
	  foreach ($compteurs_compte as $compteur)
	  {
	    $tache_id = $compteur['ID_TACHE'];
            $app = new Skolkov_Fonctions();
            $compteurs_compte = $app->SkolkovCompteurTache ($tache_id);

            //$duree = "à calculer";
	    $debut = strtotime($compteur['DATE_DEBUT']);
	    $fin = strtotime($compteur['DATE_FIN']);
	    
	    
	    $duree = $fin - $debut;
	    // duree syntax H m s
            $app = new Skolkov_Fonctions();
            $duree = $app->SkolkovDateSyntaxHMS ($duree);
	    
	    // date syntax H m s
	    $app = new Skolkov_Fonctions();
            $date_debut = $app->SkolkovDateSyntaxDMH ($debut);
	    
	    $app = new Skolkov_Fonctions();
            $date_fin = $app->SkolkovDateSyntaxDMH ($fin);
	    	
	?>

	  <tr>
	    <!-- <td><?php echo $compteur['ID'] ?></td> -->
	    <td><?php echo $duree ?></td>
	    <td><?php echo $date_debut ?></td>
	    <td><?php echo $date_fin ?></td>
	    <td><?php echo $compteurs_compte['TITRE'] ?></td>
	    <td><?php echo $compteur['TEXTE'] ?></td>
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
         
