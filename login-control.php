<?php
session_start();

require ('includes/db-connection.php');


    // On vérifie que $_POST['username'] et $_POST['password'] existent

    if(isset($_POST['username']) && isset($_POST['password']))
    {
        // Pour éviter la faille XSS
        $username = htmlspecialchars($_POST['username']);
        $password = htmlspecialchars($_POST['password']);
        
        // On récupère toutes les données de la table account dans $sqlQuery où le username == $username
        $sqlQuery = 'SELECT * FROM account WHERE username = ?';
        $check = $dbConnection->prepare($sqlQuery);
        $check ->execute(array($username));
        $data = $check->fetch();

        // On va verifier si le username existe dans la base
        if($check->rowCount() == 1)
       {
            // S'il existe on verifie que le mot de passe est correct
            $isPasswordCorrect = password_verify($password, $data['password']);

            if ($isPasswordCorrect) 
           {
            //Si oui on stocke les données de session et on renvoie vers la page d'accueil
                $_SESSION['id_user'] = $data['id_user'];
                $_SESSION['user'] = $data['username'];
                $_SESSION['lastname']= $data['nom'];
                $_SESSION['firstname']= $data['prenom'];
                header('Location: index.php'); 

          }else header('Location: login.php?login_err=password');
        }else header('Location: login.php?login_err=username');
    }else header('Location: login.php');

exit;