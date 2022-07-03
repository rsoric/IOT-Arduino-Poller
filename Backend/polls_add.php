<?php

    include_once "polls.php";
    include_once "functions.php";

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $pollDescription = sanitizeInput($_POST["pollDescription"]);

        $_polls->insertQuestion($pollDescription);
        header("Location: ../dashboard_add_poll.php");
    }

