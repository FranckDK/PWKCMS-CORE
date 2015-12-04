<!--FICHIER FONCTION DU MODULE CONFIG/UTILISATEURS-->
<?php
//FONCTIONS ADAPTEES AU THEME FLAT
function ajouter_groupe(){	
//CONNEXION BDD
include('03-CONFIG/01-BDD.php');
$nom = $_POST['ajouter-groupe'];
$bdd->query("INSERT INTO cms_groupes VALUES(NULL,'$nom')");
Header("Location:admin.php?config=Utilisateurs");}///////////////////////////////////////////////////////////////////////////////////////////////////////
function editer_groupe()
{
include('03-CONFIG/01-BDD.php');
$groupeid=$_POST['editer-groupeid'];
$groupedesc=$_POST['editer-groupe'];
$bdd->query("UPDATE `cms_groupes` SET `desc` = '$groupedesc' WHERE `id` = '$groupeid' LIMIT 1;");
//Retour au module
Header("Location:admin.php?config=Utilisateurs");
}///////////////////////////////////////////////////////////////////////////////////////////////////////
function supprimer_groupe() {include('03-CONFIG/01-BDD.php');
$groupeid=$_POST['supprimer-groupeid'];
$bdd->query("DELETE FROM cms_groupes WHERE id=$groupeid");
//VIDAGE Table cms_groupes_membres
$bdd->query("DELETE FROM cms_groupes_membres WHERE group_id=$id");
Header("Location:admin.php?config=Utilisateurs");
}///////////////////////////////////////////////////////////////////////////////////////////////////////
function ajouter_utilisateur(){include('03-CONFIG/01-BDD.php');$login=$_POST['login'];$nom = strtoupper(addslashes($_POST['nom']));$prenom = addslashes($_POST['prenom']);$prenom = ucfirst(strtolower($prenom));$email = $_POST['email'];$password = md5($_POST['password']);$bdd->query("INSERT INTO cms_users (id, cms_users_login, nom, prenom, email, password) VALUES(NULL,'$login','$nom','$prenom','$email','$password')");Header("Location:admin.php?config=Utilisateurs");}///////////////////////////////////////////////////////////////////////////////////////////////////////
function supprimer_utilisateur() 
{
	include('03-CONFIG/01-BDD.php');$id = $_POST['supprimer-userid'];$bdd->query("DELETE FROM cms_users WHERE id=$id")or die(('<p class="msg error">ERREUR SQL REQ.01 >>> '.mysql_error().'</p>'));$SITE_SQL++;
//VIDAGE Table cms_groupes_membres
$bdd->query("DELETE FROM cms_groupes_membres WHERE user_id=$id")or die(('<p class="msg error">ERREUR SQL REQ.02 >>> '.mysql_error().'</p>'));$SITE_SQL++;Header("Location:admin.php?config=Utilisateurs");}
///////////////////////////////////////////////////////////////////////////////////////////////////////
function editer_utilisateur()
{
	include('03-CONFIG/01-BDD.php');
	$id = $_POST['editer-userid'];
	$nom = strtoupper(addslashes($_POST['editer-nom']));
	$login=addslashes($_POST['editer-login']);
	$prenom = addslashes($_POST['editer-prenom']);
	$prenom = ucfirst(strtolower($prenom));
	$email = $_POST['editer-email'];
	$password = $_POST['password'];
	$confirm_password = $_POST['confirm_password'];
	$new_password=md5($password);
	if($password==''){$INFO='MDPVIDE';}elseif ($password!=$confirm_password){$INFO='MDPDIF';} else{$INFO='MAJ';}
	if ($password==$confirm_password && $password!='')
		{
			$bdd->query("UPDATE cms_users SET cms_users_login='$login', nom='$nom', prenom='$prenom', email='$email', password='$new_password' WHERE id=$id")or die(('<p class="msg error">ERREUR SQL REQ.03 >>> '.mysql_error().'</p>'));
		}
	else
		{
			$bdd->query("UPDATE cms_users SET cms_users_login='$login', nom='$nom', prenom='$prenom', email='$email' WHERE id=$id")or die(('<p class="msg error">ERREUR SQL REQ.02 >>> '.mysql_error().'</p>'));
		}
	Header("Location:admin.php?config=Utilisateurs&INFO=$INFO");
}
///////////////////////////////////////////////////////////////////////////////////////////////////////
function Login()
{
session_start();
include('03-CONFIG/01-BDD.php');
$login = addslashes($_POST['login']);
$pass = md5(addslashes($_POST['pass']));
$identification_form = (''.$login.''.$pass.'');
//echo $identification_form;
//Cherche si le couple login/mdp existe dans la bdd
$reqlogin = $bdd->prepare("select * from cms_users where cms_users_login='$login'");$reqlogin->execute();
while ($reslogin = $reqlogin->fetch(PDO::FETCH_ASSOC))
{ //DEBUT WHILE 1
$identification_sql = ''.$reslogin['cms_users_login'].''.$reslogin['password'].'';
$user_prenom = $reslogin['prenom'];
$user_nom = $reslogin['nom'];
$user_email = $reslogin['email'];
$user_nom_complet = (''.$reslogin['prenom'].' '.$reslogin['nom'].'');
$user_login = $reslogin['cms_users_login'];
$user_id = $reslogin['id'];
$user_dercon=$reslogin['cms_users_dercon'];} 
//FIN WHILE 1
//ON COMPARE AVEC LA BDD
if ($identification_form==$identification_sql) {
	// IF 1
	$_SESSION['cms_user_login'] = $user_login;
	$_SESSION['cms_user_prenom'] = $user_prenom;
	$_SESSION['cms_user_nom'] = $user_nom;
	$_SESSION['cms_user_nom_complet'] = $user_nom_complet
	;$_SESSION['cms_user_email'] = $user_email;
	$_SESSION['cms_user_id'] = $user_id;
	$_SESSION['cms_user_dercon'] = $user_dercon;
	//ON LOGUE LA DATE DE CONNEXION
	$time=date("Y-m-d H:i:s");
	$reqlogin1 = $bdd->prepare("UPDATE cms_users SET cms_users_dercon='$time' WHERE id='$user_id'");
	$reqlogin1->execute();
	//ON CHERCHE LES GROUPES
	$reqlogin2 = $bdd->prepare("select * from cms_groupes_membres LEFT JOIN cms_groupes ON cms_groupes_membres.group_id=cms_groupes.id WHERE user_id=$user_id");$reqlogin2->execute();
	while ($reslogin2 = $reqlogin2->fetch(PDO::FETCH_ASSOC)){ //WHILE 2
	$membresdesgroupes[] = $reslogin2['group_id'];
	$_SESSION['cms_groupes'][] =$reslogin2['group_id'];} 
	//FIN WHILE 2
	//ON ARRIVE A LA FIN DE LA FONCTION, ON TESTE SI LA SESSION EST OUVERTE, SINON C'EST QU'IL Y A UN SOUCI
	if ((!isset($_SESSION['cms_user_login'])) || (empty($_SESSION['cms_user_login'])))
	{
	Header("Location:module.php?id=Espace_Utilisateur&login=erreur1");
	}
	//FERMETURE IF
	else{Header("Location:admin.php");  //SI TOUT A BIEN MARCHE ON RENVOI SUR LA PAGE ACCUEIL
	}
	} // FIN IF1
	else // SI CA MARCHE PAS
	{
		Header("Location:module.php?id=Espace_Utilisateur&login=erreurid");
		}//FERME LE ELSE
			}
		//FIN 		{ FONCTION
		//FIN DE FONCTION LOGIN


function affecter_groupes(){include('03-CONFIG/01-BDD.php');
$id = $_POST['groupes-userid'];
$groupes=$_POST['my_multi_select1'];
// On commence par effacer toutes les appartenances à un groupe de l'utilisateur
$bdd->query("DELETE FROM cms_groupes_membres WHERE user_id=$id") or die('ERREUR '.mysql_error().'');
// on traite ensuite les nouveaux groupes
$Col1_Array = $_POST['my_multi_select1'];
	//print_r($Col1_Array);
        foreach($Col1_Array as $selectValue){
		//On crée l'enregistrement en BDD
		$bdd->query("INSERT INTO cms_groupes_membres VALUES(NULL,'$selectValue','$id')") or die('ERREUR '.mysql_error().'');
		//affichage des valeurs sélectionnées
                //echo $selectValue."<br>";
	}
	
	//Retour au module
	Header("Location:admin.php?config=Utilisateurs");
}



?>