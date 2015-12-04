<?php
//CONNEXION A LA BASE DE DONNEES
try
{
	$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
	$bdd = new PDO('mysql:host=localhost;dbname=DBNAME', 'DBUSER', 'DBPASS', $pdo_options);
}
catch(Exception $e)
{
	die('Erreur : '.$e->getMessage());
}
?>