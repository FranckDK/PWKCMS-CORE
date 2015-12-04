<?php
ini_set('display_errors',1);
session_start();
//FONCTION LOGOUT
$logout=@$_GET['logout'];
if($logout=='oui'){
session_destroy();
session_unset();
Header("Location:admin.php"); //SI TOUT A BIEN MARCHE ON RENVOI SUR LA PAGE ADMIN
}
include('03-CONFIG/01-BDD.php');
//inclusion fonction date
include('03-CONFIG/date.php');
//inclusion_securite
include('10-ADMIN/03-SECURITE/securite.php');
//inclusion_securite
include('03-CONFIG/10-perm_modules.php');
// On récupère l'url:
$elements_url = $_SERVER['REQUEST_URI'];
// On supprime les slashes:
$elements_url = explode('/', $elements_url);
// On compte le nombre d'entrées:
$nombre_elements = count($elements_url);
// On récupère le nom de la page :
$nompage = $elements_url[$nombre_elements-1];
//INCLUSION HEADER
include('01-TEMPLATE/FLAT-ADMIN/header.php');
//INCLUSION NAVIGATION GAUCHE
include('01-TEMPLATE/FLAT-ADMIN/nav-gauche.php');


?>



      
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">
		   <?php
 //protection de la page
 if ($acc_tabbord=='0'){include('10-ADMIN/03-SECURITE/login.php');
}
else{
if ($_GET['config']!=''){$CONFIG=addslashes($_GET['config']);}else{$CONFIG='';}
if ($_GET['module']!=''){$MODULE=addslashes($_GET['module']);}else{$MODULE='';}
if ($_GET['do']!=''){$DO=addslashes($_GET['do']);}else{$DO='';}
$ERREUR='1';
//GESTION DES ACCES QUAND AUTORISES
	//PARTIE CONFIG
	if($CONFIG!='' && $DO=='' && $acc_adminconfig=='1'){include('10-ADMIN/01-CONFIG/'.$CONFIG.'/'.$CONFIG.'.php'); $ERREUR='0';}
	
	if($CONFIG!='' && $DO!='' && $acc_adminconfig=='1'){include('10-ADMIN/01-CONFIG/'.$CONFIG.'/'.$DO.'.php'); $ERREUR='0';}
	//PARTIE MODULE
	if($MODULE!="" && $DO=="" && $acc_adminmodule=='1'){include('10-ADMIN/02-APPLIS/'.$MODULE.'/'.$MODULE.'.php'); $ERREUR='0';}
	if($MODULE!="" && $DO!="" && $acc_adminmodule=='1'){include('10-ADMIN/02-APPLIS/'.$MODULE.'/'.$DO.'.php'); $ERREUR='0';}
//GESTION D'UN ACCES NON AUTORISE
//RENVOI VERS LA PAGE PAR DEFAUT
	if($CONFIG=='' && $MODULE==''){include('10-ADMIN/page-defaut.php'); $ERREUR='0';}
//PAGE ERREUR SI DROITS NON ACQUIS
	if($ERREUR=='1'){include('10-ADMIN/acces_non_autorise.php');}
}//fin if securite?>
 
          </section>
      </section>
      <!--main content end-->
<?php
//INCLUSION FOOTER
include('01-TEMPLATE/FLAT-ADMIN/footer.php');
?>
     
