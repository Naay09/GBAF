<?php
session_start();
if(!isset($_SESSION['user']))
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

           $username = $_SESSION['user'];

                // On récupère tout le contenu de la table account dans $sqlQuery où le username = $_SESSION['user']
                $sqlQuery = 'SELECT * FROM account WHERE username = ?';
                $accountQuery = $dbConnection->prepare($sqlQuery);
                $accountQuery->execute(array($username));
                $account = $accountQuery->fetch();

           ?>
        
                <p>MON COMPTE</p>
                
                <form action="update_process.php" method="post">
                    <div class="champs"> 
                        <label>Nom : <span class="asterisk">*</span></label>
                            <input type="text" value="<?php echo $account['upnom'];?>" name="nom" required="">
                    </div>
                    <div class="champs">
                        <label>Prénom : <span class="asterisk">*</span></label>
                            <input type="text" value="<?php echo $account['upprenom'];?>" name="prenom" required="">
                    </div>
                    <div class="champs">
                        <label>Nom d'utilisateur : <span class="asterisk">*</span></label>
                            <input type="text" value="<?php echo $account['upusername'];?>" name="username" required="">
                     </div>
                    <div class="champs"> 
                        <label for="question">Question Secrète : <span class="asterisk">*</span></label>
                            <select class="question" name="upquestion">
                                <option selected="" disabled=""><?php echo $account['question'];?></option>
                                <option value="Quel est le nom de jeune fille de votre mère ?">Quel est le nom de jeune fille de votre mère ?</option>
                                <option value="Quel est le nom de votre ville natale ?">Quel est le nom de votre ville natale ?</option>
                                <option value="Quel est le nom de votre meilleur/e ami/e ?">Quel est le nom de votre meilleur/e ami/e ?</option>
                            </select>
                    </div>
                    <div class="champs"> 
                        <label>Réponse : <span class="asterisk">*</span></label>
                            <input type="text" value="<?php echo $account['reponse'];?>" name="upreponse" required="">
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