<?php
//Connexion à la base de données
include('03-CONFIG/01-BDD.php');
//Inclusion du header
include('01-TEMPLATE/FLAT/01-HEADER.php');
//inclusion fonction date
include('03-CONFIG/date.php');
?>
  <body>

<?php include('01-TEMPLATE/FLAT/03-NAVBAR.php'); // NAVBAR ?>
<?php 
//Inclusion du module
include('01-TEMPLATE/FLAT/04-MODULE.php');
?>
<?php include('01-TEMPLATE/FLAT/02-FOOTER.php'); //Inclusion du footer ?>


    <!-- js placed at the end of the document so the pages load faster -->
    <script src="01-TEMPLATE/FLAT/js/jquery.js"></script>
    <script src="01-TEMPLATE/FLAT/js/jquery-1.8.3.min.js"></script>
    <script src="01-TEMPLATE/FLAT/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="01-TEMPLATE/FLAT/js/hover-dropdown.js"></script>
    <script defer src="01-TEMPLATE/FLAT/js/jquery.flexslider.js"></script>
    <script type="text/javascript" src="01-TEMPLATE/FLAT/assets/bxslider/jquery.bxslider.js"></script>

    <script type="text/javascript" src="01-TEMPLATE/FLAT/js/jquery.parallax-1.1.3.js"></script>

    <script src="01-TEMPLATE/FLAT/js/jquery.easing.min.js"></script>
    <script src="01-TEMPLATE/FLAT/js/link-hover.js"></script>

    <script src="01-TEMPLATE/FLAT/assets/fancybox/source/jquery.fancybox.pack.js"></script>

    <script type="text/javascript" src="01-TEMPLATE/FLAT/assets/revolution_slider/rs-plugin/js/jquery.themepunch.plugins.min.js"></script>
    <script type="text/javascript" src="01-TEMPLATE/FLAT/assets/revolution_slider/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>

    <!--common script for all pages-->
    <script src="01-TEMPLATE/FLAT/js/common-scripts.js"></script>

    <script src="01-TEMPLATE/FLAT/js/revulation-slide.js"></script>


  <script>

      RevSlide.initRevolutionSlider();

      $(window).load(function() {
          $('[data-zlname = reverse-effect]').mateHover({
              position: 'y-reverse',
              overlayStyle: 'rolling',
              overlayBg: '#fff',
              overlayOpacity: 0.7,
              overlayEasing: 'easeOutCirc',
              rollingPosition: 'top',
              popupEasing: 'easeOutBack',
              popup2Easing: 'easeOutBack'
          });
      });

      $(window).load(function() {
          $('.flexslider').flexslider({
              animation: "slide",
              start: function(slider) {
                  $('body').removeClass('loading');
              }
          });
      });

      //    fancybox
      jQuery(".fancybox").fancybox();



  </script>

  </body>
</html>