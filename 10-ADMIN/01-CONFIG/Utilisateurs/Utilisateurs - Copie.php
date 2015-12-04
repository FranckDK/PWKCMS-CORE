<?php
// GESTION DES AFFICHAGES TOASTR
$INFO=$_GET['INFO'];
if ($INFO=='MDPVIDE'){
echo('<script type="text/javascript">
$(document).ready(function() {
    toastr.options.timeOut = 2500; // 2.5s
    toastr.info(\'Le compte a été mis à jour, le mot de passe est inchangé.\');
  });
  </script>');
}
elseif ($INFO=='MDPDIF'){
echo('<script type="text/javascript">
$(document).ready(function() {
    toastr.options.timeOut = 2500; // 2.5s
    toastr.error(\'Les mots de passe ne correspondaient pas.\');
  });
  </script>');
}
elseif ($INFO=='MAJ'){
echo('<script type="text/javascript">
$(document).ready(function() {
    toastr.options.timeOut = 2500; // 2.5s
    toastr.info(\'Le compte a été mis à jour.\');
  });
  </script>');
}
?>


					  <!--navigation start-->
                      <nav class="navbar navbar-inverse" role="navigation">
                          <!-- Brand and toggle get grouped for better mobile display -->
                          <div class="navbar-header">
                              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                                  <span class="sr-only">Toggle navigation</span>
                                  <span class="fa fa-bars"></span>
                              </button>
                              <a class="navbar-brand" href="#">Gestion des utilisateurs</a>
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
                          <div class="symbol terques">
                              <i class="fa fa-user"></i>
                          </div>
                          <div class="value">
                              <h1 class="count">
<?php
//COMPTAGE SALARIES
$nb_util= $bdd->prepare("select count(*) FROM `cms_users`");$nb_util->execute();$nb_util = $nb_util->fetch(PDO::FETCH_NUM);
$nb_util=$nb_util[0];echo $nb_util;
?>
                              </h1>
                              <p>Utilisateur(s)</p>
                          </div>
                      </section>
                  </div>
				                    <div class="col-lg-6 col-sm-6">
                      <section class="panel">
                          <div class="symbol yellow">
                              <i class="fa fa-users"></i>
                          </div>
                          <div class="value">
                              <h1 class=" count3">
<?php
//COMPTAGE GROUPE
$nb_gpe= $bdd->prepare("select count(*) FROM `cms_groupes`");
$nb_gpe->execute();
$nb_gpe = $nb_gpe->fetch(PDO::FETCH_NUM);$nb_gpe=$nb_gpe[0];
echo $nb_gpe;?>
                              </h1>
                              <p>Groupe(s)<br><small>y compris Administrateurs et Visiteurs</small></p>
                          </div>
                      </section>
                  </div>
                  

                  
              </div>
              <!--state overview end-->
<div class="row">
                  <div class="col-lg-4">
                      <section class="panel">
                          <header class="panel-heading">
                              Liste des groupes						
							<span class="tools pull-right">
                                <a class="fa fa-chevron-down" href="javascript:;"></a>
								<a class="fa fa-times" href="javascript:;"></a>
                            </span>							  
                          </header>
						 
                          <div class="panel-body">
						  
						  <div class="btn-group pull-right">
                                  <a href="#myModal3" data-toggle="modal" class="myModal3btn btn btn-xs btn-primary"><i class="fa fa-plus"></i> Ajouter un groupe</a>
                              </div>
							  <div class="clearfix"></div><br/>
						
						  
<div class="adv-table">
                                    <table  class="display table table-bordered table-striped" id="example">
                                      <thead>
                                      <tr>
                                          <th>Nom du groupe</th>
										  <th>Actions</th>
                                      </tr>
                                      </thead>
                                      <tbody>
<?php
$req02= $bdd->prepare("select * from cms_groupes WHERE id <>'1' AND id <>'2'");
$req02->execute();
while ($res02 = $req02->fetch(PDO::FETCH_ASSOC))	
{
?>
                                <tr>
                                    <td width="70%"><?php echo $res02['desc'];?></td>
                                    <td>
						<div class="btn-group btn-group-justified">
							<a href="#myModal1" data-toggle="modal" class="myModal1btn btn btn-xs btn-warning" title="Editer" groupedesc="<?php echo $res02['desc'];?>" groupeid="<?php echo $res02['id'];?>"><i class="fa fa-edit"></i></a>
							<a href="#myModal2" data-toggle="modal" class="myModal2btn btn btn-xs btn-danger" groupedesc="<?php echo $res02['desc'];?>" groupeid="<?php echo $res02['id'];?>" cible="action.php?type=CONFIG&mod=Utilisateurs&fonc=supprimer_groupe&id=<?php echo $res02['id'];?>&id_user=<?php echo $_SESSION['cms_user_id']; ?>&nom=<?php echo $res02['desc']; ?>"><i class="fa fa-trash-o"></i></a>
						</div>
									</td>
                                </tr>
<?php } ?>                                                                

                                      
                                      

                                      </tfoot>
                          </table>
                                
</div>
                      </section>
                  </div>

                  <div class="col-lg-8">
                      <section class="panel">
                          <header class="panel-heading">
                              Liste des utilisateurs
							  <span class="tools pull-right">
                                <a class="fa fa-chevron-down" href="javascript:;"></a>
								<a class="fa fa-times" href="javascript:;"></a>
                            </span>
                          </header>
                          <div class="panel-body">
						  <div class="btn-group pull-right">
                                  <a href="#myModal7" data-toggle="modal" class="myModal3btn btn btn-xs btn-primary"><i class="fa fa-plus"></i> Ajouter un utilisateur</a>
                              </div>
							  <div class="clearfix"></div><br/>
<div class="adv-table">
                                    <table  class="display table table-bordered table-striped" id="example">
                                      <thead>
                                      <tr>
                                          <th>Identifiant</th>
                                          <th>Login</th>
                                          <th class="hidden-phone">Nom</th>
                                          <th class="hidden-phone">Prénom</th>
                                          <th>Groupe(s)</th>
										  <th>Actions</th>
                                      </tr>
                                      </thead>
                                      <tbody>
									  <?php
									  $req03= $bdd->prepare("select * from cms_users ORDER BY id DESC");
									  $req03->execute();
									  while ($donnees = $req03->fetch(PDO::FETCH_ASSOC))
							
{
?>
                                <tr>
                                    
                                    <td><?php echo str_pad($donnees['id'],6,"0",STR_PAD_LEFT);?></td>
									<td><?php echo $donnees['cms_users_login'];?></td>
                                    <td><?php echo $donnees['nom'];?></td>
                                    <td><?php echo $donnees['prenom'];?></td>
                                    <td>                       
                            
                            
                            <div class="span10">
                          
                                
								<?php
								$user_id1 = $donnees['id'];
								$groupe='';
								$usergroupe='';$req04= $bdd->prepare("select * from cms_groupes_membres LEFT JOIN cms_groupes ON cms_groupes_membres.group_id=cms_groupes.id WHERE user_id=$user_id1");$req04->execute();while ($donnees2 = $req04->fetch(PDO::FETCH_ASSOC))	
								
{
if ($groupe==''){$groupe=$groupe.$donnees2['desc'];}else{$groupe=$groupe.'<br/>'.$donnees2['desc'];}
if ($usergroupe==''){$usergroupe=(''.$donnees2['id'].'');}else{$usergroupe=(''.$usergroupe.','.$donnees2['id'].'');}

}                       ?>                                               
                               <?php echo $groupe;?>
                            
                        </td>
                                    <td width="25%">
									<div class="btn-group btn-group-justified">
							<a href="#myModal4" data-toggle="modal" class=" myModal4btn btn btn-xs btn-success" userid="<?php echo $donnees['id'];?>" usergroupe="<?php echo (''.$usergroupe.''); ?>"><i class="fa fa-cog"></i></a>		
							<a href="#myModal5" data-toggle="modal" class=" myModal5btn btn btn-xs btn-warning" userlogin="<?php echo $donnees['cms_users_login'];?>" userid="<?php echo $donnees['id'];?> " userprenom="<?php echo $donnees['prenom'];?>" usernom="<?php echo $donnees['nom'];?>" usermail="<?php echo $donnees['email'];?>"><i class="fa fa-edit"></i></a>
							<a href="#myModal6" data-toggle="modal" class="myModal6btn btn btn-xs btn-danger" nom="<?php echo $donnees['nom'];?>" prenom="<?php echo $donnees['prenom'];?>" uid="<?php echo $donnees['id'];?>"><i class="fa fa-trash-o"></i></a>
						</div>								                                     
                                    </td>
                                </tr>
<?php } ?>                                 

                                      
                                      

                                      </tfoot>
                          </table>
                                </div>
</div></section></div></div>

</div>
  <!--script for this page-->
  <script src="01-TEMPLATE/FLAT-ADMIN/js/form-component.js"></script>
<!--EDITION DU GROUPE-->
                              <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" name="myModal1" id="myModal1" class="modal fade">
                                  <div class="modal-dialog">
                                      <div class="modal-content">
                                          <div class="modal-header">
                                              <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                              <h4 class="modal-title">Edition du groupe</h4>
                                          </div>
                                          <div class="modal-body">

                                              <form role="form" action="action.php?type=CONFIG&mod=Utilisateurs&fonc=editer_groupe" method="post" class="cmxform form-horizontal tasi-form" id="commentForm" >
                                                  <div class="form-group">												 
												  <label for="editer_nom_groupe" class="control-label col-lg-4">Nom du groupe (requis)</label>
                                          <div class="col-lg-8">
                                              <input class="form-control" id="editer-groupe" name="editer-groupe" minlength="2" type="text" required />
                                          </div>                                    
													  <input type="hidden" class="form-control" name="editer-groupeid" id="editer-groupeid" value="" />
                                                  </div>
                                                  <button type="submit" class="btn btn-default">Modifier</button>
                                              </form>
											  
                                          </div>
                                      </div>
                                  </div>
                              </div>							  
<script type="text/javascript">
var elements = document.getElementsByClassName('myModal1btn');
for (var i = 0; i < elements.length; i++) {
    elements[i].addEventListener('click', function() {
        var groupedesc = $(this).attr("groupedesc");
		var groupeid = $(this).attr("groupeid");
		document.getElementById("editer-groupe").value = groupedesc;
		document.getElementById("editer-groupeid").value = groupeid;
    }, false);
}
</script>
<!--FIN EDITION DU GROUPE-->

<!--SUPPRESSION DU GROUPE-->
<script type="text/javascript">
var elements2 = document.getElementsByClassName('myModal2btn');
for (var i = 0; i < elements2.length; i++) {
elements2[i].addEventListener('click', function() {
var groupedesc = $(this).attr("groupedesc");
var groupeid = $(this).attr("groupeid");
document.getElementById("supprimer-groupeid").value = groupeid;
$('#sup-groupe span').text('Souhaitez-vous vraiment supprimer le groupe ' + groupedesc + ' ?');
}, false);
}
</script>

                              <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal2" class="modal fade">
                                  <div class="modal-dialog">
                                      <div class="modal-content">
                                          <div class="modal-header">
                                              <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                              <h4 class="modal-title">Suppression du groupe</h4>
                                          </div>
                                          <div class="modal-body">

                                              <form role="form" action="action.php?type=CONFIG&mod=Utilisateurs&fonc=supprimer_groupe" method="post" class="cmxform form-horizontal tasi-form">
                                                  <div class="form-group" id="sup-groupe">
                                                      <span>Souhaitez-vous vraiment supprimer le groupe ?</span>
                                                  </div>
												  <input type="hidden" class="form-control" name="supprimer-groupeid" id="supprimer-groupeid" value="" />
                                                  <button type="submit" class="btn btn-danger"><i class="fa fa-trash-o"></i> Confirmer</button>
                                              </form>
                                          </div>
                                      </div>
                                  </div>
                              </div>

<!--FIN SUPPRESSION DU GROUPE-->

<!--AJOUT DU GROUPE-->
                              <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" name="myModal3" id="myModal3" class="modal fade">
                                  <div class="modal-dialog">
                                      <div class="modal-content">
                                          <div class="modal-header">
                                              <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                              <h4 class="modal-title">Ajout d'un groupe</h4>
                                          </div>
                                          <div class="modal-body">
										  

                                              <form role="form" action="action.php?type=CONFIG&mod=Utilisateurs&fonc=ajouter_groupe" method="post" class="cmxform form-horizontal tasi-form" id="commentForm2">
                                                  <div class="form-group">												 
												  <label for="editer_nom_groupe" class="control-label col-lg-4">Nom du groupe (requis)</label>
                                          <div class="col-lg-8">
                                              <input class="form-control" id="ajouter-groupe" name="ajouter-groupe" minlength="2" type="text" required />
                                          </div>                                    
											
                                                  </div>
                                                  <button type="submit" class="btn btn-default">Ajouter</button>
                                              </form>
                                          </div>
                                      </div>
                                  </div>
                              </div>							  
<!--FIN AJOUT DU GROUPE-->

<!--AJOUT UTILISATEUR-->
                              <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" name="myModal7" id="myModal7" class="modal fade">
                                  <div class="modal-dialog">
                                      <div class="modal-content">
                                          <div class="modal-header">
                                              <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                              <h4 class="modal-title">Ajout d'un utilisateur</h4>
                                          </div>
                                          <div class="modal-body">

                                              <form role="form" action="action.php?type=CONFIG&mod=Utilisateurs&fonc=ajouter_utilisateur" method="post" class="cmxform form-horizontal tasi-form" id="signupForm">
                                                  <div class="form-group">												 
												  <label for="login" class="control-label col-lg-4">Login (requis)</label>
                                          <div class="col-lg-8">
                                              <input class="form-control" id="login" name="login" minlength="2" type="text" required />
                                          </div>                                    
											
                                                  </div>
												  <div class="form-group">												 
												  <label for="nom" class="control-label col-lg-4">Nom (requis)</label>
                                          <div class="col-lg-8">
                                              <input class="form-control" id="nom" name="nom" minlength="2" type="text" required />
                                          </div>                                    
											
                                                  </div>
												  <div class="form-group">												 
												  <label for="prenom" class="control-label col-lg-4">Prénom (requis)</label>
                                          <div class="col-lg-8">
                                              <input class="form-control" id="prenom" name="prenom" minlength="2" type="text" required />
                                          </div>                                    
											
                                                  </div>
												  <div class="form-group ">
                                          <label for="cemail" class="control-label col-lg-4">E-Mail (requis)</label>
                                          <div class="col-lg-8">
                                              <input class="form-control " id="email" type="email" name="email" required />
                                          </div>
                                      </div>
												  <div class="form-group">												 
												  <label for="password" class="control-label col-lg-4">Mot de passe (requis)</label>
                                          <div class="col-lg-8">
                                              <input class="form-control " id="password" name="password" type="password" />
                                          </div>                      
											
                                                  </div>
												  <div class="form-group">												 
												  <label for="password2" class="control-label col-lg-4">Confirmer mot de passe (requis)</label>
                                          <div class="col-lg-8">
                                              <input class="form-control" id="confirm_password" name="confirm_password" minlength="2" type="password" required />
                                          </div>                                    
											
                                                  </div>
                                                  <button type="submit" class="btn btn-default">Ajouter</button>
                                              </form>
											  
                                          </div>
                                      </div>
                                  </div>
                              </div>							  
<!--FIN AJOUT UTILISATEUR-->

<!--SUPPRESSION UTILISATEUR-->
<script type="text/javascript">
var elements6 = document.getElementsByClassName('myModal6btn');
for (var i = 0; i < elements6.length; i++) {
elements6[i].addEventListener('click', function() {
var nom = $(this).attr("nom");
var prenom = $(this).attr("prenom");
var uid = $(this).attr("uid");
document.getElementById("supprimer-userid").value = uid;
$('#sup-uid span').text('Souhaitez-vous vraiment supprimer le compte : ' + prenom + ' ' + nom +' ?');
}, false);
}
</script>

                              <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal6" class="modal fade">
                                  <div class="modal-dialog">
                                      <div class="modal-content">
                                          <div class="modal-header">
                                              <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                              <h4 class="modal-title">Suppression d'un compte utilisateur</h4>
                                          </div>
                                          <div class="modal-body">

                                              <form role="form" action="action.php?type=CONFIG&mod=Utilisateurs&fonc=supprimer_utilisateur" method="post" class="cmxform form-horizontal tasi-form">
                                                  <div class="form-group" id="sup-uid">
                                                      <span>Souhaitez-vous vraiment supprimer le compte utilisateur suivant ?</span>
                                                  </div>
												  <input type="hidden" class="form-control" name="supprimer-userid" id="supprimer-userid" value="" />
                                                  <button type="submit" class="btn btn-danger"><i class="fa fa-trash-o"></i> Confirmer</button>
                                              </form>
                                          </div>
                                      </div>
                                  </div>
                              </div>

<!--FIN SUPPRESSION UTILISATEUR-->

<!--EDITION UTILISATEUR-->
<script type="text/javascript">
var elements5 = document.getElementsByClassName('myModal5btn');
for (var i = 0; i < elements5.length; i++) {
elements5[i].addEventListener('click', function() {
		var userlogin = $(this).attr("userlogin");
		var userprenom = $(this).attr("userprenom");
		var usernom = $(this).attr("usernom");
		var usermail = $(this).attr("usermail");
		var userid = $(this).attr("userid");
		document.getElementById("editer-login").value = userlogin;
		//document.getElementById("editer-login2").value = userid;
		document.getElementById("editer-prenom").value = userprenom;
		document.getElementById("editer-nom").value = usernom;
		document.getElementById("editer-email").value = usermail;
		document.getElementById("editer-userid").value = userid;

}, false);
}
</script>

                              <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" name="myModal5" id="myModal5" class="modal fade">
                                  <div class="modal-dialog">
                                      <div class="modal-content">
                                          <div class="modal-header">
                                              <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                              <h4 class="modal-title">Edition d'un utilisateur</h4>
                                          </div>
                                          <div class="modal-body">
                                              <form role="form" action="action.php?type=CONFIG&mod=Utilisateurs&fonc=editer_utilisateur" method="post" class="cmxform form-horizontal tasi-form" id="editerutilisateur">
                                                  <div class="form-group">												 
												  <label for="login" class="control-label col-lg-4">Login (requis)</label>
                                          <div class="col-lg-8">
                                              <input class="form-control" id="editer-login" name="editer-login"  type="text" required minlength="2"  />
											  <input type="hidden" class="form-control" name="editer-userid" id="editer-userid" value="" />
                                          </div>                                    
											
                                                  </div>
												  <div class="form-group">												 
												  <label for="nom" class="control-label col-lg-4">Nom (requis)</label>
                                          <div class="col-lg-8">
                                              <input class="form-control" id="editer-nom" name="editer-nom" minlength="2" type="text" required />
                                          </div>                                    
											
                                                  </div>
												  <div class="form-group">												 
												  <label for="prenom" class="control-label col-lg-4">Prénom (requis)</label>
                                          <div class="col-lg-8">
                                              <input class="form-control" id="editer-prenom" name="editer-prenom" minlength="2" type="text" required />
                                          </div>                                    
											
                                                  </div>
												  <div class="form-group ">
                                          <label for="cemail" class="control-label col-lg-4">E-Mail (requis)</label>
                                          <div class="col-lg-8">
                                              <input class="form-control " id="editer-email" type="email" name="editer-email" required />
                                          </div>
                                      </div>
												  <div class="form-group">												 
												  <label for="password" class="control-label col-lg-4">Mot de passe (Laisser vide pour ne pas en changer)</label>
                                          <div class="col-lg-8">
                                              <input class="form-control " id="password" name="password" type="password" />
                                          </div>                      
											
                                                  </div>
												  <div class="form-group">												 
												  <label for="password2" class="control-label col-lg-4">Confirmer mot de passe (requis)</label>
                                          <div class="col-lg-8">
                                              <input class="form-control" id="confirm_password" name="confirm_password" minlength="2" type="password" />
                                          </div>                                    
											
                                                  </div>
                                                  <button type="submit" class="btn btn-default">Modifier le compte utilisateur</button>
                                              </form>
											  
                                          </div>
                                      </div>
                                  </div>
                              </div>

<!--FIN EDITION UTILISATEUR-->

<!--GROUPE UTILISATEUR-->
<script type="text/javascript">
var elements4 = document.getElementsByClassName('myModal4btn');
for (var i = 0; i < elements4.length; i++) {
elements4[i].addEventListener('click', function() {

		var userid = $(this).attr("userid");
		document.getElementById("groupes-userid").value = userid;
	$('#my_multi_select1').multiSelect('deselect_all');

		var usergroupe = $(this).attr("usergroupe");
		var myArray = usergroupe.split(',');
		for(var i=0;i<myArray.length;i++){
		$('#my_multi_select1').multiSelect('select', myArray[i]);
    }
}, false);
}
</script>

                              <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal4" class="modal fade">
                                  <div class="modal-dialog">
                                      <div class="modal-content">
                                          <div class="modal-header">
                                              <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                              <h4 class="modal-title">Définition des droits d'accès au module</h4>
                                          </div>
                                          <div class="modal-body">

                                              <form role="form" action="action.php?type=CONFIG&mod=Utilisateurs&fonc=affecter_groupes" method="post" class="form-horizontal tasi-form">
                                    
                      
                              <div class="form-group">
                                  <label class="control-label col-md-3">Groupe(s) :</label>
                                  <div class="col-md-9">
                                      <select multiple="multiple" class="multi-select" id="my_multi_select1" name="my_multi_select1[]">
                                          <?php
										  $req01= $bdd->prepare("select * from cms_groupes WHERE id <>'1' ORDER BY id ASC");
										  $req01->execute();while ($donnees2 = $req01->fetch(PDO::FETCH_ASSOC))	
								
								{
															
								echo('<option value="'.$donnees2['id'].'">'.$donnees2['desc'].'</option>');
								}
								?>
                                      </select>
                                  </div>
                              </div>
												  <input type="hidden" class="form-control" name="groupes-userid" id="groupes-userid" value="" />
                                                  <button type="submit" class="btn btn-danger"><i class="fa fa-cog"></i> Confirmer</button>
                                              </form>
                                          </div>
                                      </div>
                                  </div>
                              </div>

<!--FIN GROUPE UTILISATEUR-->

	