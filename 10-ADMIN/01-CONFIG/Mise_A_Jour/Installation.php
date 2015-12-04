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
                                  <div class="progress-bar progress-bar-success"  role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 66%">
                                      <span class="sr-only">66% accompli</span>
                                  </div>
                              </div>
							  </div>
                      </section>
                      <!--progress bar end-->
<?php			
$new_version =$_SESSION['MAJ'];
?>
<div class="row">
                  <div class="col-md-12">
                      <section class="panel tasks-widget">
                          <header class="panel-heading">
                              Progression de la mise à jour en version <?php echo $new_version; ?>
                          </header>
                          <div class="panel-body">

                              <div class="task-content">

                                  <ul class="task-list">
									  
<?php

				//Open The File And Do Stuff
				$zipHandle = zip_open('90-PACKAGE/version-'.$new_version.'.zip');
				//echo '<ul>';
				while ($aF = zip_read($zipHandle) ) 
				{
					$thisFileName = zip_entry_name($aF);
					$thisFileDir = dirname($thisFileName);
					
					//Continue if its not a file
					if ( substr($thisFileName,-1,1) == '/') continue;
					
	
					//Make the directory if we need to...
					if ( !is_dir ( ''.$thisFileDir ) )
					{
						 mkdir ( ''.$thisFileDir );
						 echo('<li><div class="task-title"><span class="task-title-sp">Répertoire : '.$thisFileDir.' créé avec succés</span><div class="pull-right hidden-phone"><button class="btn btn-success btn-xs"><i class=" fa fa-check"></i></button></div></div></li>');
						 
					}
					
					//Overwrite the file
					if ( !is_dir(''.$thisFileName) ) {
						//echo '<li>'.$thisFileName.'...........';
						//echo('<li><div class="task-checkbox"><input type="checkbox" class="list-child" value=""  /></div><div class="task-title"><span class="task-title-sp">'.$thisFileName.'...........');
						echo('<li><div class="task-title"><span class="task-title-sp">'.$thisFileName.'');
						$contents = zip_entry_read($aF, zip_entry_filesize($aF));
						$contents = str_replace("\r\n", "\n", $contents);
						$updateThis = '';
						
						//If we need to run commands, then do it.
						if ( $thisFileName == 'upgrade.php' )
						{
							$upgradeExec = fopen ('upgrade.php','w');
							fwrite($upgradeExec, $contents);
							fclose($upgradeExec);
							include ('upgrade.php');
							unlink('upgrade.php');
							echo(' -> -> -> Script correctement exécuté</span><div class="pull-right hidden-phone"><button class="btn btn-success btn-xs"><i class=" fa fa-check"></i></button></div></div></li>');
							//echo' Script de mise à jour exécuté avec succès</span><div class="pull-right hidden-phone"><button class="btn btn-success btn-xs"><i class=" fa fa-check"></i></button></div></div></li>';
						}
						else
						{
							$updateThis = fopen(''.$thisFileName, 'w');
							fwrite($updateThis, $contents);
							fclose($updateThis);
							unset($contents);
							echo(' -> -> -> Fichier mis à jour</span><div class="pull-right hidden-phone"><button class="btn btn-success btn-xs"><i class=" fa fa-check"></i></button></div></div></li>');
							//echo(' Fichier mis à jour</span><div class="pull-right hidden-phone"><button class="btn btn-success btn-xs"><i class=" fa fa-check"></i></button></div></div></li>');
						}
						?>

									  <?php
					}
				}
				//echo '</ul>';
				$updated = TRUE;
?>
 </ul>
                              </div>
</div>
</section>
</div>
</div>
<section class="panel">
                          <header class="panel-heading">
                              Processus de mise à jour...
                          </header>
                          <div class="panel-body">
                              <a href="admin.php?config=Mise_A_Jour&do=Fin"><button type="button" class="btn btn-success btn-lg btn-block">Cliquer ici pour finaliser la mise à jour.</button></a>
                              
                          </div>
                      </section>