<?php
/*
 * Mr.SKOLKOV
 * LAFONTAINE Cédric Camille - codelibre.fr - tous droits reservés
 * https://github.com/framboise-pi/
 * core/modals.inc.php
 * 
*/
?>
<!-- Modal COMPTEUR DEBUT-->

<div class="modal fade" id="Modalentree" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="">NOUVEAU COMPTEUR</h5>
        <div type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <i class="fas fa-times-circle"></i>
        </div>
      </div>
      <div class="modal-body">
    
      <form method="POST" action="index.php">
      
      <select class="form-select"  name="tache_id" aria-label="">
      <option selected>choisir une tâche/mission</option>
  
      <?php
      if (isset($_SESSION["skolkov_id"]))
      {
        $membre_id = $_SESSION["skolkov_id"];
        $app = new Skolkov_Fonctions();
        $taches = $app->SkolkovTachesMembre ($membre_id, 1);
        foreach ($taches as $tache)
        {
          
          ?>
          <option value="<?php echo $tache['ID'] ?>"><?php echo $tache['TITRE'] ?></option>
          <?php

        }
      }
      else
      {
        //errorlogin
      }

      ?>

</select>

      <div class="d-flex col-12 mt-4">
        <p class="text-muted">commentaires à laisser:</p>
      </div>
      
    <div class="form-group">
      <div class="col-12 mb-4">
        <input type="text" class="form-control input-lg" name="compteur_texte">
        </input>
      </div>
    </div>
  </div>
  
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
        <button type="submit" class="btn btn-primary" name="compteur_debut_bouton">Enregistrer</button>
      </div>
      </form>

    </div>
  </div>
</div>

<!-- Modal COMPTEUR FIN-->

<div class="modal fade" id="Modal-fin" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="">TERMINER UN COMPTEUR</h5>
        <div type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <i class="fas fa-times-circle"></i>
        </div>
      </div>
      <div class="modal-body">
    
    <form method="POST" action="index.php">
      
      <select class="form-select" name="compteur_fin" aria-label="">
  <option selected>choisir un compteur en cours</option>
  
  <?php
  if (isset($_SESSION["skolkov_id"]))
  {
    $membre_id = $_SESSION["skolkov_id"];
    
    $app = new Skolkov_Fonctions();
    $compteurs_en_cours = $app->SkolkovMembreCompteurs ($membre_id, 1);
    foreach ($compteurs_en_cours as $compteur)
    {
      //récupérer la tache-titre
      $compteur_tache_id = $compteur['ID_TACHE'];
      $app = new Skolkov_Fonctions();
      $compteur_tache = $app->SkolkovCompteurTache($compteur_tache_id);
      ?>
      <option value="<?php echo $compteur['ID'] ?>">
      <?php echo $compteur['DATE_DEBUT']  . " | " . $compteur_tache['TITRE'] . " | " . $compteur['TEXTE']; ?>
      
      </option>
      <?php
//
    }
  }
  else
  {
    //errorlogin
  }

  ?>
  
</select>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
        <button type="submit" class="btn btn-primary" name="compteur_fin_bouton">Enregistrer</button>
      </div>
      </form>

    </div>
  </div>
</div>

<!-- Modal LOGIN-->

<div class="modal fade" id="Modal-login" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="">se connecter - login</h5>
        <div type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <i class="fas fa-times-circle"></i>
        </div>
      </div>
      <div class="modal-body">
        
        <form method="POST" action="index.php">
        <div class="input-group input-group-sm mt-4">
          <div class="input-group-prepend">
            <span class="input-group-text">identifiant</span>
          </div>
          <input type="text" class="form-control" name="identifiant" aria-label="" aria-describedby="i">
        </div>

      <div class="input-group input-group-sm mt-4">
        <div class="input-group-prepend">
        <span class="input-group-text">secret</span>
        </div>
      <input type="text" class="form-control" name="secret" aria-label="" aria-describedby="">
      </div>
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">annuler</button>
        <button type="submit" class="btn btn-primary">connecter</button>
      </div>
      
      </form>
    </div>
  </div>
</div>

<!-- Modal + TACHE-->

<div class="modal fade" id="Modal-tache" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="">ajouter une tâche</h5>
        <div type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <i class="text-danger fas fa-times-circle"></i>
        </div>
      </div>
      <div class="modal-body">
        
        <form method="POST" action="index.php">
        <div class="input-group input-group-sm mt-4">
          <div class="input-group-prepend">
            <span class="input-group-text">titre</span>
          </div>
          <input type="text" class="form-control" name="tache_ajout" aria-label="" aria-describedby="">
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">annuler</button>
        <button type="submit" class="btn btn-success">ajouter</button>
      </div>
      
      </form>
    </div>
  </div>
</div>

<!-- Modal + USER-->

<div class="modal fade" id="Modal-adduser" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="">ajouter un membre</h5>
        <div type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <i class="text-danger fas fa-times-circle"></i>
        </div>
      </div>
      <div class="modal-body">
                
        <form method="POST" action="index.php">
          
        <div class="input-group input-group-sm mt-4">
          <div class="input-group-prepend">
            <span class="input-group-text">nom</span>
          </div>
          <input type="text" class="form-control" name="adduser_name" aria-label="" aria-describedby="">
        </div>

        <div class="input-group input-group-sm mt-4">
          <div class="input-group-prepend">
            <span class="input-group-text">secret</span>
          </div>
          <input type="text" class="form-control" name="adduser_secret" aria-label="" aria-describedby="">
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">annuler</button>
        <button type="submit" class="btn btn-success" name="adduser_btn">ajouter</button>
      </div>
      
      </form>
    </div>
  </div>
</div>

<!-- Modal liste AVATARS -->

<div class="modal fade" id="Modal-avatars" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="">changer d'avatar</h5>
        <div type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <i class="fas fa-times-circle"></i>
        </div>
      </div>
      <div class="modal-body">
         <form method="POST" action="index.php">
        <small>choisir un avatar sauvegardé:</small>
        <!-- <div class="card-group text-center mt-2"> -->
        <div class="row row-cols-1 row-cols-md-4 g-4">
          <?php
          //sql récuper tous les avatars du membre
            $membre_id = $_SESSION["skolkov_id"];
            $avatar_id = $_SESSION["avatar_id"];
            $app = new Skolkov_Fonctions();
            $membre_avatars = $app->SkolkovMembreAvatars($membre_id);
      	  foreach ($membre_avatars as $avatar)
          {
             $multiavatar = new Multiavatar($avatar['AVATAR'], false, null);
        
?>

<div class="card p-1" style="border: none;">

          <button type="submit" class="btn btn-transparent text-center" value="<?php echo $avatar['ID'] ?>" name="avatar_changer">
                    <div style="margin :auto; width: 64px; height: 64px;">
            <?php echo($multiavatar->svgCode); ?>
          </div>

          </button>

        </div>
            
        <?php
          }
        ?>

      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">annuler</button>
        
        <button class="btn btn-info text-white" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#Modal-avatar">créer un nouvel avatar</button>
      </div>
      
      </form>
    </div>
  </div>
</div>

<!-- Modal nouvel AVATAR-->

<div class="modal fade" id="Modal-avatar" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="">créer un avatar</h5>
        <div type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <i class="fas fa-times-circle"></i>
        </div>
      </div>
      <div class="modal-body">
        
     <?php include ("core/inc/avatar.inc.php"); ?>
      
      </div>
      
      </form>
    </div>
  </div>
</div>
