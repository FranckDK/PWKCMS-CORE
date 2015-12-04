<?php
//CONNEXION BDD
include('03-CONFIG/01-BDD.php');




//FONCTIONS
function ajouter()
{
include('03-CONFIG/01-BDD.php');
$TITRE=$_POST['TITRE']; //ok
$TEXTE=$_POST['editor2']; //ok
$ACTIVATION=$_POST['checkbox-01']; //retourne on ou rien
//echo $ACTIVATION;
$ACCUEIL=$_POST['checkbox-02']; // //retourne on ou rien
$DATE_DEBUT=($_POST['from']); //retourne la date de debut au format jj/mm/aaaa
$DATE_FIN=($_POST['to']); //retourne la date de fin au format jj/mm/aaaa
$AUTEUR=$_POST['auteur']; //ok
$DATE = $_POST['date'];
$Col1_Array = $_POST['my_multi_select1'];
//INSERTION DANS LA BDD
//mysql_query("INSERT INTO cms_breves VALUES('','$ACTIVATION','$ACCUEIL','$AUTEUR','$TITRE','$TEXTE','$DATE','$DATE_DEBUT','$DATE_FIN')") or die(mysql_error());
$bdd->query("INSERT INTO cms_breves VALUES('','$ACTIVATION','$ACCUEIL','$AUTEUR','$TITRE','$TEXTE','$DATE','$DATE_DEBUT','$DATE_FIN')") or die('ERREUR '.mysql_error().'');
$idbreve = $bdd->lastInsertId();
//MISE A JOUR DES DROITS
foreach ($Col1_Array as $cle)
{
//mysql_query("INSERT INTO cms_breves_permissions VALUES('','$idbreve','$cle')");
$bdd->query("INSERT INTO cms_breves_permissions VALUES('','$idbreve','$cle')") or die('ERREUR '.mysql_error().'');
}
//REDIRECTION
Header("Location:admin.php?module=Breves");
}

function supprimer()
{
include('03-CONFIG/01-BDD.php');
$id = $_POST['supprimer-newsid'];
$bdd->exec("DELETE FROM cms_breves WHERE id=$id");
$bdd->exec("DELETE FROM `cms_breves_permissions` WHERE breve_id=$id");
//REDIRECTION
Header("Location:admin.php?module=Breves");
}

function modifier()
{
include('03-CONFIG/01-BDD.php');
$id=$_POST['nid'];
$TITRE=$_POST['TITRE']; //ok
$TEXTE=$_POST['editor2']; //ok
$ACTIVATION=$_POST['checkbox-01']; //retourne on ou rien
$ACCUEIL=$_POST['checkbox-02']; // //retourne on ou rien
$DATE_DEBUT=($_POST['from']); //retourne la date de debut au format jj/mm/aaaa
if($DATE_DEBUT==''){$DATE_DEBUT="00/00/0000";}
$DATE_DEBUT = date_format(date_create_from_format('d/m/Y', $DATE_DEBUT),'Y-m-d'); 
$DATE_FIN=($_POST['to']); //retourne la date de fin au format jj/mm/aaaa
if($DATE_FIN==''){$DATE_FIN="00/00/0000";}
$DATE_FIN = date_format(date_create_from_format('d/m/Y', $DATE_FIN),'Y-m-d');
$AUTEUR=$_POST['auteur']; //ok
$DATE = $_POST['date'];
$Col1_Array = $_POST['my_multi_select1'];
//remise à zero des droits
$bdd->query("DELETE FROM cms_breves_permissions WHERE breve_id=$id") or die('ERREUR '.mysql_error().'');
foreach ($Col1_Array as $cle)
{
$bdd->query("INSERT INTO cms_breves_permissions VALUES(NULL,'$id','$cle')") or die('ERREUR '.mysql_error().'');
}
$bdd->query("UPDATE cms_breves SET titre='$TITRE', texte='$TEXTE', actif='$ACTIVATION', accueil='$ACCUEIL', auteur='$AUTEUR', date='$DATE', date_debut='$DATE_DEBUT', date_fin='$DATE_FIN' WHERE id=$id");
//REDIRECTION
Header("Location:admin.php?module=Breves&ACTIVATION=$id");
}
?>