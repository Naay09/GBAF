<?php 
session_start();

// On détruit la session
session_destroy();
// On vide le tableau $_SESSION
$_SESSION = array();

// Suppression du cookie de connexion automatique 
if (isset($_COOKIE[session_name()])) {

    setcookie(session_name(), '',);
}

header('location: login.php');