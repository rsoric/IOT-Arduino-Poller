<?php

include_once "Backend/pollInstances.php";
include_once "Backend/current_poll.php";
include_once "Backend/question_replies.php";
include_once "Backend/polls.php";

if(isset($_GET["values"],$_GET["ID"])) 
{
   //$temperature = $_GET["temperature"]; // get temperature value from HTTP GET
   $values = $_GET["values"];
   $currentPollID = $_GET["ID"];


   $arrayOfReplyValues = explode("|", $values);

   //$values = array_pop(explode("|", $values));

   $insertedPollInstanceID = $_pollInstances->insertPollInstance($_currentPoll->getIDOfCurrentPoll());

   $pollQuestions = $_polls->getPollQuestions($currentPollID);

   //print_r($pollQuestions['questionId']);

   for ($x = 0; $x <= count($pollQuestions['questionId']); $x++) {
      $_questionReplies->insertQuestionReply(
          $arrayOfReplyValues[$x],
          $pollQuestions['questionId'][$x],
          $insertedPollInstanceID
      );
   }
/*
   foreach ($arrayOfReplyValues as $value) {
      $_questionReplies->insertQuestionReply($value);
   }*/
}


?>
