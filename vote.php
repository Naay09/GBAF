<?php
//session_start();
require ('includes/db-connection.php');
ini_set('display_errors', 1); ini_set('error_reporting', E_ALL);

$id_user=$_GET['id_user'];
$id_actor=$_GET['id_actor'];
$vote=$_GET['vote'];
//echo json_encode ('success'); die;

   // On compte le nb de vote
   $sqlQuery = 'SELECT COUNT(*) AS nb_vote FROM vote WHERE id_acteur = ? AND id_user = ?';
   $voteQuery = $dbConnection->prepare($sqlQuery);
   $voteQuery->execute(array($id_actor, $id_user));
   $nbVote = $voteQuery->fetch();

   $nbVoteUser = $nbVote['nb_vote'];

    $response = [];

   if ($nbVoteUser == 0)
   {
        $sqlInsert = 'INSERT INTO vote(id_user, id_acteur, vote) VALUES (:id_user, :id_acteur, :vote)';
        $addVote= $dbConnection ->prepare($sqlInsert);
        $addVote->execute(array(
            'id_user' => $id_user,
            'id_acteur' => $id_actor,
            'vote' => $vote
        ));
          // On compte le nb de likes/dislikes
          $sqlQuery = 'SELECT COUNT(*) AS nb_vote FROM vote WHERE id_acteur = ? AND vote = ?';
          $newVoteQuery = $dbConnection->prepare($sqlQuery);
          $newVoteQuery->execute(array($id_actor, $vote));
          $newVote = $newVoteQuery->fetch();


        $response['status']='ok';
        $response['vote']=$newVote;
   }else {
        $response['status']='ko';
   }

   echo json_encode ($response); die;