<?php
session_start();

require ('includes/db-connection.php');

    // On vérifie que le champ $_POST['password'] est présent

    if(isset($_POST['newpassword']))
    {
        // Pour éviter la faille XSS
		$password = htmlspecialchars($_POST['password']);
        $pass_hash = password_hash($password,PASSWORD_DEFAULT);

            $sqlUpdate = 'UPDATE account SET password= :password WHERE username= :username';
                $update = $dbConnection ->prepare($sqlUpdate);
                
                $update->execute(array(
                    'password'=>$pass_hash,
                    'username'=>$_SESSION['user']
                ));

                header('Location: login.php');


    }else header('Location: forgot_password.php');