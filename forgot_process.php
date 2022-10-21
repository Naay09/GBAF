<?php
session_start();
require ('includes/db-connection.php');

// On vérifie que $_POST['username'], $_POST['question'] et $_POST['reponse'] existent

if(isset($_POST['username']) && isset($_POST['question']) && isset($_POST['reponse']))
{
    // Pour éviter la faille XSS
    $username = htmlspecialchars($_POST['username']);
    $question = htmlspecialchars($_POST['question']);
    $response = htmlspecialchars($_POST['reponse']);
    
    // On récupère nom, prenom , username et password de la table account dans $sqlQuery où le username == $username
    $sqlQuery = 'SELECT * FROM account WHERE username = ?';
    $check = $dbConnection->prepare($sqlQuery);
    $check ->execute(array($username));
    $data = $check->fetch();

    // On va verifier si le username existe dans la base
    if($check->rowCount() == 1)
{
        // S'il existe on verifie que le mot de passe est correct
        $isAnswerCorrect = (($question == $data['question']) AND ($response == $data['reponse']));

        if ($isAnswerCorrect) 
    {
        //Si oui on stocke les données de session et on renvoie vers la page forgot_password2
            $_SESSION['user'] = $data['username'];
            $_SESSION['lastname']= $data['nom'];
            $_SESSION['firstname']= $data['prenom'];
            header('Location: forgot_password2.php'); 

    }else header('Location: forgot_password.php?forgot_err=wrong_answer');
    }else header('Location: forgot_password.php?forgot_err=username');
}else header('Location: login.php');
