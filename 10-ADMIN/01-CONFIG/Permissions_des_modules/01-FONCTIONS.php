<?php


 


//FONCTIONS ADAPTEES AU THEME FLAT

function definir_droits()

{
include('03-CONFIG/01-BDD.php');
$module_nom=$_POST['modulenom'];

$Col1_Array = $_POST['my_multi_select1'];

// On commence par effacer toutes les autorisations du module
$req01= $bdd->prepare("DELETE FROM cms_modules_admin WHERE nom='$module_nom'");
$req01->execute();


// on traite ensuite les droits pour le module

	foreach($Col1_Array as $selectValue)

	{
$req02= $bdd->prepare("INSERT INTO cms_modules_admin VALUES(NULL,'$module_nom','$selectValue')");
$req02->execute();


	}



//Retour au module

Header("Location:admin.php?config=Permissions_des_modules");

}



function definir_droits_frontend()

{
include('03-CONFIG/01-BDD.php');
$module_nom=$_POST['modulenom2'];

$Col1_Array = $_POST['my_multi_select2'];

// On commence par effacer toutes les autorisations du module
$req01= $bdd->prepare("DELETE FROM cms_modules_permissions WHERE nom='$module_nom'");
$req01->execute();


// on traite ensuite les droits pour le module

	foreach($Col1_Array as $selectValue)

	{
$req02= $bdd->prepare("INSERT INTO cms_modules_permissions VALUES(NULL,'$module_nom','$selectValue')");
$req02->execute();
	

	}



//Retour au module

Header("Location:admin.php?config=Permissions_des_modules");

}

?>