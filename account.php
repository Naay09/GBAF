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
        
                       <p>MON COMPTE</p>
                       
                       <form method="post">
                           <div class="champs"> 
                        <label>Nom : <span class="asterisk">*</span></label>
                            <input type="text" value="S" name="nom" required="">
                        </div>
                        <div class="champs">
                        <label>Prénom : <span class="asterisk">*</span></label>
                            <input type="text" value="N" name="prenom" required="">
                        </div>
                        <div class="champs">
                        <label>Nom d'utilisateur : <span class="asterisk">*</span></label>
                            <input type="text" value="Naay" name="username" required="">
                        </div>
                        <div class="champs">
                        <label>Mot de passe : <span class="asterisk">*</span></label>
                            <input type="password" placeholder="Entrer le mot de passe actuel pour confirmer les changements" name="password" required="">
                        </div>
        
                           <input type="submit" class="submit" name="update " value="ENREGISTRER LES MODIFICATIONS">
                </form>
              <p>Tout les champs avec un  <span class="asterisk">*</span> sont obligatoire !</p>
           </main>

           <?php require ('includes/footer.php'); ?>
     

</body></html>