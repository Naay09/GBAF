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
             // Stocke l'id de la page dans la variable $id
             $id = $_GET['id'];
            // Vérifie que $_GET['id'] est présent
            if(isset($id) && !empty($id))
            {
                // On récupère tout le contenu de la table acteurs dans $sqlQuery où l'id acteur == $_GET['id']
                $sqlQuery = 'SELECT * FROM acteur WHERE id_acteur = ?';
                $actorsQuery = $dbConnection->prepare($sqlQuery);
                $actorsQuery->execute(array($id));
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

                <?php
                    // On compte le nb de commentaires
                    $sqlQuery = 'SELECT COUNT(*) AS nb_post FROM post WHERE id_acteur = ?';
                    $postQuery = $dbConnection->prepare($sqlQuery);
                    $postQuery->execute(array($_GET['id']));

                    while ($nbPost = $postQuery->fetch())
                    {
                ?>           
                       <h3><?php echo $nbPost['nb_post'];?> COMMENTAIRES</h2>
                <?php
                    }      
                ?>       
                            <div class="reaction">

                            <?php
                                // On compte le nb de likes
                                $sqlQuery = 'SELECT COUNT(*) AS nb_likes FROM vote WHERE id_acteur = ? AND vote = 1';
                                $likes = $dbConnection->prepare($sqlQuery);
                                $likes->execute(array($_GET['id']));
                                $nbLikes = $likes->fetch();

                                 // On compte le nb de likes
                                 $sqlQuery = 'SELECT COUNT(*) AS nb_dislikes FROM vote WHERE id_acteur = ? AND vote = 0';
                                 $dislikes = $dbConnection->prepare($sqlQuery);
                                 $dislikes->execute(array($_GET['id']));
                                 $nbDislikes = $dislikes->fetch();

                            ?>

                                <a href="#new-comment" class="lien-new">NOUVEAU COMMENTAIRE</a>
                                <a href="vote.php?acteur=<?php echo $actor['id_acteur'];?>&amp;vote=1" class="reaction-btn like"><img src="img/like.png"></a><p><?php echo $nbLikes['nb_likes']; ?></p>
                                <a href="vote.php?acteur=<?php echo $actor['id_acteur'];?>&amp;vote=0" class="reaction-btn dislike" class="reaction-btn dislike"><img src="img/dislike.png"></a><p><?php echo $nbDislikes['nb_dislikes']; ?></p>
            
                            </div>

                </div>

                <div class="list-comment">

                <?php
                
                    $sqlQuery = 'SELECT post.id_post, post.id_user, account.prenom, post.post, post.date_add FROM post INNER JOIN account ON post.id_user = account.id_user WHERE id_acteur = ?';
                    $getPost = $dbConnection->prepare($sqlQuery);
                    $getPost->execute(array($_GET['id']));
             
                    while($post = $getPost->fetch())
                    {   

                ?>          
                       <article>
                           <h4><?php echo $post['prenom'];?></h4>
                           <p><?php echo $post['date_add'];?></p>
                           <p><?php echo $post['post'];?></p>
                       </article>
                <?php
                    }
                ?>
                </div>
                    

                <h4> AJOUTER UN COMMENTAIRE</h4>
                            
                <div id="new-comment">

                	<form action="post-process.php" method="POST">
                            
                        <textarea name="comment" placeholder="Votre commentaire..."></textarea><br>
                            <?php
                            if(isset($_GET['alert']))
                            {
                                $alert = htmlspecialchars($_GET['alert']);

                                switch($alert)
                                {
                                    case 'success' :
                                    ?>
                                    <p><strong>Merci !</strong> Votre commentaire a bien été ajouté !</p> 
                                    <?php
                                    break;

                                    case 'fail' :
                                    ?>
                                        <p><strong>Erreur</strong> Vous ne pouvez commenter qu'une seule fois !</p> 
                                        <?php
                                    break;
                                }
                            }
                            ?>
                        <input type="submit" value="POSTER" name="submit_post">
                        <input type="hidden" name="id_acteur" value="<?php echo $_GET['id']; ?>" />

                    </form>
                    
                </div>    

            </div>
                    
               
        </main>
        
    <?php require ('includes/footer.php'); ?>
    

    </body>
</html>