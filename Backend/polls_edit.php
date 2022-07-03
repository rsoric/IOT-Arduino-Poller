<?php 

    include_once "polls.php";
    include_once "functions.php";

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $pollId = sanitizeInput($_POST["pollId"]);
        $pollDescription = sanitizeInput($_POST["pollDescription"]);

        if(isset($_POST['delete']))
        {
            $_polls->deleteQuestion($pollId);
            header("Location: ../dashboard_database.php");
        }
        elseif(isset($_POST['update']))
        {
            $_polls->updateQuestion($pollId, $pollDescription);
            header("Location: ../dashboard_database.php");
        }
    }