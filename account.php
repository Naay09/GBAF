<?php
session_start();
if(!isset($_SESSION['id_user']))
    header('Location: login.php');
?>

<html>
    <head>
        <meta charset="utf-8">
        <title>GBAF - Paramètres du compte</title>
        <meta name="viewport" content="initial-scale=1.0, user-scalable=yes">
        <link rel="stylesheet" type="text/css" href="css/main.css">
    </head>
    <body>

    <?php require ('includes/header-on.php'); ?>
    <?php require ('includes/db-connection.php'); ?>

        <a href="index.php"><img class="return" src="img/return.png"></a>
        
           <main class="main-off">

           <?php

            $id = $_SESSION['id_user'];

            // On récupère tout le contenu de la table account dans $sqlQuery où le id_user = $id
            $sqlQuery = 'SELECT * FROM account WHERE id_user = ?';
            $accountQuery = $dbConnection->prepare($sqlQuery);
            $accountQuery->execute(array($id));
            $account = $accountQuery->fetch();


                if(isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['username']) && isset($_POST['question']) && isset($_POST['reponse']) && isset($_POST['password']))
                { 
                    // Pour éviter la faille XSS
                    $newName = htmlspecialchars($_POST['nom']);
                    $newFirstName = htmlspecialchars($_POST['prenom']) ;
                    $newUsername = htmlspecialchars($_POST['username']);
                    $password = htmlspecialchars($_POST['password']);
                    $newQuestion = htmlspecialchars($_POST['question']);
                    $newResponse = htmlspecialchars($_POST['reponse']);


                    // Check de la validité des infos
                    function checkForm($newUsername, $dbConnection) 
                    {
                        // Check longueur usernanme
                        if (strlen($newUsername) > 100) {
                            echo('<p>Pseudo trop long !</p>');
                            return false;
                        }	
                        // Check si username déjà pris
                        elseif(checkUser($dbConnection, $newUsername)){
                            echo('<p> Pseudo déjà pris !</p>');
                            return false;
                        }

                        // Si tout est bon on valide les modifs
                        echo('<p>Vos modifications ont bien été pris en compte !</p>');     
                        return true;
                    }

                    // Requête pour update les infos en BDD
                    function updateUser($dbConnection, $newName, $newFirstName, $newUsername, $newQuestion, $newResponse, $id)
                    {
                        $sqlUpdate = 'UPDATE account SET nom = :nom, prenom = :prenom, username = :username, question = :question, reponse = :reponse WHERE id_user= :id';
                        $update = $dbConnection->prepare($sqlUpdate);
                        $update->execute(array(
                            'nom' => $newName, 
                            'prenom' => $newFirstName, 
                            'username' => $newUsername, 
                            'question' => $newQuestion,
                            'reponse' => $newResponse,
                            'id' => $id
                        ));
                    }


                    // Check si le pseudo existe déjà dans la BDD
                    function checkUser($dbConnection, $newUsername)
                    {
                        $sqlQuery = 'SELECT * FROM account WHERE username = ?';
                        $upAccountQuery = $dbConnection->prepare($sqlQuery);
                        $upAccountQuery->execute(array($newUsername));
                        $upAccount = $upAccountQuery->fetch();
                        $usernameTaken = $upAccountQuery->rowCount();

                        if($usernameTaken == 1)
                        {
                            return true;
                        }

                        return false;
                    }

                    // Check si le formulaire est valide
                    $validForm = checkForm($newUsername, $dbConnection);
                    // Si c'est bon on update l'utilisateur en base de données
                    if($validForm)
                    {
                        updateUser($dbConnection, $newName, $newFirstName, $newUsername, $newQuestion, $newResponse, $id);
                    }

                }
           ?>
        
                <p>MON COMPTE</p>

                <?php 
                    // On récupère tout le contenu de la table account dans $sqlQuery où le id_user = $id
                    $sqlQuery = 'SELECT * FROM account WHERE id_user = ?';
                    $accountQuery = $dbConnection->prepare($sqlQuery);
                    $accountQuery->execute(array($id));
                    $account = $accountQuery->fetch();
                ?>
                
                <form action="account.php" method="post">
                    <div class="champs"> 
                        <label>Nom : <span class="asterisk">*</span></label>
                            <input type="text" value="<?php echo $account['nom'];?>" name="nom" required="">
                    </div>
                    <div class="champs">
                        <label>Prénom : <span class="asterisk">*</span></label>
                            <input type="text" value="<?php echo $account['prenom'];?>" name="prenom" required="">
                    </div>
                    <div class="champs">
                        <label>Nom d'utilisateur : <span class="asterisk">*</span></label>
                            <input type="text" value="<?php echo $account['username'];?>" name="username" required="">
                     </div>
                    <div class="champs">
                        <label>Mot de passe : <span class="asterisk">*</span></label>
                            <input type="password" placeholder="Entrer le mot de passe actuel pour confirmer les changements" name="password" required="">
                    </div>

                    <input type="submit" class="submit" name="update " value="ENREGISTRER LES MODIFICATIONS">
                </form>
              <p>Tout les champs avec un  <span class="asterisk">*</span> sont obligatoires !</p>
           </main>

     <?php require ('includes/footer.php'); ?>
     

</body>
</html>