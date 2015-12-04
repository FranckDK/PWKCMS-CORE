<?php
ini_set('display_errors',1);
//Connexion à la base de données
include('03-CONFIG/01-BDD.php');
//inclusion fonction date
//include('03-CONFIG/date.php');
//Inclusion du header
include('01-TEMPLATE/FLAT/01-HEADER.php');
//Permissions
include('03-CONFIG/10-perm_modules.php');
//Tronquage
include('05-PLUGINS/Tronquage/tronquage.php');
?>
  <body>

<?php include('01-TEMPLATE/FLAT/03-NAVBAR.php'); // NAVBAR ?>

<!--breadcrumbs start-->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-sm-6">
                    <h1><?php echo $_CMS_SLOGAN;?></h1>
                </div>
                <div class="col-lg-6 col-sm-6">
                    <!--<ol class="breadcrumb pull-right">                                            
                        <li class="active">Accueil</li>
                    </ol>-->
                </div>
            </div>
        </div>
    </div>
    <!--breadcrumbs end-->
    <!--container start-->
    <div class="container">
        <div class="row" >
            <!--feature start-->
            		

        <div class="row mbot50">
		
		 <div class="col-lg-6">
                <!--testimonial start-->
                <div class="about-testimonial boxed-style about-flexslider ">
                    <section class="slider">
                        <div class="flexslider">
                            <ul class="slides about-flex-slides">
                                <li>
                                    <div class="about-testimonial-image ">
                                        <img alt="" src="02-IMAGES/avatar1.jpg">
                                    </div>
                                    <a class="about-testimonial-author" href="#">Franck-Richard</a>
                                    <span class="about-testimonial-company">Webmaster</span>
                                    <div class="about-testimonial-content">
                                        <p class="about-testimonial-quote">
                                            Je vous souhaite la bienvenue sur mon site internet.<br/>
											Membre de ma famille, relation personnelle ou professionnelle, n'hésitez pas à me contacter !
                                        </p>
                                    </div>
                                </li>
                                <li>
                                    <div class="about-testimonial-image ">
                                        <img alt="" src="02-IMAGES/avatar1.jpg">
                                    </div>
                                    <a class="about-testimonial-author" href="#">Franck-Richard</a>
                                    <span class="about-testimonial-company">Webmaster</span>
                                    <div class="about-testimonial-content">
                                        <p class="about-testimonial-quote">
                                            Famille et Amis, n'hésitez pas à vous inscrire sur le forum !
                                        </p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </section>
                </div>
                <!--testimonial end-->
            </div>
			<div class="col-lg-6">
			<div class="blog-post">
                        <h3>Les dernières news</h3>
<?php
//DEFINITION DATE DU JOUR
date_default_timezone_set('UTC');
$datejour = date('Y-m-d');
//AUTO-(DES)ACTIVATION DES BREVES
$req01 = $bdd->prepare("SELECT * FROM cms_breves");
$req01->execute();
//$res01 = $req01->fetch(PDO::FETCH_ASSOC);
//$reponse1 = mysql_query("SELECT * FROM cms_breves")or die(mysql_error());
while ($donnees1 = $req01->fetch(PDO::FETCH_ASSOC))
{
$id = $donnees1['id'];
//ACTIVATION AUTOMATIQUE
$date_debut = $donnees1['date_debut'];
if ($date_debut!='0000-00-00' and $date_debut>='$datejour')
{
$bdd->query("UPDATE cms_breves SET actif='1' WHERE id=$id")or die(mysql_error());
}
//DESACTIVATION AUTOMATIQUE
$date_fin = $donnees1['date_fin'];
if ($date_fin!='0000-00-00' and $date_fin<=$datejour)
{
$bdd->query("UPDATE cms_breves SET actif='0' WHERE id=$id")or die(mysql_error());
}
//FIN AUTO-(DES)ACTIVATION DES BREVES
//AFFICHAGE DES BREVES
}
$req02 = $bdd->prepare("SELECT * FROM cms_breves WHERE actif='1' and accueil='1' and date_debut<='$datejour' order by date DESC LIMIT 3");
$req02->execute();
//$reponse = mysql_query("SELECT * FROM cms_breves WHERE actif='1' and accueil='1' and date_debut<='$datejour' order by date DESC")or die(mysql_error());
$visible='0';
while ($donnees = $req02->fetch(PDO::FETCH_ASSOC) )
{ 
$id = $donnees['id'];
//requete permissions
$req03 = $bdd->prepare("SELECT * FROM cms_breves_permissions WHERE breve_id='$id'");
$req03->execute();
while ($res03 = $req03->fetch(PDO::FETCH_ASSOC) )
{if (in_array($res03['autorisation'],$membre_groupes)) {$visible='1';} }
echo $res03['autorisation'];
//AFFICHAGE
if ($visible=='1')
{
$idn1=$donnees['id'];
$auteur1 = $donnees['auteur'];
$texte1 = $donnees['texte'];
$titre1 = $donnees['titre'];
$date1 = (stripslashes($donnees['date']));
$date2 = explode("-", $date1);
$visible='0';
$nb_mots = '10';
$texte1=debutchaine($texte1, $nb_mots, $idn1);
?>
<div class="media">
                            <a class="pull-left" href="javascript:;">
                                <img class=" " src="02-IMAGES/blog-thumb-1.jpg" alt="">
                            </a>
                            <div class="media-body">
                                <h3><p class="media-heading text-primary"><?php echo $titre1; echo $res03['autorisation'];?></p></h3>
                                <?php echo $texte1;?>
                            </div>
                        </div>
						<hr/>
<?php
}
}
?>


                        
			</div>
              
            </div>
			
           
			
        </div>
<div class="col-lg-4 col-sm-4">
                <section>
				<a href="http://webmail.piwowarczyk.fr" target="blank">
                    <div class="f-box">
                        <i class=" fa fa-envelope"></i>
                        <h2>Webmail</h2>
						<p class="f-text">Pour accéder à vos mails</p>
                    </div>
				</a>
                    
                </section>
            </div>
            <div class="col-lg-4 col-sm-4">
                <section>
				<a href="http://services.piwowarczyk.fr/cloud" target="blank">
                    <div class="f-box">
                        <i class=" fa fa-cloud"></i>
                        <h2>Cloud</h2>
						<p class="f-text">Pour accéder à vos fichiers dans le nuage.</p>
                    </div>
					</a>
                   
                </section>
            </div>
            <div class="col-lg-4 col-sm-4">
                <section>
			<a href="module.php?id=CV">
                    <div class="f-box">
                        <i class="fa fa-info"></i>
                        <h2>Mon curriculum vitae</h2>
						<p class="f-text">Mon parcours professionnel</p>
                    </div>
            </a>        
                </section>
            </div>
            <!--feature end-->
        

 
            
        </div>
        
            <!--quote start-->
            
                <div class="col-lg-9 col-sm-9">
                    <div class="quote-info">
                        <h1>Développement</h1>
                        <p>Site internet créé et administré par Franck-Richard PIWOWARCZYK</p>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-3">
				
                    <a href="#" class="btn btn-danger purchase-btn">Version <?php echo $_CMS_VERSION;?></a>
                </div>
            
            <!--quote end-->
        
    </div>

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
