<?php
//include('/03-CONFIG/date.php');
if (isset($_GET['idn'])){
$idn=$_GET['idn'];
$req01 = $bdd->prepare("SELECT * FROM cms_breves WHERE id=$idn");
$req01->execute();		
$visible='0';
while ($donnees = $req01->fetch(PDO::FETCH_ASSOC))
{
$id = intval($donnees['id']);
//requete permissions
$req02 = $bdd->prepare("SELECT * FROM cms_breves_permissions WHERE breve_id='$id'");
$req02->execute();
while ($donnees2 = $req02->fetch(PDO::FETCH_ASSOC))
{if (in_array($donnees2[autorisation],$membre_groupes)) {$visible='1';} }
//AFFICHAGE
if ($visible=='1')
{
$auteur1 = $donnees['auteur'];
$texte1 = $donnees['texte'];
$titre1 = $donnees['titre'];
$date1 = (stripslashes($donnees['date']));
$date2 = explode("-", $date1);
$visible='0';
}
}
} //FIN IF ISSET IDN
?>
<!--breadcrumbs start-->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-sm-4">
                    <h1><?php echo $titre1;?></h1>
                </div>
                <div class="col-lg-8 col-sm-8">
                    <ol class="breadcrumb pull-right">
                        <li><a href=".">Accueil</a></li>
						<li><a href="module.php?id=News">News</a></li>						
                        <li class="active"><?php echo $titre1;?></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!--breadcrumbs end-->
<!--container start-->
    <div class="container">
        <div class="row">
<!--blog start-->
            <div class="col-lg-12 ">
                <div class="blog-item">
                    <div class="row">
                        <div class="col-lg-3 col-sm-3">
                            <div class="date-wrap">
                                <span class="date"><?php echo $date2['0'];?></span>
                                <span class="month"><?php echo $date2['2'];?> <?php echo DateMoisTxt($date2['1']);?></span>
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
