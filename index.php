<?php
session_start();
if(!isset($_SESSION['id_user']))
    header('Location: login.php');
?>

<!DOCTYPE html>

<html lang="fr">
   
<head>
        
        <meta charset="utf-8">
        <title>GBAF - Accueil</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
        <link rel="stylesheet" type="text/css" href="css/main.css">
        
    </head>
    
    <body>
        
    <?php require ('includes/header-on.php'); ?>
    <?php require ('includes/db-connection.php'); ?>
        
        <main class="main">
            <div class="intro">
                
            <h1>Groupement Banque Assurance Français<br><br></h1>
            <p><strong>Le GBAF est une fédération représentant les 6 grands groupes français :</strong><br><br>
            BNP Paribas - BPCE - Crédit Agricole - Crédit Mutuel-CIC - Société Générale - La Banque Postale.<br><br>
            
            C'est le représentant de la profession bancaire et des assureurs sur tous  les axes de la réglementation financière française. <br>
            Sa mission est de promouvoir l'activité bancaire à l’échelle nationale. <br> C’est aussi un interlocuteur privilégié des pouvoirs publics.<br><br>

            Cet extranet a pour but de répertorier un grand nombre d’informations sur les partenaires et acteurs du groupe ainsi que sur les produits et services  bancaires et financiers.<br><br>
            </p>

           <img src="img/banner.jpg" alt="banner">
              </div>     
              <div class="actor-list">
               
               <h2>Acteurs et partenaires</h2>
                <p> Présentation de la liste des différents acteurs du système bancaire français </p>

            <?php

            // On récupère tout le contenu de la table acteurs
            $sqlQuery = 'SELECT * FROM acteur';
            $actorsQuery = $dbConnection->prepare($sqlQuery);
            $actorsQuery->execute();
            $actors = $actorsQuery->fetchAll();

            // On affiche les infos de chaque acteur un à un

            foreach ($actors as $actor) {
            ?>
            <article>
                
                <img src="<?php echo $actor['logo']; ?>" alt="logo-acteur">

                <div class="content">
                    <h3><?php echo $actor['acteur'];?></h3>
                    <p><?php echo substr ($actor['description'], 0, 130);?>...</p>
                </div>

                <a href="actor.php?id=<?php echo $actor['id_acteur'];?>">Lire la suite</a>
                                
            </article>

            <?php
            }
            ?>
               
        </main>
        
    <?php require ('includes/footer.php'); ?>
    
    
    </body>
</html>