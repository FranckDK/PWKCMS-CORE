 <?php 
 //RECUPERATION DU NOM DE L'EXTENSION A TELECHARGER
 $EXT_NOM=$_GET['ext'];
 ?>
 <!--navigation start-->
                      <nav class="navbar navbar-inverse" role="navigation">
                          <!-- Brand and toggle get grouped for better mobile display -->
                          <div class="navbar-header">
                              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                                  <span class="sr-only">Toggle navigation</span>
                                  <span class="fa fa-bars"></span>
                              </button>
							  <a class="navbar-brand" href="admin.php"><i class="fa fa-dashboard"></i></a>
                              <a class="navbar-brand" href="admin.php?config=MarketPlace">MarketPlace</a>
                          </div>

                          <!-- Collect the nav links, forms, and other content for toggling -->
                          <div class="collapse navbar-collapse navbar-ex1-collapse">
                              <ul class="nav navbar-nav">
                                  <li class="active"><a href="#">Installation du module <?php echo $EXT_NOM;?> - ETAPE 1</a></li>
                              </ul>
                          </div><!-- /.navbar-collapse -->
                      </nav>
                      <!--navigation end-->
					  					  <section class="panel">
                          <header class="panel-heading">
                              Vérifications préalables à l'installation
                          </header>
                          <div class="panel-body">
Vérification de l'état du dépôt : 
<?php
//Fonction qui teste l'existence d'un fichier distant : Valeur à 1 si fichier trouvé
function FichierDistantExiste($url) {
   if(!@fopen($url, 'r')) return false;
   else return true;
}
//On initialise la variable
$REPO_ONLINE="HORS LIGNE";
//On commence par récupérer l'URL du dépôt
$REPO_ID=$_GET['repo'];
$req01= $bdd->prepare("SELECT * FROM cms_marketplace WHERE marketplace_repo_id=$REPO_ID");
$req01->execute();
while ($donnees01 = $req01->fetch(PDO::FETCH_ASSOC))
{
$REPO_URL = $donnees01['marketplace_repo_url'];
}
//On vérifie que le dépôt est en ligne
$REPO_URL_TEST = $REPO_URL.'/00-liste_extensions.txt';
if(FichierDistantExiste($REPO_URL_TEST)=='1'){$REPO_ONLINE="EN LIGNE";}
echo $REPO_ONLINE;
echo '<br/>';
?>                           
</div>
</section>					  
					  
					  
					  