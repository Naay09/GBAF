<?php
session_start();
if(!isset($_SESSION['user']))
    header('Location: login.php');
?>

<html lang="fr">
    
    <head>
        
        <meta charset="utf-8">
        <title>GBAF - Les acteurs</title>
        <meta name="viewport" content="initial-scale=1.0, user-scalable=yes">
        <link rel="stylesheet" type="text/css" href="css/main.css">
        
    </head>
    
    <body>
        
    <?php require ('includes/header-on.php'); ?>
    <?php require ('includes/db-connection.php'); ?>
        
        <main class="main">
            
            <div class="intro-actor">

            <?php
        // Vérifie que $_GET['id'] est présent
        if(isset($_GET['id']) && !empty($_GET['id']))
        {
            // Stocke l'id de la page dans la variable $id
            $id = ($_GET['id']);
             // On récupère tout le contenu de la table acteurs dans $sqlQuery où l'id acteur == $_GET['id']
             $sqlQuery = 'SELECT * FROM acteur WHERE id_acteur = ?';
             $actorsQuery = $dbConnection->prepare($sqlQuery);
             $actorsQuery->execute(array($_GET['id']));
             $actor = $actorsQuery->fetch();
             //print "<pre>";
             //print_r ($actors); 
             //die;
        }
        
    ?>

                <img src="<?php echo $actor['logo'];?>">
                <h2><br><?php echo $actor['acteur'];?><br></h2>
                <a href="#">Visiter le site de <?php echo $actor['acteur'];?></a><br>
                <p><?php echo nl2br($actor['description']) ;?></p>
                
            </div>
                                      
                   
            <div class="comment">
                       
                <div class="top-comment">
                         
                       <h3>2 COMMENTAIRES</h2>
                           
                           
                            <div class="reaction">

                                <a href="#new-comment" class="lien-new">NOUVEAU COMMENTAIRE</a>
                                <a href="#" class="reaction-btn"><img src="img/like.png"></a><p>2</p>
                                <a href="#" class="reaction-btn"><img src="img/dislike.png"></a><p>0</p>
                                                    
                            </div>

                </div>

                <div class="list-comment">
                           
                       <article>
                           
                           <h4>Paul</h4>
                           <p>29-09-2022 14:11:38</p>
                           <p>Je recommande.</p>
                           
                       </article>
                              
                       <article>
          
                           <h4>Patricia</h4>
                           <p>28-09-2022 10:04:18</p>
                           <p>Je recommande vivement cet acteur.</p>
                           
                       </article>
                              
                </div>

                <h4> AJOUTER UN COMMENTAIRE</h4>
                            
                <div id="new-comment">

                	<form method="POST">
                            
                        <textarea name="commentaire" placeholder="Votre commentaire..."></textarea><br>
                        <input type="submit" value="POSTER" name="submit_commentaire">

                    </form>
                    
                </div>    

            </div>
                    
               
        </main>
        
    <?php require ('includes/footer.php'); ?>
    

    </body>
</html>