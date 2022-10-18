<?php
// Paramètres BDD
$db="gbaf";
$dbhost="localhost";
$dbport=3306;
$dbuser="root";
$dbpasswd="";

try
{
    // On se connecte à MySQL
	$dbConnection = new PDO('mysql:host='.$dbhost.';port='.$dbport.';dbname='.$db.'', $dbuser, $dbpasswd);
}
catch (Exception $e)
{
    // En cas d'erreur, on affiche un message et on arrête tout
        die('Erreur : ' . $e->getMessage());
}

?>

