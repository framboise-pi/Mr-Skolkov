<?php
/*
 * Mr.SKOLKOV
 * LAFONTAINE Cédric Camille - codelibre.fr - tous droits reservés
 * https://github.com/framboise-pi/
 * core/veille.php
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

<img src="./core/imgz/background/background_MrSkolkov_05.jpg" class="creative-bg">

<div class="row justify-content-center">
  <div class="card mt-5" style="width: 480px; border-radius: 5%;">
  <!--<img class="card-img-top rounded p-2" src="./core/imgz/login/01.jpg" alt="">-->


    <div class="col text-end mt-2">  

    <?php
      $utilisateur = $_SESSION["skolkov_identifiant"];

      if (isset($utilisateur))
      {
    ?>
    
        <form method="POST" action="index.php">
          
        <button class="btn" type="submit" name="historique"
        title="Mr. Skolkov: informations" data-bs-toggle="tooltip" data-bs-placement="bottom"><i class="text-info fas fa-info-circle"></i></button>

        <button class="btn" type="submit" name="reglages"
        title="voir vos préférences" data-bs-toggle="tooltip" data-bs-placement="bottom"><i class="text-info fas fa-cogs"></i></button>

  <!--<button class="btn" type="submit" name="historique" data-title="historique">
      <i class="text-secondary fas fa-history"></i>
    </button>-->
        <button class="btn" type="submit" name="rapide"
        title="vue rapide" data-bs-toggle="tooltip" data-bs-placement="bottom">
        <i class="fa-solid fa-bolt-lightning"></i>
        </button>

    
        <button class="btn position-relative" type="submit"
         name="compteurs" title="voir tous vos compteurs" data-bs-toggle="tooltip" data-bs-placement="bottom">
    
        <?php
        if (isset($_SESSION["skolkov_id"]))
        {
          $membre_id = $_SESSION["skolkov_id"];
          $app = new Skolkov_Fonctions();
          $compteurs_compte = $app->SkolkovMembreCompteurs ($membre_id, 1);
                
          ?>
          <i class="fas fa-stopwatch"></i>
          <span style="font-size: 0.55em;" class="position-absolute top-0 start-80 translate-bottom badge rounded-pill bg-light text-dark"><?php echo count($compteurs_compte); ?></span>

          <?php
          }
          ?>
        </button>

        <button class="btn" type="submit" name="taches" title="voir vos tâches" data-bs-toggle="tooltip" data-bs-placement="bottom"><i class="fas fa-tasks"></i></button>

        <button class="btn" type="submit" name="logout" title="quitter" data-bs-toggle="tooltip" data-bs-placement="bottom"><i class="text-danger fas fa-sign-out-alt"></i></button>
    
        </form>
    
    <?php

        }

        else if (is_Null($utilisateur))
        {
          $utilisateur = "non connecté";
          
          if ($register_user)
          {
            ?>
            <!--<div title="ajouter un utilisateur" data-bs-toggle="tooltip" data-bs-placement="top">-->
              <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#Modal-adduser"><i class="text-success fas fa-plus-circle"></i></button>
          
          <?php
          }
          ?>
          
          <!--<div title="se connecter" data-bs-toggle="tooltip" data-bs-placement="top">-->
            <button type="button" class="btn" data-title="login" data-bs-toggle="modal" data-bs-target="#Modal-login"><i class="text-success fas fa-sign-in-alt"></i></button>
            <!--<a href="index.php?vue=login" data-title="login"><i class="text-success fas fa-sign-in-alt"></i></a>-->
        <?php
        }
        ?>

        </div><!-- col -->
<!-- row -->
<!-- col menu en haut -->

        <div class="card-body">

          <p class="card-title text-center" style="font-family: 'Urbanist';font-size: 40px;">Mr. Skolkov</p>
          <p class="card-title text-center mb-5" style="font-family: 'Urbanist';font-size: 12px;"><?php echo $utilisateur; ?></p>
          
          <div class="mb-3 col">
              <?php
              if (isset($_SESSION["skolkov_identifiant"]) && isset($_SESSION["avatar"]))
              { 
                require_once("./core/lib/Multiavatar-php/Multiavatar.php");
                $multiavatar = new Multiavatar($_SESSION["avatar"], null, null);

              ?>
              <div style="margin-left: auto; margin-right: auto; width: 100px; heigth: 100px;">
                <?php echo($multiavatar->svgCode); ?>
              </div>
              <?php
                }
                ?>

            </div>      
      
            <div class="text-center" >
                <span style="font-family: 'Urbanist'; font-size: 20px;" id="daytoday"></span>
            </div>
            
            <div class="text-center" >
                <span style="font-family: 'CairoPlay'; font-size: 56px;" id="clock"></span>
            </div>
                  
            <form>
    
            <div class="form-group">

      <div class="mt-3 row text-center">
        
      </div><!-- row -->
    
      <div class="mt-3 mb-3 row text-center">
        <div class="mt-3 col-6" title="commencer un chronomètre" data-bs-toggle="tooltip" data-bs-placement="left">
          <button type="button" class="btn btn-outline-success btn-lg"  data-bs-toggle="modal" data-bs-target="#Modalentree">
            <small>pointer un </small>début
          </button>
        </div>
          
        <div class="mt-3 col-6" title="finir un chronomètre" data-bs-toggle="tooltip" data-bs-placement="right">
          <button type="button" class="btn btn-outline-primary btn-lg"  data-bs-toggle="modal" data-bs-target="#Modal-fin">
            <small>pointer une </small>fin</button>
        </div>
      </div><!-- row -->
    
    </div><!-- form group -->
  </form>
      
</div><!-- body/card -->
  <!-- <div class="card-footer text-muted mt-2 text-center">

  </div>-->
  
</div><!-- card -->

</div><!-- row -->
