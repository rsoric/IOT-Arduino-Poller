<?php 

    include_once "questions.php";
    include_once "functions.php";

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $questionId = sanitizeInput($_POST["questionId"]);
        $questionText = sanitizeInput($_POST["questionText"]);

        if(isset($_POST['delete']))
        {
            $_questions->deleteQuestion($albumID);
            header("Location: ../dashboard_database.php");
        }
        elseif(isset($_POST['update']))
        {
            $_questions->updateQuestion($questionId, $questionText);
            header("Location: ../dashboard_database.php");
        }
    }