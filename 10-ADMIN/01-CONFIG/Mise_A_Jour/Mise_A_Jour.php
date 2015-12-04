                     <!--navigation start-->
                      <nav class="navbar navbar-inverse" role="navigation">
                          <!-- Brand and toggle get grouped for better mobile display -->
                          <div class="navbar-header">
                              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                                  <span class="sr-only">Toggle navigation</span>
                                  <span class="fa fa-bars"></span>
                              </button>
                              <a class="navbar-brand" href="#">Mise à jour du Système</a>
                          </div>

                          <!-- Collect the nav links, forms, and other content for toggling -->
                          <div class="collapse navbar-collapse navbar-ex1-collapse">
                              <ul class="nav navbar-nav">
                                  <li class="active"><a href="#">Vue d'ensemble</a></li>
                              </ul>
                          </div><!-- /.navbar-collapse -->
                      </nav>
                      <!--navigation end-->
					  <!--state overview start-->
              <div class="row state-overview">
                  <div class="col-lg-6 col-sm-6">
                      <section class="panel">
                          <div class="symbol blue">
                              <i class="fa fa-info"></i>
                          </div>
                          <div class="value">
						  <p>Version installée</p>
                              <h1 class="count">
<?php
// ON VERIFIE SI ON CHERCHE UNE MAJ STABLE OU NON
$fichier = file("version.txt"); // Nom du fichier à afficher, son adresse de localisation
$total = count($fichier); // Nombre total des lignes du fichier
for($i = 0; $i < $total; $i++) 
{ // Départ de la boucle
$CMS_VERSION=$fichier[$i];
//echo $CMS_VERSION; // On affiche ligne par ligne le contenu du fichier
} // Fin de la boucle
echo $CMS_VERSION;
$EXPERT='';
if(isset($_GET['devel'])){$EXPERT='&devel';}

?>
                              </h1>
                              
                          </div>
                      </section>
                  </div>
<?php
// ON DIT AU SCRIPT QU'IL A 60 SECONDES POUR S'EXECUTER (EVITE DE PLANTER LE SERVEUR)
ini_set('max_execution_time',60);
// ON VERIFIE SUR LE SERVEUR DISTANT SI UNE MAJ EST DISPO
$getVersions = file_get_contents('http://services.piwowarczyk.fr/cms_update/01-version.txt') or die ('</div><p>Le serveur de mise à jour est indisponible pour le moment, veuillez retenter ultérieurement.</p>');
if ($getVersions != '')
{
	$versionList = explode("\n", $getVersions);	
	$found='false';
	
	foreach ($versionList as $aV)
	{
if($found=='false'){

		if (version_compare($aV, $CMS_VERSION) > 0) {
			
//On ne cherche ici que les version stables
$trouvemoi='-';
$machaine=rtrim($aV);
$position  = strpos($aV, $trouvemoi);
if (!isset($_GET['devel'])){
if ($position  === false) {
$found = true;
$new_version=rtrim($aV);
break;
}
}
//Ici on cherche toutes les versions si on est en mode developpeur.
elseif (isset($_GET['devel'])) {$found = true; $new_version=rtrim($aV);}
	}
	}
	}
	
if ($found=="true")
{

	?><div class="col-lg-6 col-sm-6">
                      <section class="panel">
                          <div class="symbol red">
                              <i class="fa fa-exclamation-triangle"></i>
                          </div>
                          <div class="value">
						  <p>Version disponible</p>
                              <h1 class=" count3">
							  <?php echo $new_version;?>
							    </h1>
                              
                          </div>
                      </section>
                  </div>
				  <?php
}
	else{?><div class="col-lg-6 col-sm-6">
                      <section class="panel">
                          <div class="symbol terques">
                              <i class="fa fa-smile-o"></i>
                          </div>
                          <div class="value">
						  
                              <h1 class=" count3">
							  Vous disposez de la dernière version.
							    </h1>
                              
                          </div>
                      </section>
                  </div>
				  <?php
				  }

?></div><?php	
}
else {echo '</div><p>Le serveur de mise à jour est indisponible pour le moment, veuillez retenter ultérieurement.</p>';}

if($new_version!=''){
?>
                      <section class="panel">
                          <header class="panel-heading">
                              Processus de mise à jour...
                          </header>
                          <div class="panel-body">
                              <a href="admin.php?config=Mise_A_Jour&do=Telechargement"><button type="button" class="btn btn-success btn-lg btn-block">Cliquer ici pour effectuer la mise à jour.</button></a>
                              
                          </div>
                      </section>
					                        <!--tab nav start-->
                      <section class="panel">
                          <header class="panel-heading tab-bg-dark-navy-blue">
                              <ul class="nav nav-tabs">
                                  <li>
                                      <a data-toggle="tab" href="#home-2">
                                          <i class="fa fa-info"></i>
                                      </a>
                                  </li>
                                  <li class="active">
                                      <a data-toggle="tab" href="#about-2">
                                          <i class="fa fa-terminal"></i>
                                          Liste des changements <?php echo $new_version;?>
                                      </a>
                                  </li>
                                  
                              </ul>
                          </header>
						 
                          <div class="panel-body">
                              <div class="tab-content">
                                  <div id="home-2" class="tab-pane ">
                                      Cet encadré s'affiche automatiquement lorsqu'une nouvelle version est disponible.
									  Vous retrouvez ici les changements introduits par cette nouvelle version.
                                  </div>
                                  <div id="about-2" class="tab-pane active"><?php
$MAJ_INFO_URL=('http://services.piwowarczyk.fr/cms_update/version-'.$new_version.'.txt');
$INFO01= getinfos($MAJ_INFO_URL);
if($INFO01[http_code] == 200){
$fichier1 = file($MAJ_INFO_URL); // Nom du fichier à afficher, son adresse de localisation
$total1 = count($fichier1); // Nombre total des lignes du fichier
for($i = 0; $i < $total1; $i++) 
{ // Départ de la boucle
echo $fichier1[$i];
echo('<br/>');
} // Fin de la boucle
}else{echo('Attention, aucun changelog détécté, mieux vaut éviter cette mise à jour.');}
								  ?></div>
                                  
                              </div>
                          </div>
                      </section>
                      <!--tab nav start-->

<?php	
}
?>
</div>

<?php
//AFFICHAGE DU BOUTON DE SWITCH MAJ VERSIONS STABLE OU INSTABLE
if(!isset($_GET['devel']) && $new_version=='') {echo('<a href="admin.php?config=Mise_A_Jour&devel"><button type="button" class="btn btn-warning btn_xs  btn-block">Vérifier la disponibilité d\'une version de développement.</button></a>');}
elseif(isset($_GET['devel'])){echo('<a href="admin.php?config=Mise_A_Jour"><button type="button" class="btn btn-info btn_xs  btn-block">Vérifier la disponibilité d\'une version stable.</button></a>');}
?>