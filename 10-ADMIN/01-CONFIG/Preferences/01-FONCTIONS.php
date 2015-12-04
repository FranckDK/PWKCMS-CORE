<?php

function editer_pref()
{
include('03-CONFIG/01-BDD.php');
$groupeid=$_POST['editer-groupeid'];
$groupedesc=$_POST['editer-groupe'];
$bdd->query("UPDATE `cms_preferences` SET `cms_pref_valeur` = '$groupedesc' WHERE `cms_pref_id` = '$groupeid' LIMIT 1;");
//Retour au module
Header("Location:admin.php?config=Preferences");
}

?>