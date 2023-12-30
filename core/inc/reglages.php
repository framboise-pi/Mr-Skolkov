<?php
/*
 * Mr.SKOLKOV
 * release: 0.1 - Apprenti Alchimiste
 * LAFONTAINE Cédric Camille - codelibre.fr - tous droits reservés
 * 2023
 * core/reglages.php
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
}

img, svg {
  vertical-align: middle;
}


</style>

<img src="./core/imgz/background/background_MrSkolkov_08.jpg" class="creative-bg">

<div class="container">
	<?php
    if (isset($_SESSION["skolkov_identifiant"]) && isset($_SESSION["avatar"]))
    { 
	?>
	
	<div class="row align-items-center flex-row-reverse  bg-white mt-5 p-3" style="border-radius: 15px;">
		
		<div class="col-lg-6">
			<div class="bg-light p-4 m-2" style="border-radius: 10px;">
				<h2 class=""><?php echo $_SESSION["skolkov_identifiant"] ?></h2>

				<div class="text-start" >
					  <span class="text-secondary" style="font-family: 'Urbanist'; font-size: 20px; font-weight: bold;" id="clock"></span>
				</div>				
				 <div class="text-start" >
					  <span style="font-family: 'Urbanist'; font-size: 16px;" id="daytoday"></span>
				</div>
				
				<small>session ouverte depuis <?php echo date('H:i:s', $_SESSION['time']); ?></small>
				
				<div class="row mt-5">
					<div class="col-md-6 mt-2">
						<div class="">
							
							<button type="button" class="btn btn-outline-primary"  data-title="éditer son avatar" data-bs-toggle="modal"
							data-bs-target="#Modal-avatars">changer d'avatar
							</button>
							
						</div>
					</div>
					<div class="col-md-6 mt-2">
						<div class="">
							<button class="btn btn-outline-warning text-dark" type="submit"
							name="avatar_editer" data-title="changer la langue utilisée">
								<i class="fas fa-language"></i> | changer de language
							</button>
						</div>
					</div>
					
					<div class="col-md-6 mt-2">
						<div class="">
							<button class="btn btn-outline-danger text-dark" type="submit"
							name="avatar_supprimer" data-title="supprimer un avatar sauvegardé">
								supprimer un avatar
							</button>
						</div>
					</div>
					
				</div>
				
			</div>
		</div>     

		<div class="col-lg-6">
			
		<a class="btn" href="index.php" data-title="retour à l'index"><i class="fas fa-home fa-2x"></i></a>
			
			<div class="">
				<?php
				$multiavatar = new Multiavatar($_SESSION["avatar"], true, null);
				?>
			  <div style="margin-left: auto; margin-right: auto; width: 250px; height: 250px;">
				<?php echo($multiavatar->svgCode); ?>
			  </div>
          	</div>
		</div>

<!-- COMPTEURS -->

			<?php
			$membre_id = $_SESSION["skolkov_id"];
            $app = new Skolkov_Fonctions();
            $compteurs_compte = $app->SkolkovMembreCompteursCompte($membre_id);
            
            //taches diponibles
            $etat = 1;
            $app = new Skolkov_Fonctions();
            $taches_dispo = $app->SkolkovMembreTachesArchiveCompte($membre_id, $etat);
			//taches archivées
			$etat = 0;
			$app = new Skolkov_Fonctions();
            $taches_archive = $app->SkolkovMembreTachesArchiveCompte($membre_id, $etat);
            //heures archivées
            $etat = 0;
            $membre_taches_archive = $app->SkolkovTachesMembre($membre_id, $etat);
            
            $heures_total = strtotime("");
            
            foreach ($membre_taches_archive as $tache)
            {
				$heures_total = $heures_total + $tache['TOTAL'];
			}
			?>



	<div class="row bg-white mt-5">
		
		<div class="col-6 col-lg-3 p-2">
			<div class="text-center">
				<i class="text-info fas fa-stopwatch fa-2x"></i>
				<h2 class="mt-2" data-to="500" data-speed="500"><?php echo $compteurs_compte ?></h2>
				<p class="m-0px font-w-600">Compteurs</p>
			</div>
		</div>
		
		<div class="col-6 col-lg-3 p-2">
			<div class="text-center">
				<i class="text-info fas fa-clipboard-list fa-2x"></i>
				<h2 class="mt-2" data-to="850" data-speed="850"><?php echo $taches_dispo ?></h2>
				<p class="m-0px font-w-600">tâches en cours</p>
			</div>
		</div>
		
		<div class="col-6 col-lg-3 p-2">
			<div class="text-center">
				<i class="text-info fas fa-list-ul fa-2x"></i>
				<h2 class="mt-2" data-to="150" data-speed="150"><?php echo $taches_archive ?></h2>
				<p class="m-0px font-w-600">tâches archivées</p>
			</div>
		</div>
				
		
		
		<div class="col-6 col-lg-3 p-2">
			<div class="text-center">
				<i class="text-info fas fa-clock fa-2x"></i>
				<h2 class="mt-2" data-to="190" data-speed="190"><?php echo $heures_total ?></h2>
				<p class="m-0px font-w-600">heures archivées</p>
			</div>
		</div>
		
	</div>

<?php
	}
	else
	{
	?>
	<div class="row  align-items-center mt-5 p-3" style="border-radius: 15px;">
		<div class="col text-center">
			<div class="card bg-white " style="width: 400px; border: 0;">
				<a class="btn" href="index.php" data-title="retour à l'index"><i class="fas fa-home"></i></a>
				<p> login nécessaire pour accèder à cette page.</p>
			</div>
		</div>
	</div>
					
	<?php
	}

	?>
</div>
