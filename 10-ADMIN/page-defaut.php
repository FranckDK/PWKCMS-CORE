                      <!--navigation start-->
                      <nav class="navbar navbar-inverse" role="navigation">
                          <!-- Brand and toggle get grouped for better mobile display -->
                          <div class="navbar-header">
                              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                                  <span class="sr-only">Toggle navigation</span>
                                  <span class="fa fa-bars"></span>
                              </button>
                              <a class="navbar-brand" href="#">Tableau de bord</a>
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
                  <div class="col-lg-4">
                      <!--user info table start-->
                      <section class="panel">
                          <div class="panel-body">
                              <a href="#" class="task-thumb">
                                  <img src="02-IMAGES/avatar1.jpg" alt="">
                              </a>
							  
                              <div class="task-thumb-details">
                                  <h1><a href="#"><?php echo $_SESSION['cms_user_prenom'];?></a></h1>
                                  <p>Panneau d'administration</p>
                              </div>
							  </div>
                          
                          <table class="table table-hover personal-task">
                              <tbody>
                                <tr>
                                    <td>
                                        <i class=" fa fa-user"></i>
                                    </td>
                                    <td>Nombre d'utilisateur(s)</td>
                                    <td> <?php
//COMPTAGE
$req01 = $bdd->prepare("select count(*) FROM `cms_users`");
$req01->execute();
$res01 = $req01->fetch(PDO::FETCH_NUM);
//$nb_util = mysql_query("select count(*) FROM `cms_users`") or die(mysql_error());
//$row = mysql_fetch_row($nb_util);
//$nb_util=$res01[0];
echo $res01[0];
?></td>
                                </tr>
                                <tr>
                                    <td>
                                        <i class="fa fa-users"></i>
                                    </td>
                                    <td>Nombre de groupe(s)</td>
                                    <td><?php
//COMPTAGE GROUPE
$req02 = $bdd->prepare("select count(*) FROM `cms_groupes`");
$req02->execute();
$res02 = $req02->fetch(PDO::FETCH_NUM);
//$nb_gpe = mysql_query("select count(*) FROM `cms_groupes`") or die(mysql_error());
//$row = mysql_fetch_row($nb_gpe);
$nb_gpe=$res02[0];
echo $nb_gpe;
?></td>
                                </tr>
                                <!--<tr>
                                    <td>
                                        <i class="fa fa-envelope"></i>
                                    </td>
                                    <td>Message(s)</td>
                                    <td> 45</td>
                                </tr>
                                <tr>
                                    <td>
                                        <i class=" fa fa-bell-o"></i>
                                    </td>
                                    <td>Notification(s)</td>
                                    <td> 09</td>
                                </tr>
								-->
                              </tbody>
                          </table>
                      </section>
                      <!--user info table end-->
                  </div>
                  <div class="col-lg-8">
                      <!--work progress start-->
                      <section class="panel">
                          <div class="panel-body progress-panel">
                              <div class="task-progress">
                                  <h1>Surveillance du Système</h1>
                                  
                              </div>
                              
                          </div>
                         <table class="table table-hover personal-task">
                             <tbody>
								<tr>
									<td>1</td>									<td>Le Système est-il à jour ?</td>									<td><span class="badge bg-success">A IMPLEMENTER</span></td>								</tr>																					
                             </tbody>
                         </table>
						 
                      </section>
                      <!--work progress end-->
					  <!--work progress start-->
                      <section class="panel">
                          <div class="panel-body progress-panel">
                              <div class="task-progress">
                                  <h1>Brèves</h1>
                                  
                              </div>
                              
                          </div>
                         <table class="table table-hover personal-task">
                             <tbody>
								<tr>
									<td>1</td>									<td>Nombre de brèves en ligne</td>									<td><span class="badge bg-success"><?php
//COMPTAGE BREVES ACTIVES
$nbbreves1= $bdd->prepare("SELECT COUNT(*) FROM `cms_breves` WHERE `actif`=1");
$nbbreves1->execute();
$nbbreves1 = $nbbreves1->fetch(PDO::FETCH_NUM);
$nbbreves1=$nbbreves1[0];
echo $nbbreves1;
?></span></td>								</tr>								<tr>									<td>2</td>									<td>Nombre de brèves affichées sur l'accueil</td>									<td><span class="badge bg-success"><?php
//COMPTAGE BREVES ACTIVES ACCUEIL
$nbbreves2= $bdd->prepare("SELECT COUNT(*) FROM `cms_breves` WHERE `actif`=1 && `accueil`=1 ");
$nbbreves2->execute();
$nbbreves2 = $nbbreves2->fetch(PDO::FETCH_NUM);
$nbbreves2=$nbbreves2[0];
echo $nbbreves2;
?></span></td>								</tr>
									<tr>									<td>2</td>									<td>Nombre de brèves en attente</td>									<td><span class="badge bg-success">
<?php
//COMPTAGE BREVES EN ATTENTE
$nbbreves= $bdd->prepare("SELECT COUNT(*) FROM `cms_breves` WHERE date_debut>(curdate())");
$nbbreves->execute();
$nbbreves = $nbbreves->fetch(PDO::FETCH_NUM);
$nbbreves=$nbbreves[0];
echo $nbbreves;
?>
</span></td>								</tr>													
                             </tbody>
                         </table>
						 
                      </section>
                      <!--work progress end-->
                  </div>
              </div>


	<!-- js placed at the end of the document so the pages load faster -->
    <script src="01-TEMPLATE/FLAT-ADMIN/js/jquery.js"></script>
    <script src="01-TEMPLATE/FLAT-ADMIN/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="01-TEMPLATE/FLAT-ADMIN/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="01-TEMPLATE/FLAT-ADMIN/js/jquery.scrollTo.min.js"></script>
    <script src="01-TEMPLATE/FLAT-ADMIN/js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="01-TEMPLATE/FLAT-ADMIN/js/respond.min.js" ></script>
	<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
	<!--common script for all pages-->
    <script src="01-TEMPLATE/FLAT-ADMIN/js/common-scripts.js"></script>
	
    <!--this page plugins-->
  

    <!--this page  script only-->
	
    <script type="text/javascript" language="javascript" src="01-TEMPLATE/FLAT-ADMIN/assets/advanced-datatable/media/js/jquery.dataTables.js"></script>
    <script type="text/javascript" src="01-TEMPLATE/FLAT-ADMIN/assets/data-tables/DT_bootstrap.js"></script>
	
    <script type="text/javascript" charset="utf-8">
          $(document).ready(function() {
              $('#example').dataTable( {
                  "aaSorting": [[ 1, "asc" ]]
              } );
          } );
    </script>
	
	




	
