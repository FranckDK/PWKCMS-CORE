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
                                  <li class="active"><a href="#">Installation de la mise à jour</a></li>
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
                                  <div class="progress-bar progress-bar-success"  role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                      <span class="sr-only">100% accompli</span>
                                  </div>
                              </div>
							  </div>
                      </section>
                      <!--progress bar end-->
					  

	
		
		
		<div class="row">
                  <div class="col-md-12">
                      <section class="panel tasks-widget">
                          <header class="panel-heading">
						  					<?php
					array_map('unlink', glob("90-PACKAGE/*.zip")); 
					rmdir("90-PACKAGE");
					$_SESSION['MAJ']='';
		
?>

                              La mise à jour a été effectuée avec succès, effacement du package de mise à jour réalisé.
                          </header>
						</section>
					</div>
					</div>	

					  