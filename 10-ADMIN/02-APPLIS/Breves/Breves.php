                      <!--navigation start-->
                      <nav class="navbar navbar-inverse" role="navigation">
                          <!-- Brand and toggle get grouped for better mobile display -->
                          <div class="navbar-header">
                              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                                  <span class="sr-only">Toggle navigation</span>
                                  <span class="fa fa-bars"></span>
                              </button>
                              <a class="navbar-brand" href="#">Gestion des brèves</a>
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
                  <div class="col-lg-3 col-sm-6">
                      <section class="panel">
                          <div class="symbol terques">
                              <i class="fa fa-bullhorn"></i>
                          </div>
                          <div class="value">
                              <h1 class="count">
<?php

//COMPTAGE BREVES
$nbbreves= $bdd->prepare("SELECT COUNT(*) FROM `cms_breves` WHERE date_debut>(curdate())");
$nbbreves->execute();
$nbbreves = $nbbreves->fetch(PDO::FETCH_NUM);
$nbbreves=$nbbreves[0];
echo $nbbreves;
?>
                              </h1>
                              <p>Brève(s) en attente</p>
                          </div>
                      </section>
                  </div>
</div>
<!------------------------------------------------->

<div class="row">
                  <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                              Liste des brèves						
							<span class="tools pull-right">
                                <a class="fa fa-chevron-down" href="javascript:;"></a>
								<a class="fa fa-times" href="javascript:;"></a>
                            </span>							  
                          </header>
						 
                          <div class="panel-body">
						  
						  <div class="btn-group pull-right">
                                  <a href="#myModal1" data-toggle="modal" class="myModal1btn btn-xs btn-primary"><i class="fa fa-plus"></i> Ajouter une brève</a>
                              </div>
							  <div class="clearfix"></div><br/>
			<div class="adv-table">
                                    <table  class="display table table-bordered table-striped" id="example">
            <thead>
				<tr>
					<th>Titre</th>
					<th>Rédacteur</th>
					<th>Statut</th>
					<th>Affichage</th>
					<th>Date rédaction</th>
					<th>Visible par</th>
					<th>Activation</th>
					<th>Désactivation</th>
					<th>Action</th>
				</tr>
			</thead>
                                      <tbody>	
<?php
$req01= $bdd->prepare("SELECT * FROM cms_breves ORDER BY id DESC");
$req01->setFetchMode(PDO::FETCH_ASSOC);
$req01->execute();
//$reponse = mysql_query("SELECT * FROM cms_breves ORDER BY id DESC");
foreach ($req01 as $donnees){ 
$id=$donnees['id'];
$actif1 = (stripslashes($donnees['actif']));
$accueil1 = (stripslashes($donnees['accueil']));
$auteur1 = (stripslashes($donnees['auteur']));
$titre1 = (stripslashes($donnees['titre']));
$texte1 = (stripslashes($donnees['texte']));
$date1 = DateUsenFr($donnees['date']);
$date_debut1 = DateUsenFr($donnees['date_debut']); 
$date_fin1 = DateUsenFr($donnees['date_fin']);
if($date_debut1!='00-00-0000'){$date_debut2 = date_format(date_create_from_format('d-m-Y', $date_debut1),'d/m/Y');}else{$date_debut2='00/00/0000';}
if($date_fin2!='00-00-0000'){$date_fin2 = date_format(date_create_from_format('d-m-Y', $date_fin1),'d/m/Y');}else{$date_fin2='00/00/0000';}

if ($actif1=='1'){$statut_actif='<b>Actif</b>';}else{$statut_actif='<i>Inactif</i>';}

if ($accueil1=='1'){$statut_accueil='Accueil &amp; Brèves';}else{$statut_accueil='Brèves uniquement';}

if ($date_debut1 != '00-00-0000'){$statut_datedebut ='Activée le '.$date_debut1.'';}else{$statut_datedebut='<br/>';}

if ($date_fin1 != '00-00-0000'){$statut_datefin ='Désactivée le '.$date_fin1.'';}else{$statut_datefin='';}
$visiblepar='';
$ngroupe='';
							$req01= $bdd->prepare("SELECT * FROM cms_breves_permissions INNER JOIN cms_groupes ON cms_breves_permissions.autorisation=cms_groupes.id WHERE cms_breves_permissions.breve_id='$id'");
							$req01->execute();
							while ($donnees = $req01->fetch(PDO::FETCH_ASSOC))
							{
							

if ($visiblepar==''){$visiblepar.=$donnees['desc'];}else{$visiblepar.=(' + '.$donnees['desc'].'');}
if ($ngroupe==''){$ngroupe=(''.$donnees['autorisation'].'');}else{$ngroupe=(''.$ngroupe.','.$donnees['autorisation'].'');}
}

echo ('<tr><td>'.$titre1.'</td><td>'.$auteur1.'</td><td>'.$statut_actif.'</td><td>'.$statut_accueil.'</td><td>'.$date1.'</td><td>'.$visiblepar.'</td><td>'.$statut_datedebut.'</td><td>'.$statut_datefin.'</td><td width="10%"><div class="btn-group btn-group-justified"><a href="#myModal1" data-toggle="modal" class="myModal3btn btn btn-xs btn-warning" ntitre="'.$titre1.'" nid="'.$id.'" ntexte="'.htmlspecialchars($texte1).'" nactif="'.$actif1.'" naccueil="'.$accueil1.'" ndu="'.$date_debut2.'" nau="'.$date_fin2.'" ngroupe="'.$ngroupe.'" naction="action.php?type=APPLIS&mod=Breves&fonc=modifier"><i class="fa fa-cog"></i></a><a href="#myModal2" data-toggle="modal" class="myModal2btn btn btn-xs btn-danger" ntitre="'.$titre1.'" nid="'.$id.'"><i class="fa fa-trash-o"></i></a></div></td></tr>');
}
?>       </tbody>                                                     

                                      
                                      

                                      </tfoot>
                          </table>
                                
</div>

                  </div>
				                        </section>
</div></div>									  
<!--------------------------------------------------->							  
<!--AJOUT NEWS-->
                              <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" name="myModal1" id="myModal1" class="modal fade">
                                  <div class="modal-dialog">
                                      <div class="modal-content">
                                          <div class="modal-header">
                                              <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                              <h4 class="modal-title" id="modaltitre">Ajout d'une brève</h4>
                                          </div>
                                          <div class="modal-body">
<div class="stepy-tab">
                                  <ul id="default-titles" class="stepy-titles clearfix">
                                      <li id="default-title-0" class="current-step">
                                          <div>Etape 1</div>
                                      </li>
                                      <li id="default-title-1" class="">
                                          <div>Etape 2</div>
                                      </li>
                                      <li id="default-title-2" class="">
                                          <div>Etape 3</div>
                                      </li>
									  <li id="default-title-3" class="">
                                          <div>Etape 4</div>
                                      </li>
                                  </ul>
                              </div>
                              <form class="form-horizontal" id="default" action="action.php?type=APPLIS&mod=Breves&fonc=ajouter" method="post">
                                  <fieldset title="Etape 1" class="step" id="default-step-0">
                                      <legend> </legend>
                                      <div class="form-group">
                                          <label class="col-lg-2 control-label">Titre</label>
                                          <div class="col-lg-10">
                                              <input type="text" class="form-control" id="TITRE" name="TITRE" placeholder="Titre" minlength="2" required>
                                          </div>
                                      </div>                                     
                                  </fieldset>
                                  <fieldset title="Etape 2" class="step" id="default-step-1" >
                                      <legend> </legend>
									  <div class="form-group">
                                                  
                                                  <div>
                                                      <textarea class="form-control ckeditor" name="editor2" ></textarea>
                                                  </div>
                                              </div>
											  
                                      
                                      

                                  </fieldset>
                                  <fieldset title="Etape 3" class="step" id="default-step-2" >
                                      <legend> </legend>
							   <div class="form-group">
									  <div class="col-lg-10 checkboxes">
                                              <label class="label_check" for="checkbox-01">
                                                  <input name="checkbox-01" id="checkbox-01" value="1" type="checkbox" /> Activation immédiate de la brève
                                              </label>
											  <label class="label_check" for="checkbox-02">
                                                  <input name="checkbox-02" id="checkbox-02" value="1" type="checkbox"  /> Publication sur la page accueil
                                              </label>											  
                                      </div>
									  </div>
								 
                                    
                                      <div class="form-group">
                                  <label class="control-label col-lg-4">Dates de publication</label>
                                 
                                      <div class="input-group input-large col-lg-6" data-date-format="dd/MM/yyyy" >
                                          <input type="text" class="form-control dpd1" name="from" id="from">
                                          <span class="input-group-addon">Au</span>
                                          <input type="text" class="form-control dpd2" name="to" id="to">
                                      </div>
                                      
                                  
                              </div>
                                   

                                  </fieldset>
								       <fieldset title="Etape 4" class="step" id="default-step-3">
                                      <legend> </legend>
                                                               <div class="form-group">
                                  <label class="control-label col-md-3">Groupe(s) autorisés à lire la brève :</label>
                                  <div class="col-md-9">
                                      <select multiple="multiple" class="multi-select" id="my_multi_select1" name="my_multi_select1[]">
                                          <?php
//REQUETE 02
$req02= $bdd->prepare("select * from cms_groupes  ORDER BY id ASC");
$req02->execute();
while ($donnees2 = $req02->fetch(PDO::FETCH_ASSOC))
{
	echo('<option value="'.$donnees2['id'].'">'.$donnees2['desc'].'</option>');
}
?>
										  
                                      </select>
                                  </div>
                              </div>
                                  </fieldset>
									<input type="hidden" name="auteur" value="<?php echo $_SESSION['cms_user_prenom']; ?>">
									<input type="hidden" name="nid" id="nid" value="">
									<input type="hidden" name="date" value="<?php echo date('Y-m-d'); ?>">
                                  <input type="submit" class="finish btn btn-danger" value="Enregistrer"/>
								  
                              </form>
                                      </div>
                                  </div>
                              </div>	</div>						  
<!--FIN AJOUT NEWS-->

<!--RESET VALEURS PAR DEFAUT AJOUT NEWS-->
<script type="text/javascript">
var elementsa = document.getElementsByClassName('myModal1btn');
for (var i = 0; i < elementsa.length; i++) {
elementsa[i].addEventListener('click', function() {
<!--TITRE DE LA MODALE-->
$("#default")[0].reset();
document.getElementById("modaltitre").innerHTML = 'Ajout d\'une brève';
$('#default').attr('action', 'action.php?type=APPLIS&mod=Breves&fonc=ajouter');
}, false);
}
</script>
<!--FIN RESET VALEURS PAR DEFAUT AJOUT NEWS-->

<!--SUPPRESSION NEWS-->
<script type="text/javascript">
var elements2 = document.getElementsByClassName('myModal2btn');
for (var i = 0; i < elements2.length; i++) {
elements2[i].addEventListener('click', function() {
var ntitre = $(this).attr("ntitre");
var nid = $(this).attr("nid");
document.getElementById("supprimer-newsid").value = nid;
$('#sup-nid span').text('Souhaitez-vous vraiment supprimer la brève : ' + ntitre + ' N°' + nid +' ?');
}, false);
}
</script>

                              <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal2" name="myModal2" class="modal fade">
                                  <div class="modal-dialog">
                                      <div class="modal-content">
                                          <div class="modal-header">
                                              <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                              <h4 class="modal-title">Suppression d'une brève</h4>
                                          </div>
                                          <div class="modal-body">

                                              <form role="form" action="action.php?type=APPLIS&mod=Breves&fonc=supprimer" method="post" class=" cmxform form-horizontal tasi-form">
                                                  <div class="form-group" id="sup-nid">
                                                      <span class="col-lg-10">Souhaitez-vous vraiment supprimer la brève ?</span>
                                                  </div>
												  <input type="hidden" class="form-control" name="supprimer-newsid" id="supprimer-newsid" value="" />
                                                  <button type="submit" class="btn btn-danger"><i class="fa fa-trash-o"></i> Confirmer</button>
                                              </form>
                                          </div>
                                      </div>
                                  </div>
                              </div>

<!--FIN SUPPRESSION NEWS-->

<!--EDITION NEWS-->
<script type="text/javascript">
var elements3 = document.getElementsByClassName('myModal3btn');
for (var i = 0; i < elements3.length; i++) {
elements3[i].addEventListener('click', function() {
<!--TITRE DE LA MODALE-->
var nid = $(this).attr("nid");
document.getElementById("modaltitre").innerHTML = 'Edition de la brève n°' + nid;
<!--CHANGEMENT ACTION DU FORM-->
var naction = $(this).attr("naction");
$('#default').attr('action', ''+naction);
<!--STEP 1-->
var ntitre = $(this).attr("ntitre");
document.getElementById("TITRE").value = ntitre;
<!--STEP 2-->
var ntexte = $(this).attr("ntexte");
CKEDITOR.instances.editor2.setData(ntexte);
<!--STEP 3-->
var nactif = $(this).attr("nactif");
if(nactif == '1'){$("input[name='checkbox-01']").prop("checked",true);}else{$("input[name='checkbox-01']").prop("checked",false);}
var naccueil = $(this).attr("naccueil");
if(naccueil == '1'){$("input[name='checkbox-02']").prop("checked",true);}else{$("input[name='checkbox-02']").prop("checked",false);}
var ndu = $(this).attr("ndu");
document.getElementById("from").value = ndu;
var nau = $(this).attr("nau");
document.getElementById("to").value = nau;
<!--STEP 4--*>
$('#my_multi_select1').multiSelect('deselect_all');
var ngroupe = $(this).attr("ngroupe");
var myArray = ngroupe.split(',');
for(var i=0;i<myArray.length;i++){$('#my_multi_select1').multiSelect('select', myArray[i]);}
<!--CHAMPS CACHES-->
var nid = $(this).attr("nid");
document.getElementById("nid").value = nid;
}, false);
}
</script>							  
