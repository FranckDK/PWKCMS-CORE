<!--breadcrumbs start-->
    <div class="breadcrumbs">
	<div class="container">
	<div class="row">                
	<div class="col-lg-4 col-sm-4">                    
	<h1>Les news du site</h1>                
	</div>                
	<div class="col-lg-8 col-sm-8">                    
	<ol class="breadcrumb pull-right">                        
	<li><a href=".">Accueil</a></li>                                              
	<li class="active">News</li>                    
	</ol>                
	</div>            
	</div>        
	</div>    
	</div>    
	<!--breadcrumbs end-->
	<?php
	//CONNEXION BDD
	include ('03-CONFIG/01-BDD.php');
	//DEFINITION DATE DU JOUR
	$datejour = date('Y-m-d');
	//AUTO-(DES)ACTIVATION DES BREVES
$req01 = $bdd->prepare("SELECT * FROM cms_breves");
$req01->execute();
while ($donnees1 = $req01->fetch(PDO::FETCH_ASSOC))
{
$id = $donnees1['id'];
//ACTIVATION AUTOMATIQUE
$date_debut = $donnees1['date_debut'];
if ($date_debut!='0000-00-00' and $date_debut>='$datejour')
{
$bdd->query("UPDATE cms_breves SET actif='1' WHERE id=$id")or die(mysql_error());
}
//DESACTIVATION AUTOMATIQUE
$date_fin = $donnees1['date_fin'];
if ($date_fin!='0000-00-00' and $date_fin<=$datejour)
{
$bdd->query("UPDATE cms_breves SET actif='0' WHERE id=$id")or die(mysql_error());
}
}
//FIN AUTO-(DES)ACTIVATION DES BREVES
	//AFFICHAGE DES BREVES
	//COMPTAGE pour le nombre de page
	$reponse_comptage = $bdd->prepare("SELECT COUNT(*) AS NB_BREVES FROM cms_breves WHERE actif='1' and date_debut<='$datejour'");
	$reponse_comptage->execute();
	//$row = mysql_fetch_row($reponse_comptage);
	$columns = $reponse_comptage->fetch();
    $reponse_comptage = $columns['NB_BREVES'];
	$nb_page=ceil($reponse_comptage/5);
	
	//Définition de la limite pour la requete
	$page=$_GET['page'];if($page==''){$offset='0'; $page='1';}else{$offset=($page-1)*5;}
	$reponse = $bdd->prepare("SELECT * FROM cms_breves WHERE actif='1' and date_debut<='$datejour' order by date DESC LIMIT 5 OFFSET $offset");
	$reponse->execute();
	$visible='0';
	while ($donnees = $reponse->fetch(PDO::FETCH_ASSOC))
	{
		$id = $donnees['id'];
		//requete permissions
		$reponse2 = $bdd->prepare("SELECT * FROM cms_breves_permissions WHERE breve_id='$id'");
		$reponse2->execute();
		while ($donnees2 = $reponse2->fetch(PDO::FETCH_ASSOC))
		//while ($donnees2 = mysql_fetch_array($reponse2) )
		{
			if (in_array($donnees2[autorisation],$membre_groupes)) {$visible='1';}
		}
		//AFFICHAGE
		if ($visible=='1'){
		$auteur1 = $donnees['auteur'];
		$texte1 = $donnees['texte'];
		$titre1 = $donnees['titre'];
		$date1 = (stripslashes($donnees['date']));
		$date2 = explode("-", $date1);
		$visible='0';
		?>
		<!--container start-->
		<div class="container">        
		<div class="row">
		<!--blog start-->            
		<div class="col-lg-12 ">
		<div class="blog-item">                    
		<div class="row">                        
		<div class="col-lg-3 col-sm-3">                            
		<div class="date-wrap">                                
		<span class="date">
		<?php
		echo $date2['0'];
		?>
		</span>                                
		<span class="month">
		<?php 
		echo $date2['2'];
		echo(' ');
		echo DateMoisTxt($date2['1']);
		?>
		</span>                            
		</div>                            
		<!--<div class="comnt-wrap">                                
		<span class="comnt-ico">                                    
		<i class="fa fa-comments"></i>                                
		</span>                                
		<span class="value">15</span>                            
		</div>-->                        
		</div>                        
		<div class="col-lg-9 col-sm-9">                            
		<h1><?php echo $titre1; ?></h1>                            
		<p><?php echo $texte1; ?></p>                                                    
		</div>                    
		</div>                    
		<div class="row">                        
		<div class="col-lg-3 col-sm-3 text-right">                            
		<div class="author">                                
		Par <a href="#"><?php echo $auteur1; ?></a>                            
		</div>                                                    
		</div>                                            
		</div>                
		</div>                           
		</div>                        
		<!--blog end-->			
		</div></div>						
		<?php
		}
		}
		if($nb_page>1){
		?> 
		<div class="text-center">                    
		<ul class="pagination">                        
		<!--<li><a href="#">«</a></li>-->						
		<?php 
		for ($i = 1; $i <= $nb_page; $i++)
		{ 
		if($page==$i){echo ('<li class="active"><a href="module.php?id=News&page='.$i.'">'.$i.'</a></li>');}else{echo ('<li><a href="module.php?id=News&page='.$i.'">'.$i.'</a></li>');}}
		?>
		<!--<li><a href="#">»</a></li>-->
		</ul>                
		</div>
		<?php
		}
		?>