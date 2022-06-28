<?php

    include_once "questions.php";
    include_once "functions.php";

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $questionText = sanitizeInput($_POST["questionText"]);

        $_questions->insertQuestion($questionText);
        header("Location: ../dashboard_database.php");
    }

