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

   print_r("ID : ");

   print_r($currentPollID);

   print_r("!!!!!!!!!");

   $arrayOfReplyValues = explode("|", $values);

   //$values = array_pop(explode("|", $values));

   $insertedPollInstanceID = $_pollInstances->insertPollInstance($currentPollID);

   $pollQuestions = $_polls->getPollQuestions($currentPollID);

   $counter = 0;

   while ($pollQuestion = $pollQuestions->fetch())
   {
      $_questionReplies->insertQuestionReply(
         $arrayOfReplyValues[$counter],
         $pollQuestion['questionId'],
         $insertedPollInstanceID
      );

      $counter = $counter + 1;
   }

   /*
   for ($x = 0; $x <= count($pollQuestions['questionId']); $x++) {
      $_questionReplies->insertQuestionReply(
          $arrayOfReplyValues[$x],
          $pollQuestions['questionId'][$x],
          $insertedPollInstanceID
      );
   }*/


/*
   foreach ($arrayOfReplyValues as $value) {
      $_questionReplies->insertQuestionReply($value);
   }*/
}


?>
