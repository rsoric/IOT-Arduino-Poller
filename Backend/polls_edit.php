<?php

include_once "polls.php";
include_once "current_poll.php";
include_once "questions.php";
include_once "sanitization.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $pollId = sanitizeInput($_POST["pollId"]);
    $pollName = sanitizeInput($_POST["pollName"]);

    if (isset($_POST['update'])) {

        echo("<pre>");
        print_r($_REQUEST);
        echo("</pre>");

        
        $_polls->updatePoll($pollId, $pollName);
        
        foreach ($_POST["questions"] as $question) {
            if($question["deleteQuestion"]=="true")
            {
                $_questions->deleteQuestion(sanitizeInput($question["questionId"]));
            }
            else{
                $_questions->updateQuestion(sanitizeInput($question["questionId"]),sanitizeInput($question["questionText"]));
            }
        }

        if(!empty($_POST["newQuestions"]))
        {
            foreach ($_POST["newQuestions"] as $question){
                $_questions->insertQuestion(sanitizeInput($question),$pollId);
            }
        }

        header("Location: ../dashboard_edit_poll.php?UpdateSuccess");
        
    }
    if (isset($_POST['delete'])){
        echo("<pre>");
        print_r($_REQUEST);
        echo("</pre>");

        $polls = $_currentPoll->getIDOfCurrentPoll();
        while ($poll = $polls->fetch())
        {
            if($poll['pollId']==$pollId)
            {
                header("Location: ../dashboard_edit_poll.php?DeleteWarning");
                return; 
            }
        }
        $_polls->deletePoll($pollId);
        header("Location: ../dashboard_edit_poll.php?DeleteSuccess");
    }
 
}
