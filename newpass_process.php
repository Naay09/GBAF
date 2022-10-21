<?php
session_start();
require ('includes/db-connection.php');

    // On vérifie que le champ $_POST['password'] est présent

    if(isset($_POST['password']))
    {
        // Pour éviter la faille XSS
		$password = htmlspecialchars($_POST['password']);

        if(!empty($_POST['password']))
        { 
            $password = password_hash($password,PASSWORD_DEFAULT);

            $sqlUpdate = 'UPDATE account SET password= :password WHERE username= :username';
                $update = $dbConnection ->prepare($sqlUpdate);
                $update->execute(array(
                    'username' => $SESSION['user'],
                    'password' => $password,
                ));
                header('Location: index.php');

        }else header('Location: forgot_password2.php');
    }else header('Location: forgot_password.php');