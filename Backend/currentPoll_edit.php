<?php


include_once "current_Poll.php";
include_once "sanitization.php";


if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $currentPoll = sanitizeInput($_POST["currentPollId"]);

    if (isset($_POST['update'])) {
        
        try{
            $_currentPoll->updateCurrentPoll($currentPoll);
        }catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }

        
        //header("Location: ../dashboard.php");
    }
}
