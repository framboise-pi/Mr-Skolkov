<?php
/*
 * Mr.SKOLKOV
 * LAFONTAINE Cédric Camille - codelibre.fr - tous droits reservés
 * https://github.com/framboise-pi/
 * core/historique.php
 * 
*/
?>

<div class="container">
<?php
    if (isset($_SESSION["skolkov_identifiant"]) && isset($_SESSION["avatar"]))
    { 
?>
	
	<div class="row align-items-center flex-row-reverse bg-white mt-5 p-3" style="border-radius: 15px;">
	    
	    <div class="col-lg-8">
		<div class="bg-light p-4 m-2" style="border-radius: 10px;">
		    <h2 class="">Mr. Skolkov</h2>

		    <div class="text-start" style="font-family: 'Urbanist'; font-size: 16px;" >
			<span id="daytoday"></span>
			<span class="text-secondary" id="clock"></span>
		    </div>				

		    <div class="mt-5">
			<p>version 0.1 - Apprenti Alchimiste</p>
			<ul>
			    <li>[reglages] compteurs membre - à animer</li>
			    <li>[avatar] éditer + [table] sauvegarde, liste/selection</li>
			    <li>syntaxe des dates day month hour:min:s</li>
			    <li>[sql] tache/archivage avec temps total</li>
			    <li>ajout page 'historique'</li>
			
			</ul>
		    </div>
		    
		    <div class="mt-2">
			<p>futur</p>
			<ul>
			    <li>[tache] création icone fa sql (manuel pour l'instant)</li>
			    <li>[info] comptes compteurs/taches totaux - placer sous image</li>
			    <li>[taches/compteurs] btn avec avatar + membre_nom + date/heure</li>
			    <li>[anciens compteurs] limiter nombre req sql</li>
			    <li>[tache/archivage] ajout d'une input texte à l'archivage</li>
			    <li>ajout Gihub</li>
			    <li>[code] système de langage - EN - RU + config + sql colonne LANG/char/5 + $_SESSION</li>
			    <li>vérif login nécessaire - include</li>
			</ul>
		    </div>
				
		    <div class="row mt-5">
			<div class="col-md-6">
			    <div class="">
							

			    </div>
			</div>
			<div class="col-md-6">
			    <div class="">

			    </div>
			</div>
		    </div>
				
		</div><!--  -->
	    </div><!-- col -->
                    
	    <div class="col-lg-4">
			
		<a class="btn" href="index.php" data-title="retour à l'index"><i class="fas fa-home fa-2x"></i></a>
		<div class="">
		    <div style="margin-left: auto; margin-right: auto;">
			<img style="border-radius: 10px;" class="img-fluid" src="core/imgz/background/background_MrSkolkov_02.jpg">
		    </div>
		</div>
	    </div><!-- col -->
	</div><!-- row -->

<!-- COMPTEURS -->
<!--
	<div class="row bg-white mt-2" style="border-radius: 10px;">
	    
	    <div class="col-6 col-lg-3 p-2" style="">
		<div class="text-center">
		    <i class="text-info fas fa-stopwatch fa-2x"></i>
		    <h2 class="mt-2" data-to="500" data-speed="500">164</h2>
		    <p class="m-0px font-w-600">Compteurs</p>
		</div>
	    </div>
		
	    <div class="col-6 col-lg-3 p-2">
		<div class="text-center">
		    <i class="text-info fas fa-list-ul fa-2x"></i>
		    <h2 class="mt-2" data-to="150" data-speed="150">326</h2>
		    <p class="m-0px font-w-600">tâches archivées</p>
		</div>
	    </div>
				
	    <div class="col-6 col-lg-3 p-2">
		<div class="text-center">
		    <i class="text-info fas fa-clipboard-list fa-2x"></i>
		    <h2 class="mt-2" data-to="850" data-speed="850">214</h2>
		    <p class="m-0px font-w-600">tâches en cours</p>
		</div>
	    </div>
		
	    <div class="col-6 col-lg-3">
		<div class="text-center fa-2x">
		    <h2 class="mt-2" data-to="190" data-speed="190">190</h2>
		    <p class="m-0px font-w-600">Telephonic Talk</p>
		</div>
	    </div>
	</div>
-->
<?php
    }
    else
    {
?>
	<div class="row  align-items-center mt-5 p-3" style="border-radius: 15px;">
	    <div class="col text-center">
		<div class="card bg-white " style="width: 400px; border: 0;">
		    <a class="btn" href="index.php" data-title="retour à l'index"><i class="fas fa-home fa-2x"></i></a>
		    <p> login nécessaire pour accèder à cette page.</p>
		</div>
	    </div>
	</div>
	
<?php
    }
?>
</div>
