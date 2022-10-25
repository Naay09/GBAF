<?php
session_start();
require ('includes/db-connection.php');
ini_set('display_errors', 1); ini_set('error_reporting', E_ALL);

if(isset($_POST['submit_post']))    
{
    $id_user=$_SESSION['id_user'];
    $id_actor=$_POST['id_acteur'];
   
    $sqlQuery = 'SELECT post FROM post WHERE id_acteur = :id_acteur AND id_user = :id_user';
    $postQuery = $dbConnection->prepare($sqlQuery);
    $postQuery->execute(array(
        'id_acteur' => $id_actor,
        'id_user' => $id_user));

    if ($postQuery->rowCount() == 0)
    {
        if(isset($_POST['comment']) AND !empty($_POST['comment']))
        {
            $post = htmlspecialchars($_POST['comment']);

            $sqlInsert = 'INSERT INTO post(id_user, id_acteur, date_add, post) VALUES (:id_user, :id_acteur, NOW(), :post)';
                $addPost= $dbConnection ->prepare($sqlInsert);
                $addPost->execute(array(
                    'id_user' => $id_user,
                    'id_acteur' => $id_actor,
                    'post' => $post
                ));
                header('Location:actor.php?id=' . $id_actor . '&alert=success');

        } else header('Location:actor.php?id=' . $id_actor);
    }else header('Location:actor.php?id=' . $id_actor . '&alert=fail');

} 