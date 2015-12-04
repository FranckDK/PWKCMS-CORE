<?php
//Initialisation variable $user_id
session_start();
if($_SESSION['cms_user_id']=='')
{
$adm_acc='0';
$acc_tabbord='0';
$acc_adminconfig='0';
$acc_adminmodule='0';
$membre_groupes[] = '1';
}
else
{
$user_id=$_SESSION['cms_user_id'];
//PDO
$reqs1 = $bdd->prepare("select * from cms_groupes_membres LEFT JOIN cms_groupes ON cms_groupes_membres.group_id=cms_groupes.id WHERE user_id=$user_id");
$reqs1->execute();
//Construction array $membre_groupes
$membre_groupes[] = '1';
while ($ress1 = $reqs1->fetch(PDO::FETCH_ASSOC))
{
$membre_groupes[] = $ress1['group_id'];
}
if (@$_GET['mod']!=''){$id=$_GET['mod'];
$reqs2 = $bdd->prepare("SELECT * FROM cms_modules_admin WHERE nom=$id");
$reqs2->execute();
while ($ress2 = $reqs2->fetch(PDO::FETCH_ASSOC)){if (in_array($ress2[autorisation],$membre_groupes)) {$adm_acc='1';}}
}

//Gere les acces au tableau de bord

$reqs3 = $bdd->prepare("SELECT * FROM cms_modules_admin");
$reqs3->execute();while ($ress3 = $reqs3->fetch(PDO::FETCH_ASSOC)){if (@in_array($ress3[autorisation],$membre_groupes)) {$acc_tabbord='1';}}
/////////OK
@$CONFIG=$_GET['config'];
if ($CONFIG!=''){
$reqs4 = $bdd->prepare("SELECT * FROM cms_modules_admin WHERE nom='$CONFIG'");
$reqs4->execute();while ($ress4 = $reqs4->fetch(PDO::FETCH_ASSOC)){if (@in_array($ress4[autorisation],$membre_groupes)) {$acc_adminconfig='1';}}
}

@$MODULE=$_GET['module'];
$reqs5 = $bdd->prepare("SELECT * FROM cms_modules_admin WHERE nom='$MODULE'");
$reqs5->execute();
while ($ress5 = $reqs5->fetch(PDO::FETCH_ASSOC)){if (in_array($ress5[autorisation],$membre_groupes)) {$acc_adminmodule='1';}}
//Accès accordé systématiquement aux administrateurs
if (@in_array('2',$membre_groupes)){$acc_tabbord='1'; $adm_acc='1'; $acc_adminconfig='1'; $acc_adminmodule='1';}
}
?>