<?php

include_once "polls.php";
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

        header("Location: ../dashboard_edit_poll.php");
        
    }
    else if (isset($_POST['delete'])){
        echo("<pre>");
        print_r($_REQUEST);
        echo("</pre>");

        $_polls->deletePoll($pollId);
        header("Location: ../dashboard_edit_poll.php");
    }
    echo("<pre>");
    print_r($_REQUEST);
    echo("</pre>");
}
