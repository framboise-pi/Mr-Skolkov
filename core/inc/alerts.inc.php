<?php
/*
 * Mr.SKOLKOV
 * LAFONTAINE Cédric Camille - codelibre.fr - tous droits reservés
 * https://github.com/framboise-pi/
 * core/alerts.inc.php
 * 
*/

if(isset($errorMsg))
{
    ?>
    <div class="container-fluid mt-2">
        <div class="row text-center">
            <?php
                foreach($errorMsg as $error)
                {
                ?>
                    <div class="col-12" id="alert">
                        <div class="alert alert-danger">
                            <i class="fas fa-bug"></i> : <?php echo $error; ?>
                        </div>
                    </div>
                <?php
                }
                ?>
        </div>
    </div>

<?php
}

if(isset($successMsg))
{
    ?>
    <div class="container-fluid mt-2">
        <div class="row text-center">
            <?php
                foreach($successMsg as $success)
                {
                ?>
                    <div class="col-12" id="alert">
                        <div class="alert alert-success">
                            <i class="fas fa-bug"></i> : <?php echo $success; ?>
                        </div>
                    </div>
                <?php
                }
                ?>
        </div>
    </div>

<?php
}

?>
