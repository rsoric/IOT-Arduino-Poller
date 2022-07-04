<?php


include_once "current_Poll.php";
include_once "sanitization.php";


if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $currentPoll = sanitizeInput($_POST["currentPollId"]);

    if (isset($_POST['update'])) {

        error_reporting(E_ALL);
        ini_set('display_errors', 'on');
        
        try{
            $_currentPoll->updateCurrentPoll($currentPoll);
        }catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }

        
        //header("Location: ../dashboard.php");
    }
}
