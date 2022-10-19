<html lang="fr">

    <head>
        
        <meta charset="utf-8">
        <title>GBAF - Inscription</title>
        <link rel="stylesheet" type="text/css" href="css/main.css">
        
    </head>
    
    <body>
        
    <?php require ('includes/header-off.php'); ?>

        <main class="main-off">
            
            
            <p> Inscription </p>

            <?php
                    if(isset($_GET['reg_err']))
                    {
                        $err = htmlspecialchars($_GET['reg_err']);

                        switch($err)
                        {
                            case 'username_length' :
                            ?>
                            <p><strong>Erreur</strong> Pseudo trop long !</p> 
                            <?php
                            break;

                            case 'already_taken' :
                            ?>
                                <p><strong>Erreur</strong> Pseudo déjà pris !</p> 
                                <?php
                            break;
                        }
                    }
            ?>

            <?php

                    if(isset($_GET['reg_alert']) && $_GET['reg_alert'] == "success")
                    {
                        $err = htmlspecialchars($_GET['reg_alert']);
                        ?>
                        <p>Inscription réussie !</p>
                        <?php
                        header('Location: login.php');
                    }
            ?>
            
            
                <form action="register-process.php" method="post">
                   <div class="champs">
                       <label>Nom : <span class="asterisk">*</span></label>
                        <input type="text" placeholder="Entrer votre nom" name="nom" required="">
                    </div>   
                    <div class="champs"> 
                        <label>Prénom : <span class="asterisk">*</span></label>
                            <input type="text" placeholder="Entrer votre prénom" name="prenom" required="">
                    </div>
                    <div class="champs">
                        <label>Nom d'utilisateur : <span class="asterisk">*</span></label>
                            <input type="text" placeholder="Entrer le nom d'utilisateur" name="username" required="">
                    </div>
                    <div class="champs">  
                        <label>Mot de passe : <span class="asterisk">*</span></label>
                        <input type="password" placeholder="Entrer le mot de passe" name="password" required="">
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
                   
                    <input type="submit" class="submit" name="register" value="VALIDER MON INSCRIPTION"><br>
                    
                </form>
            
            <a class="register" href="login.php">DEJA INSCRIT ?</a>
            
            
            <label>Tous les champs avec un  <span class="asterisk">*</span> sont obligatoires !</label><br>
            
        </main>
        
    <?php require ('includes/footer.php'); ?>


    </body>
 </html>