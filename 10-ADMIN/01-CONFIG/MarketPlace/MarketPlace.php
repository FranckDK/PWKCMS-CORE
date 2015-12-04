              <!--navigation start-->
                      <nav class="navbar navbar-inverse" role="navigation">
                          <!-- Brand and toggle get grouped for better mobile display -->
                          <div class="navbar-header">
                              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                                  <span class="sr-only">Toggle navigation</span>
                                  <span class="fa fa-bars"></span>
                              </button>
							  <a class="navbar-brand" href="admin.php"><i class="fa fa-dashboard"></i></a>
                              <a class="navbar-brand" href="#">MarketPlace</a>
                          </div>

                          <!-- Collect the nav links, forms, and other content for toggling -->
                          <div class="collapse navbar-collapse navbar-ex1-collapse">
                              <ul class="nav navbar-nav">
                                  <li class="active"><a href="#">Vue d'ensemble</a></li>
                              </ul>
                          </div><!-- /.navbar-collapse -->
                      </nav>
                      <!--navigation end-->
					  
<div class="row">
                  <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                              Liste des dépôts installés.
                          </header>
                          <div class="panel-body">
                                <div class="adv-table editable-table " >
                                    <table  class="display table table-bordered table-striped" id="editable-sample">
                                      <thead>
                                      <tr>
                                          <th>Id</th>
                                          <th>Description</th>                                         
										  <th>Url</th>
                                          <th>Actif</th>
                                          <th>Action(s)</th>
                                      </tr>
                                      </thead>
                                      <tbody>
	<?php
	//RECUPERATION DES PREFERENCES
	$req01= $bdd->prepare("SELECT * FROM cms_marketplace");
	$req01->execute();
	while ($donnees01 = $req01->fetch(PDO::FETCH_ASSOC))
	{
	echo ('<tr class=\"gradeX\"><td>'.$donnees01['marketplace_repo_id'].'</td><td>'.utf8_encode($donnees01['marketplace_repo_desc']).'</td><td>'.$donnees01['marketplace_repo_url'].'</td><td>'.$donnees01['marketplace_repo_actif'].'</td><td><a href="#myModal1" data-toggle="modal" class="myModal1btn btn btn-xs btn-warning" title="Editer" groupedesc="'.utf8_encode($donnees01['cms_pref_variable']).'" groupeval="'.$donnees01['cms_pref_valeur'].'" groupeid="'.$donnees01['cms_pref_id'].'"><i class="fa fa-edit"></i></a></td></tr>');
	}
	?>
  </tbody>
                                      <!--<tfoot>
                                       <tr>
                                          <th>Extension</th>
                                          <th>Description</th>
                                          <th>Version disponible</th>
                                          <th>Compatibilité version installée</th>
                                          <th class="hidden-phone">Action(s)</th>
                                      </tr>
                                      </tfoot>-->
                          </table>
                                </div>
                          </div>
                      </section>
                  </div>
				  
                  
	<?php
	
	$req01= $bdd->prepare("SELECT * FROM cms_marketplace");
	$req01->execute();
	while ($donnees01 = $req01->fetch(PDO::FETCH_ASSOC))
	{
		?>
		<div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                              Modules disponible sur le dépôt : <?php echo(''.utf8_encode($donnees01['marketplace_repo_desc']).'')?>
                          </header>
                          <div class="panel-body">
                                <div class="adv-table editable-table " >
                                    <table  class="display table table-bordered table-striped" id="editable-sample">
                                      <thead>
                                      <tr>
                                          <th>Extension</th>
                                          <th>Description</th>                                          
                                          <th>Information sur l'extension</th>
                                          <th class="hidden-phone">Action(s)</th>
                                      </tr>
                                      </thead>
                                      <tbody>
<?php
//Fonction qui teste l'existence d'un fichier distant : Valeur à 1 si fichier trouvé
function FichierDistantExiste($url) {
   if(!@fopen($url, 'r')) return false;
   else return true;
}
$REPO_URL=$donnees01['marketplace_repo_url'];
//On vérifie que le dépôt est en ligne
$REPO_URL_TEST = $REPO_URL.'/00-liste_extensions.txt';
if(FichierDistantExiste($REPO_URL_TEST)!='1'){echo('<tr><td colspan="4">Le dépôt ne semble pas accessible, veuillez vérifier l\'url ou réessayer plus tard.</td></tr>');}
else{
//Connexion au MarketPlace et récupération de la liste des modules disponibles.
$fichier1 = file($donnees01['marketplace_repo_url'].'/00-liste_extensions.txt'); // Nom du fichier à afficher, son adresse de localisation
if ($fichier1==''){echo('<tr><tdcolspan=\'4\'></td></tr>');}
$total1 = count($fichier1); // Nombre total des lignes du fichier
for($i = 0; $i < $total1; $i++) 
{ // Départ de la boucle
$info_maj='';
$EXT_LOC_VERSION='';
$EXT_ABS='';
$info_ext=explode('|',$fichier1[$i]);
?>
<tr class="gradeX">
<td><?php echo $info_ext['0']; ?></td>
<td><?php echo $info_ext['1']; ?></td>
<?php
//ON TESTE ICI SI L'EXTENSION EST INSTALLEE EN LOCAL
$ext_dir=('10-ADMIN/02-APPLIS/'.$info_ext['0'].'/');
if (is_dir($ext_dir))
{
//Vérification de la version installée en local
$fichier2 = file($ext_dir."version.txt"); // Nom du fichier à afficher, son adresse de localisation
$total2 = count($fichier2); // Nombre total des lignes du fichier
for($j = 0; $j < $total2; $j++) 
{ // Départ de la boucle
$EXT_LOC_VERSION=$fichier2[$j];
} // Fin de la boucle

if (version_compare($info_ext['2'], $EXT_LOC_VERSION) > 0) {$info_maj=('<span class="label label-warning">Dernière version : v.'.$info_ext['2'].'</span>');}
echo ('<td class="center"><span class="label label-primary">Extension installée v.'.$EXT_LOC_VERSION.'</span> '.$info_maj.'</td>');
}
else{echo ('<td class="center" "><span class="label label-info">Extension non installée</span></td>'); $EXT_ABS='1';}
?>

<td class="center hidden-phone" width="20%>
<div class="btn-group btn-group-justified">
<?php if($EXT_ABS!=''){echo ('<a class="btn btn-success" href="admin.php?config=MarketPlace&do=Installer&ext='.$info_ext['0'].'&repo='.$donnees01[marketplace_repo_id].'">Installer</a>');} ?>
<?php if($info_maj!=''){echo ('<a class="btn btn-info" href="admin.php?config=MarketPlace&do=Mise_A_Jour_1&ext='.$info_ext['0'].'">Mettre à jour</a>');} ?>
<?php //if($EXT_LOC_VERSION!=''){echo ('<a class="btn btn-danger" href="admin.php?config=MarketPlace&do=Desinstaller&ext='.$info_ext['0'].'">Désinstaller</a>');} ?>
</div>

</td>
</tr>
<?php	
} // fin de la boucle
} //fin du else qui vérifier si le dépot est en ligne ou pas
?>


	</tbody>
                                      
                          </table>
                                </div>
                          </div>
                      </section>
                  </div>
              </div>		
	<?php
	}
	?>
  			  