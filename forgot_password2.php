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

        <a href="forgot_password.php"><img class="return" src="img/return.png"></a>

        <main class="main-off">
            
            <h3> Nouveau mot de passe </h3>
            
            
                <form action="newpass_process.php" method="post">
            
                    <div class="champs">
                        <label>Mot de passe : <span class="asterisk">*</span></label>
                            <input type="password" placeholder="Entrer le nouveau mot de passe" name="password" required="">
                    </div>

                    <input type="submit" class="submit" name="forgot" value="VALIDER"><br>
                           
                </form>
            
            
            <label>Tous les champs avec un  <span class="asterisk">*</span> sont obligatoires !</label><br>
            
        </main>
        
        
    <?php require ('includes/footer.php'); ?>
    
    </body>
 </html>