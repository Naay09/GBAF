<html lang="fr">
    
    <head>
        
        <meta charset="utf-8">
        <title>GBAF - Bienvenue sur l'extranet du GBAF</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
        <link rel="stylesheet" type="text/css" href="css/main.css">
        
    </head>
    
    <body>
        
    <?php require ('includes/header-off.php'); ?>
        
        <main class="main-off">
            
            <p> Bienvenue sur l'extranet du GBAF </p>
            
            <?php
                    if(isset($_GET['login_err']))
                    {
                        $err = htmlspecialchars($_GET['login_err']);

                        switch($err)
                        {
                            case 'password' :
                            ?>
                                <p><strong>Erreur</strong> Mot de passe incorrect !</p>
                            <?php
                            break;

                            case 'username' :
                            ?>
                                <p><strong>Erreur</strong> Utilisateur introuvable !</p>
                            <?php
                            break;
                        }
                    }
            ?>
            
                <form action="login-control.php" method="post">
                   <div class="champs">        
                    <label>Nom d'utilisateur : <span class="asterisk">*</span></label><br>
                    <input type="text" name="username" placeholder="Dupont" required=""><br>
                   </div>   
                    <div class="champs">
                    <label>Mot de passe : <span class="asterisk">*</span></label><br>
                    <input type="password" name="password" placeholder="***********" required=""><br>
                    </div>       
                    <a href="forgot_password.html">Mot de passe oublié ?</a>
                   
                    <input type="submit" class="submit" value="CONNEXION"><br>
                           
                </form>
            
            <a class="register" href="register.php">INSCRIPTION</a>
            
            <label>Tous les champs avec un  <span class="asterisk">*</span> sont obligatoires !</label><br>
        </main>
        
    <?php require ('includes/footer.php'); ?>
    

    </body>
</html>