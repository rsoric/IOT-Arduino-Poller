<?php


include_once "current_Poll.php";
include_once "sanitization.php";


if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $currentPoll = sanitizeInput($_POST["currentPollId"]);

    if (isset($_POST['update'])) {

        $_currentPoll->updateCurrentPoll($currentPoll);
        header("Location: ../dashboard.php");
    }
}
