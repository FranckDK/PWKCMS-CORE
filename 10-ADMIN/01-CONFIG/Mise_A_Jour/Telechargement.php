
<!--navigation start-->
                      <nav class="navbar navbar-inverse" role="navigation">
                          <!-- Brand and toggle get grouped for better mobile display -->
                          <div class="navbar-header">
                              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                                  <span class="sr-only">Toggle navigation</span>
                                  <span class="fa fa-bars"></span>
                              </button>
                              <a class="navbar-brand" href="admin.php?config=Mise_A_Jour">Mise à jour du Système</a>
                          </div>

                          <!-- Collect the nav links, forms, and other content for toggling -->
                          <div class="collapse navbar-collapse navbar-ex1-collapse">
                              <ul class="nav navbar-nav">
                                  <li class="active"><a href="#">Téléchargement de la mise à jour</a></li>
                              </ul>
                          </div><!-- /.navbar-collapse -->
                      </nav>
                      <!--navigation end-->
					  <section class="panel">
                          <header class="panel-heading">
                              Progression de la mise à jour
                          </header>
                          <div class="panel-body">


                              <div class="progress progress-striped active progress-sm">
                                  <div class="progress-bar progress-bar-success"  role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 33%">
                                      <span class="sr-only">33% accompli</span>
                                  </div>
                              </div>
							  </div>
                      </section>
                      <!--progress bar end-->


<?php
$MAJ_ERREUR='0';
// ON VERIFIE SI ON CHERCHE UNE MAJ STABLE OU NON
$fichier = file("version.txt"); // Nom du fichier à afficher, son adresse de localisation
$total = count($fichier); // Nombre total des lignes du fichier
for($i = 0; $i < $total; $i++) 
{ // Départ de la boucle
$CMS_VERSION=$fichier[$i];
//echo $CMS_VERSION; // On affiche ligne par ligne le contenu du fichier
} // Fin de la boucle

//echo $CMS_VERSION;
$EXPERT='';
if(isset($_GET['devel'])){$EXPERT='&devel';}

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
$pos = strpos('-', $aV);
if ($pos === false) {
$found = true;
$new_version=rtrim($aV);
break;
}
//Ici on cherche toutes les versions si on est en mode developpeur.
elseif (isset($_GET['devel'])) {$found = true; $new_version=rtrim($aV);}
	}
}	
}
}
else{ echo '<section class="panel"><header class="panel-heading">Le serveur de mise à jour est indisponible pour le moment, veuillez retenter ultérieurement.</header></section>'; $MAJ_ERREUR++;}
// ON COMMENCE PAR VERIFIER QU'ON A PAS DEJA TELECHARGE LA MISE A JOUR
	if ( !is_file(  '90-PACKAGE/version-'.$new_version.'.zip' )) {
		// LA MAJ N'EST PAS TELECHARGEE, ON VA LE FAIRE MAINTENANT
		echo '<section class="panel"><header class="panel-heading">Téléchargement de la mise à jour</header></section>';
		// ON DEFINIT $MAJ_URL QUI EST L'ADRESSE DISTANTE DU PACKAGE
		$MAJ_URL=('http://services.piwowarczyk.fr/cms_update/version-'.$new_version.'.zip');
		// ON VA VERIFIER QUE LE FICHIER DISTANT EXISTE
		$infos = getInfos($MAJ_URL);
		if($infos['http_code'] == 200) {//LE FICHIER DISTANT EXISTE, ON CONTINUE
		// ON TELECHARGE LA MISE A JOUR
		$newUpdate = file_get_contents($MAJ_URL);
		// SI LE REPERTOIRE 90-PACKAGE/ N'EXISTE PAS, ON VA LE CREER
		if ( !is_dir( '90-PACKAGE/' ) ) mkdir ( '90-PACKAGE/' );
		// ON OUVRE
		$dlHandler = fopen('90-PACKAGE/version-'.$new_version.'.zip', 'w');
		// ON VERIFIE QUE L'ECRITURE DU FICHIER SE FAIT SANS PROBLEME
		if ( !fwrite($dlHandler, $newUpdate) ) { echo '<section class="panel"><header class="panel-heading">Impossible de télécharger la mise à jour, opération annulée.</header></section>'; exit(); }
		fclose($dlHandler);
		// TOUT S'EST BIEN PASSE, C'EST BON !
		echo '<section class="panel"><header class="panel-heading">Mise à jour téléchargée et sauvegardée !</header></section>';
		}
		//ON GERE ICI UNE ERREUR SI LE FICHIER DISTANT EST INACESSIBLE
		else{echo '<section class="panel"><header class="panel-heading">Le fichier de mise à jour http://services.piwowarczyk.fr/cms_update/version-'.$new_version.'.zip n\'est pas accessible.</header></section>'; $MAJ_ERREUR++;}
		}
// SINON C'EST QUE LE FICHIER DE MAJ A DEJA ETAIT TELECHARGE
else {echo '<section class="panel"><header class="panel-heading">Mise à jour déjà téléchargée</header></section>';}

// ICI ON AFFICHE LE BOUTON PERMETTANT D'INSTALLER LA MAJ SI AUCUNE ERREUR N'EST DETECTEE
if($MAJ_ERREUR=='0'){
	$_SESSION['MAJ']=$new_version;
?>

<section class="panel">
                          <header class="panel-heading">
                              Processus de mise à jour...
                          </header>
                          <div class="panel-body">
                              <a href="admin.php?config=Mise_A_Jour&do=Installation<?php echo $EXPERT;?>"><button type="button" class="btn btn-success btn-lg btn-block">Cliquer ici pour continuer la mise à jour.</button></a>
                              
                          </div>
                      </section>
<?php } ?>					  