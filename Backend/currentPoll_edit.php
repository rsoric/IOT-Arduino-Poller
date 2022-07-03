<?php 

    include_once "currentPoll.php";
    include_once "functions.php";

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $currentPoll = sanitizeInput($_POST["currentPollId"];)
        $pollId = sanitizeInput($_POST["pollId"]);

        if(isset($_POST['update']))
        {
            $_currentPoll->updateCurrentPoll($currentPoll, $pollId);
            header("Location: ../dashboard_database.php");
        }
    }