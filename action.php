<!--ACTION.PHP-->
<?php
@$type=addslashes($_GET['type']);
@$mod=addslashes($_GET['mod']);
@$fonc=addslashes($_GET['fonc']);
if ($type =='CONFIG' && $mod!=""){include('10-ADMIN/01-CONFIG/'.$mod.'/01-FONCTIONS.php');}
if ($type =='APPLIS' && $mod!=""){include('10-ADMIN/02-APPLIS/'.$mod.'/01-FONCTIONS.php');}
if ($fonc !=''){$fonc();}
?>