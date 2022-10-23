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


                if(isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['username']) && isset($_POST['password']))
                { 
                    // Pour éviter la faille XSS
                    $newName = htmlspecialchars($_POST['nom']);
                    $newFirstName = htmlspecialchars($_POST['prenom']) ;
                    $newUsername = htmlspecialchars($_POST['username']);
                    $password = htmlspecialchars($_POST['password']);

                    
                    if ($newName != $account['nom'])
                    {
                    $sqlUpdate = 'UPDATE account SET nom= :nom WHERE id_user= :id';
                    $update = $dbConnection ->prepare($sqlUpdate);
                    $update->execute(array(
                        'id' => $id,
                        'nom' => $newName
                    ));
                    $ok = '<p>Vos modifications ont bien été pris en compte !</p>';
                    }

                    if ($newFirstName != $account['prenom'])
                    {
                    $sqlUpdate = 'UPDATE account SET prenom= :prenom WHERE id_user= :id';
                    $update = $dbConnection ->prepare($sqlUpdate);
                    $update->execute(array(
                        'id' => $id,
                        'prenom' => $newFirstName
                    ));
                    $ok = '<p>Vos modifications ont bien été pris en compte !</p>';
                    }
                    

                    if ($newUsername != $account['username'])
                    {
                    $sqlQuery = 'SELECT * FROM account WHERE username = ?';
                    $upAccountQuery = $dbConnection->prepare($sqlQuery);
                    $upAccountQuery->execute(array($newUsername));
                    $upAccount = $upAccountQuery->fetch();
                    $usernameTaken = $upAccountQuery->rowCount();

                    if($usernameTaken == 0)
                    {
                        if(strlen($newUsername) <= 100)
                        {
                        $sqlUpdate = 'UPDATE account SET username= :newUsername WHERE id_user= :id';
                        $update = $dbConnection ->prepare($sqlUpdate);
                        $update->execute(array(
                            'id' => $id,
                            'newUsername' => $newUsername
                        ));
                        $ok = '<p>Vos modifications ont bien été pris en compte !</p>';
                        }else $errLength = '<p>Pseudo trop long !</p>';
                    }else $errAlready = '<p> Pseudo déjà pris !</p>';
                    }
                }
           ?>
        
                <p>MON COMPTE</p>

                <?php 
                    if(isset($ok)) { echo $ok; }
                    if(isset($errLength)) { echo $errLength; } 
                    if(isset($errAlready)) { echo $errAlready; } 
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