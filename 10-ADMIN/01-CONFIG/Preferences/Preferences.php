              <!--navigation start-->
                      <nav class="navbar navbar-inverse" role="navigation">
                          <!-- Brand and toggle get grouped for better mobile display -->
                          <div class="navbar-header">
                              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                                  <span class="sr-only">Toggle navigation</span>
                                  <span class="fa fa-bars"></span>
                              </button>
							  <a class="navbar-brand" href="admin.php"><i class="fa fa-dashboard"></i></a>
                              <a class="navbar-brand" href="#">Préférences</a>
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
                              Liste des paramètres créés dans préférences.
                          </header>
                          <div class="panel-body">
                                <div class="adv-table editable-table " >
                                    <table  class="display table table-bordered table-striped" id="editable-sample">
                                      <thead>
                                      <tr>
                                          <th>Id</th>
                                          <th>Nom du paramètre</th>                                         
										  <th>Description</th>
                                          <th>Valeur</th>
                                          <th>Action(s)</th>
                                      </tr>
                                      </thead>
                                      <tbody>
	<?php
	//RECUPERATION DES PREFERENCES
	$req01= $bdd->prepare("SELECT * FROM cms_preferences");
	$req01->execute();
	while ($donnees01 = $req01->fetch(PDO::FETCH_ASSOC))
	{
	echo ('<tr class=\"gradeX\"><td>'.$donnees01['cms_pref_id'].'</td><td>'.$donnees01['cms_pref_variable'].'</td><td>'.utf8_encode($donnees01['cms_pref_desc']).'</td><td>'.$donnees01['cms_pref_valeur'].'</td><td><a href="#myModal1" data-toggle="modal" class="myModal1btn btn btn-xs btn-warning" title="Editer" groupedesc="'.utf8_encode($donnees01['cms_pref_variable']).'" groupeval="'.$donnees01['cms_pref_valeur'].'" groupeid="'.$donnees01['cms_pref_id'].'"><i class="fa fa-edit"></i></a></td></tr>');
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
              </div>
			  
<!--script for this page-->
  <script src="01-TEMPLATE/FLAT-ADMIN/js/form-component.js"></script>
<!--EDITION PREFERENCE-->
                              <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" name="myModal1" id="myModal1" class="modal fade">
                                  <div class="modal-dialog">
                                      <div class="modal-content">
                                          <div class="modal-header">
                                              <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                              <h4 class="modal-title" id="modal-title"><span>Edition du paramètre</span></h4>
                                          </div>
                                          <div class="modal-body">

                                              <form role="form" action="action.php?type=CONFIG&mod=Preferences&fonc=editer_pref" method="post" class="cmxform form-horizontal tasi-form" id="commentForm" >
                                                  <div class="form-group">	
												  
												  <label for="editer_nom_groupe" class="control-label col-lg-4">Valeur du paramètre (requis)</label>
												  
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
		var groupeval = $(this).attr("groupeval");
		$('#modal-title span').text('Edition du Paramètre ' + groupedesc + ' ?');
		document.getElementById("editer-groupe").value = groupeval;
		document.getElementById("editer-groupeid").value = groupeid;
    }, false);
}
</script>
<!--FIN EDITION PREFERENCE-->