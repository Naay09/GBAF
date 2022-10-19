<?php
session_start();

require ('includes/db-connection.php');


    // On vérifie que tous les champs $_POST existent

    if(isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['question']) && isset($_POST['reponse']))
    {
        // Pour éviter la faille XSS
        $lastname = htmlspecialchars($_POST['nom']);
		$firstname = htmlspecialchars($_POST['prenom']) ;
		$username = htmlspecialchars($_POST['username']);
		$password = htmlspecialchars($_POST['password']);
		$question = htmlspecialchars($_POST['question']);
		$response = htmlspecialchars($_POST['reponse']);
        
        // On récupère tous les champs de la table account dans $sqlQuery où le username == $username
        $sqlQuery = 'SELECT * FROM account WHERE username = ?';
        $check = $dbConnection->prepare($sqlQuery);
        $check ->execute(array($username));
        $data = $check->fetch();

        // On va verifier que le username n'existe pas déjà dans la base
        if($check->rowCount() == 0)
        {
            if(strlen($username) <= 100)
            {
                $password = password_hash($password,PASSWORD_DEFAULT);

                $sqlInsert = 'INSERT INTO account(nom, prenom, username, password, question, reponse) VALUES (:nom, :prenom, :username, :password, :question, :reponse)';
                $register = $dbConnection ->prepare($sqlInsert);
                $register->execute(array(
                    'nom' => $lastname,
                    'prenom' => $firstname,
                    'username' => $username,
                    'password' => $password,
                    'question' => $question,
                    'reponse' => $response
                ));
                header('Location: register.php?reg_alert=success');

            }else header('Location: register.php?reg_err=username_length');
        }else header('Location: register.php?reg_err=already_taken');
    }else header('Location: register.php');
    
exit;
    
?>