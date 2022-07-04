<?php

    include_once "polls.php";
    include_once "sanitization.php";
    include_once "questions.php";

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        //print_r($_POST);

        $pollName = sanitizeInput($_POST["pollName"]);
        $insertedPollID = $_polls->insertPoll($pollName);
        foreach($_POST["questions"] as $question)
        {
            $question_sanitized = sanitizeInput($question);
            $_questions->insertQuestion($question_sanitized,$insertedPollID);
        }

        header("Location: ../dashboard_add_poll.php");
    }

