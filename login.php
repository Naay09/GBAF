<html lang="fr"><head>
        
        <meta charset="utf-8">
        <title>GBAF - Bienvenue sur l'extranet du GBAF</title>
        <link rel="stylesheet" type="text/css" href="css/main.css">
        
    </head>
    
    <body>
        
    <?php require ('includes/header-off.php'); ?>
        
        <main class="main-off">
            
            <p> Bienvenue sur l'extranet du GBAF </p>
            
            
                <form action="login.html" method="post">
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
            
            <a class="register" href="register.html">INSCRIPTION</a>
            
            <label>Tous les champs avec un  <span class="asterisk">*</span> sont obligatoires !</label><br>
            
        </main>
        
     <?php require ('includes/footer.php'); ?>
         

</body></html>