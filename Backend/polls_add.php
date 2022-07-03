<?php

    include_once "polls.php";
    include_once "sanitization.php";

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $pollName = sanitizeInput($_POST["pollName"]);

        $_polls->insertQuestion($pollName);
        header("Location: ../dashboard_add_poll.php");
    }

