<?php
//DEFINITION AUTORISATION
include ('03-CONFIG/11-perm_groupes.php');
$id=@$_GET['id'];
$mod_acc='0';
$reqa1 = $bdd->prepare("SELECT * FROM cms_modules_permissions WHERE nom='$id'");
$reqa1->execute();
while ($resa1 = $reqa1->fetch(PDO::FETCH_ASSOC))
{
if (in_array($resa1['autorisation'],$membre_groupes))
{$mod_acc='1';}
}
$reqa1->closeCursor();// Termine le traitement de la requête

//RECUPERATION DES PREFERENCES
$req01= $bdd->prepare("SELECT * FROM cms_preferences");
$req01->execute();
while ($donnees01 = $req01->fetch(PDO::FETCH_ASSOC))
{
if($donnees01['cms_pref_variable']=='CMS_NOM_SITE'){$_CMS_NOM_SITE=$donnees01['cms_pref_valeur'];}
if($donnees01['cms_pref_variable']=='CMS_SLOGAN'){$_CMS_SLOGAN=$donnees01['cms_pref_valeur'];}
if($donnees01['cms_pref_variable']=='CMS_CONTACT_MAIL'){$_CMS_CONTACT_MAIL=$donnees01['cms_pref_valeur'];}
}
//RECUPERATION DE LA VERSION DU CMS INSTALLEE
$fichier = file("version.txt"); // Nom du fichier à afficher, son adresse de localisation
$total = count($fichier); // Nombre total des lignes du fichier
for($i = 0; $i < $total; $i++) 
{ // Départ de la boucle
$_CMS_VERSION=$fichier[$i];
//echo $CMS_VERSION; // On affiche ligne par ligne le contenu du fichier
} // Fin de la boucle
?>