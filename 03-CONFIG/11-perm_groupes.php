<?php
//Initialisation variable $user_id
session_start();
$user_id = $_SESSION['cms_user_id'];
$membre_groupes[] = '1';
if(isset($user_id)){
//REQUETE PDO
$reqa1 = $bdd->prepare("select * from cms_groupes_membres LEFT JOIN cms_groupes ON cms_groupes_membres.group_id=cms_groupes.id WHERE user_id=$user_id");
$reqa1->execute();
while ($resa1 = $reqa1->fetch(PDO::FETCH_ASSOC))
{
$membre_groupes[] = $resa1['group_id'];
}
}

?>