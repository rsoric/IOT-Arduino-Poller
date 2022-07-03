<?php

    include_once "questions.php";
    include_once "functions.php";

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $questionText = sanitizeInput($_POST["questionText"]);
        $pollId = sanitizeInput($_POST["pollId"]);

        $_questions->insertQuestion($questionText, $pollId);
        header("Location: ../dashboard_database.php");
    }

