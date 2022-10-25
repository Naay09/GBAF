<?php
session_start();
require ('includes/db-connection.php');
ini_set('display_errors', 1); ini_set('error_reporting', E_ALL);

$id_user=$_SESSION['id_user'];
$id_actor=$_GET['acteur'];
$vote=$_GET['vote'];

   // On compte le nb de vote
   $sqlQuery = 'SELECT COUNT(*) AS nb_vote FROM vote WHERE id_acteur = ? AND id_user = ?';
   $voteQuery = $dbConnection->prepare($sqlQuery);
   $voteQuery->execute(array($id_actor, $id_user));
   $nbVote = $voteQuery->fetch();

   $nbVoteUser = $nbVote['nb_vote'];

   if ($nbVoteUser == 0)
   {
        $sqlInsert = 'INSERT INTO vote(id_user, id_acteur, vote) VALUES (:id_user, :id_acteur, :vote)';
        $addVote= $dbConnection ->prepare($sqlInsert);
        $addVote->execute(array(
            'id_user' => $id_user,
            'id_acteur' => $id_actor,
            'vote' => $vote
        ));

        header('Location:actor.php?id=' . $id_actor);
   }else header('Location:actor.php?id=' . $id_actor);