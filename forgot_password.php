<?php
session_start();
?>

<html lang="fr">
    
    <head>
        
        <meta charset="utf-8">
        <title>GBAF - Mot de passe oublié</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
        <link rel="stylesheet" type="text/css" href="css/main.css">
        
    </head>
    
    <body>
        
    <?php require ('includes/header-off.php'); ?>
    <?php require ('includes/db-connection.php'); ?>


        <main class="main-off">
            
            <h3> Mot de passe oublié ? </h3>

             
                <?php

            if(isset($_GET['forgot_err']))
            {
                $err = htmlspecialchars($_GET['forgot_err']);

                switch($err)
                {
                    case 'wrong_answer' :
                    ?>
                    <p><strong>Erreur</strong> Les données sont incorrectes !</p> 
                    <?php
                    break;

                    case 'username' :
                    ?>
                        <p><strong>Erreur</strong> Le nom d'utilisateur n'existe pas !</p> 
                        <?php
                    break;
                }
            }
            ?>
            
            
                <form action="forgot_process.php" method="post">
            
                    <div class="champs">
                        <label>Nom d'utilisateur : <span class="asterisk">*</span></label>
                            <input type="text" placeholder="Entrer le nom d'utilisateur" name="username" required="">
                    </div>

                    <div class="champs"> 
                        <label for="question">Question Secrète : <span class="asterisk">*</span></label>
                            <select class="question" name="question">
                                <option selected="" disabled="">Choissisez une question secrète</option>
                                <option value="Quel est le nom de jeune fille de votre mère ?">Quel est le nom de jeune fille de votre mère ?</option>
                                <option value="Quel est le nom de votre ville natale ?">Quel est le nom de votre ville natale ?</option>
                                <option value="Quel est le nom de votre meilleur/e ami/e ?">Quel est le nom de votre meilleur/e ami/e ?</option>
                            </select>
                    </div>
                    <div class="champs"> 
                        <label>Réponse : <span class="asterisk">*</span></label>
                            <input type="text" placeholder="Entrer votre réponse" name="reponse" required="">
                    </div>

                    <input type="submit" class="submit" name="forgot" value="VALIDER"><br>
                           
                </form>
            
            <a class="register" href="register.php">INSCRIPTION</a>
            <a class="register" href="login.php">DEJA INSCRIT ?</a>
            
            <label>Tous les champs avec un  <span class="asterisk">*</span> sont obligatoires !</label><br>
            
        </main>
        
        
     <?php require ('includes/footer.php'); ?>
    

    </body>
</html>