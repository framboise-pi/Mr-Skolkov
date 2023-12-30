<?php
/*
 * Mr.SKOLKOV
 * LAFONTAINE Cédric Camille - codelibre.fr - tous droits reservés
 * https://github.com/framboise-pi/
 * core/backtotop.inc.php
 * this code is mostly paste from a source I do not remember
*/
?>

<!-- Styles your button (this is a black square with white text) -->
<style>
  .back-to-top {
    background-color: #000000;
    color: #FFFFFF;
    opacity: 0;
    transition: opacity .6s ease-in-out;
    z-index: 999;
    position: fixed;
    right: 20px;
    bottom: 20px;
    width: 50px;
    height: 50px;
    box-sizing: border-box;
    border-radius: 0%;
  }

  a.back-to-top {
    font-weight: 1000;
    letter-spacing: 2px;
    font-size: 14px;
    text-transform: uppercase;
    text-align: center;
    line-height: 1.6;
    padding-left: 2px;
    padding-top: 14px;
  }

  .back-to-top:hover, .back-to-top:focus, .back-to-top:visited {
    color: #FFFFFF;
  }

  .back-to-top.show {
    opacity: 1;
  }
</style>

<!-- Adds the back to top link to your website -->
<a href="#" id="back-to-top" class="back-to-top" style="display: inline;">HAUT</a>

<!-- Fades in the button when you scroll down -->
<script>
  var link = document.getElementById("back-to-top");
  var amountScrolled = 250;

  window.addEventListener('scroll', function(e) {
      if ( window.pageYOffset > amountScrolled ) {
          link.classList.add('show');
      } else {
          link.className = 'back-to-top';
      }
  });

<!-- Scrolls to Top -->
  link.addEventListener('click', function(e) {
      e.preventDefault();

      var distance = 0 - window.pageYOffset;
      var increments = distance/(50/16);
      function animateScroll() {
          window.scrollBy(0, increments);
          if (window.pageYOffset <= document.body.offsetTop) {
              clearInterval(runAnimation);
          }
      };
      // Loop the animation function
      var runAnimation = setInterval(animateScroll, 16);
  });
</script>	
