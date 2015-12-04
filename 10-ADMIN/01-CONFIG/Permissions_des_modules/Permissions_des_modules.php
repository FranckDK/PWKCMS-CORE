                      <!--navigation start-->
                      <nav class="navbar navbar-inverse" role="navigation">
                          <!-- Brand and toggle get grouped for better mobile display -->
                          <div class="navbar-header">
                              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                                  <span class="sr-only">Toggle navigation</span>
                                  <span class="fa fa-bars"></span>
                              </button>
                              <a class="navbar-brand" href="#">Permissions des modules</a>
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
                  <div class="col-lg-6">
                      <section class="panel">
                          <header class="panel-heading">
                              Accès à la configuration						
							<span class="tools pull-right">
                                <a class="fa fa-chevron-down" href="javascript:;"></a>
								<a class="fa fa-times" href="javascript:;"></a>
                            </span>							  
                          </header>
						 
                          <div class="panel-body">
								  <div class="clearfix"></div><br/>
						
						  
<div class="adv-table">
                                    <table  class="display table table-bordered table-striped" id="example">
                                      <thead>
                                      <tr>
                                          <th>Nom du module</th>
										  <th>Autorisation(s)</th>
										  <th>Action</th>
                                      </tr>
                                      </thead>
                                      <tbody>
<?php
$folder = "10-ADMIN/01-CONFIG/";

					$dossier = opendir($folder);
					while ($Fichier = readdir($dossier)) 
					{
					$array_modules_admin[]=$Fichier;
					$NomFichier=str_replace("_"," ",$Fichier);
						if ($Fichier!="." & $Fichier!=".." & $Fichier!="index.html")
							{
							echo('<tr><td>'.$NomFichier.'</td>');
							echo('<td>');
							$groupe_admin='';
							//LISTE DES AUTORISES
							$req01= $bdd->prepare("SELECT * FROM cms_modules_admin INNER JOIN cms_groupes on cms_groupes.id=cms_modules_admin.autorisation WHERE nom='$Fichier'");
							$req01->execute();
							while ($donnees = $req01->fetch(PDO::FETCH_ASSOC))
							{
							echo $donnees['desc'];
							echo('<br/>');
							if ($groupe_admin==''){$groupe_admin=(''.$donnees['autorisation'].'');}else{$groupe_admin=(''.$groupe_admin.','.$donnees['autorisation'].'');}
							}
							echo('</td>');
							echo('<td><a href="#myModal1" data-toggle="modal" class="myModal1btn btn btn-xs btn-warning" modulenom="'.$Fichier.'" groupeadmin="'.$groupe_admin.'"><i class="fa fa-edit"></i> Définir les droits</a></td>');
							echo('</tr>');
							}
							}
?>                                                               
  </tbody>
                          </table>                           
</div><!--CLOTURE <div- class="adv-table">-->
</div><!--CLOTURE <div- class="panel-body">-->
</section><!-- CLOTURE <section- class="panel">-->
</div><!--CLOTURE <div- class="col-lg-6">-->

                  <div class="col-lg-6">
                      <section class="panel">
                          <header class="panel-heading">
                              Accès à l'administration						
							<span class="tools pull-right">
                                <a class="fa fa-chevron-down" href="javascript:;"></a>
								<a class="fa fa-times" href="javascript:;"></a>
                            </span>							  
                          </header>
						  
						  <div class="panel-body">
								  <div class="clearfix"></div><br/>
						
						  
<div class="adv-table">
                                    <table  class="display table table-bordered table-striped" id="example">
                                      <thead>
                                      <tr>
                                          <th>Nom du module</th>
										  <th>Autorisation(s)</th>
										  <th>Action</th>
                                      </tr>
                                      </thead>
                                      <tbody>
<?php
$folder = "10-ADMIN/02-APPLIS/";

					$dossier = opendir($folder);
					while ($Fichier = readdir($dossier)) 
					{
					$array_modules_admin[]=$Fichier;
					$NomFichier=str_replace("_"," ",$Fichier);
						if ($Fichier!="." & $Fichier!=".." & $Fichier!="index.html")
							{
							echo('<tr><td>'.$NomFichier.'</td>');
							echo('<td>');
							$groupe_admin='';
							//LISTE DES AUTORISES
							$req02= $bdd->prepare("SELECT * FROM cms_modules_admin INNER JOIN cms_groupes on cms_groupes.id=cms_modules_admin.autorisation WHERE nom='$Fichier'");$req02->execute();while ($donnees = $req02->fetch(PDO::FETCH_ASSOC))	
							
							{
							echo $donnees['desc'];
							echo('<br/>');
							if ($groupe_admin==''){$groupe_admin=(''.$donnees['autorisation'].'');}else{$groupe_admin=(''.$groupe_admin.','.$donnees['autorisation'].'');}
							}
							echo('</td>');
							echo('<td><a href="#myModal1" data-toggle="modal" class="myModal1btn btn btn-xs btn-warning" modulenom="'.$Fichier.'" groupeadmin="'.$groupe_admin.'"><i class="fa fa-edit"></i> Définir les droits</a></td>');
							echo('</tr>');
							}
							}
?>                                                               

                                      
                                      

                                      </tbody>
                          </table>                           
</div><!--CLOTURE <div- class="adv-table">-->
</div><!--CLOTURE <div- class="panel-body">-->
</section><!-- CLOTURE <section- class="panel">-->
</div><!--CLOTURE <div- class="col-lg-6">-->
</div><!--CLOTURE <div- class="row">-->

<div class="row">
                  <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                              Accès aux modules (FrontEnd)						
							<span class="tools pull-right">
                                <a class="fa fa-chevron-down" href="javascript:;"></a>
								<a class="fa fa-times" href="javascript:;"></a>
                            </span>							  
                          </header>
						 
                          <div class="panel-body">
								  <div class="clearfix"></div><br/>
						
						  
<div class="adv-table">
                                    <table  class="display table table-bordered table-striped" id="example">
                                      <thead>
                                      <tr>
                                          <th>Nom du module</th>
										  <th>Autorisation(s)</th>
										  <th>Action</th>
                                      </tr>
                                      </thead>
                                      <tbody>
<?php
$folder = "04-MODULES/";

					$dossier = opendir($folder);
					while ($Fichier = readdir($dossier)) 
					{
					$array_modules_admin[]=$Fichier;
					$NomFichier=str_replace("_"," ",$Fichier);
						if ($Fichier!="." & $Fichier!=".." & $Fichier!="index.html")
							{
							echo('<tr><td>'.$NomFichier.'</td>');
							echo('<td>');
							$groupe_admin='';
							//LISTE DES AUTORISES
							$req03= $bdd->prepare("SELECT * FROM cms_modules_permissions INNER JOIN cms_groupes on cms_groupes.id=cms_modules_permissions.autorisation WHERE nom='$Fichier'");$req03->execute();while ($donnees = $req03->fetch(PDO::FETCH_ASSOC))	
							
							{
							echo $donnees['desc'];
							echo('<br/>');
							if ($groupe_admin==''){$groupe_admin=(''.$donnees['autorisation'].'');}else{$groupe_admin=(''.$groupe_admin.','.$donnees['autorisation'].'');}
							}
							echo('</td>');
							echo('<td><a href="#myModal2" data-toggle="modal" class="myModal2btn btn btn-xs btn-warning" modulenom="'.$Fichier.'" groupeadmin="'.$groupe_admin.'"><i class="fa fa-edit"></i> Définir les droits</a></td>');
							echo('</tr>');
							}
							}
?>                                                               

                                      
                                      

                                      </tbody>
                          </table>                           
</div><!--CLOTURE <div- class="adv-table">-->
</div><!--CLOTURE <div- class="panel-body">-->
</section><!-- CLOTURE <section- class="panel">-->
</div><!--CLOTURE <div- class="col-lg-12">-->
</div><!--CLOTURE <div- class="row">-->

<!--GROUPE UTILISATEUR-->
<script type="text/javascript">
var elements = document.getElementsByClassName('myModal1btn');
for (var i = 0; i < elements.length; i++) {
elements[i].addEventListener('click', function() {
var modulenom = $(this).attr("modulenom");
document.getElementById("modulenom").value = modulenom;
$('#my_multi_select1').multiSelect('deselect_all');
		var usergroupe = $(this).attr("groupeadmin");
		var myArray = usergroupe.split(',');
		for(var i=0;i<myArray.length;i++){
		$('#my_multi_select1').multiSelect('select', myArray[i]);
    }
}, false);
}
</script>

                              <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal1" class="modal fade">
                                  <div class="modal-dialog">
                                      <div class="modal-content">
                                          <div class="modal-header">
                                              <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                              <h4 class="modal-title">Définition des droits d'accès au module</h4>
                                          </div>
                                          <div class="modal-body">

                                              <form role="form" action="action.php?type=CONFIG&mod=Permissions_des_modules&fonc=definir_droits" method="post" class="form-horizontal tasi-form">
                                    
                      
                              <div class="form-group">
                                  <label class="control-label col-md-3">Groupe(s) :</label>
                                  <div class="col-md-9">
                                      <select multiple="multiple" class="multi-select" id="my_multi_select1" name="my_multi_select1[]">
<?php
$req04= $bdd->prepare("select * from cms_groupes WHERE id <>'1' ORDER BY id ASC");
$req04->execute();
while ($donnees04 = $req04->fetch(PDO::FETCH_ASSOC))	
{	
echo('<option value="'.$donnees04['id'].'">'.$donnees04['desc'].'</option>');
}
?>
                                      </select>
                                  </div>
                              </div>
												  <input type="hidden" class="form-control" name="modulenom" id="modulenom" value="" />
                                                  <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Enregistrer</button>
                                              </form>
                                          </div>
                                      </div>
                                  </div>
                              </div>

<!--FIN GROUPE UTILISATEUR-->


<!--FRONTEND-->
<script type="text/javascript">
var elements = document.getElementsByClassName('myModal2btn');
for (var i = 0; i < elements.length; i++) {
elements[i].addEventListener('click', function() {
var modulenom = $(this).attr("modulenom");
document.getElementById("modulenom2").value = modulenom;
$('#my_multi_select2').multiSelect('deselect_all');
		var usergroupe = $(this).attr("groupeadmin");
		var myArray = usergroupe.split(',');
		for(var i=0;i<myArray.length;i++){
		$('#my_multi_select2').multiSelect('select', myArray[i]);
    }
}, false);
}
</script>

                              <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal2" class="modal fade">
                                  <div class="modal-dialog">
                                      <div class="modal-content">
                                          <div class="modal-header">
                                              <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                              <h4 class="modal-title">Définition des droits d'accès au module</h4>
                                          </div>
                                          <div class="modal-body">

                                              <form role="form" action="action.php?type=CONFIG&mod=Permissions_des_modules&fonc=definir_droits_frontend" method="post" class="form-horizontal tasi-form">
                                    
                      
                              <div class="form-group">
                                  <label class="control-label col-md-3">Groupe(s) :</label>
                                  <div class="col-md-9">
                                      <select multiple="multiple" class="multi-select" id="my_multi_select2" name="my_multi_select2[]">
                                          <?php
										  $req01= $bdd->prepare("select * from cms_groupes  ORDER BY id ASC");
										  $req01->execute();while ($donnees2 = $req01->fetch(PDO::FETCH_ASSOC))
								
								{
															
								echo('<option value="'.$donnees2['id'].'">'.$donnees2['desc'].'</option>');
								}
								?>
                                      </select>
                                  </div>
                              </div>
												  <input type="hidden" class="form-control" name="modulenom2" id="modulenom2" value="" />
                                                  <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Enregistrer</button>
                                              </form>
                                          </div>
                                      </div>
                                  </div>
                              </div>

<!--FIN FRONTEND-->
