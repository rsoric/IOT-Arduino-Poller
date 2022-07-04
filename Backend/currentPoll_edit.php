<?php


include_once "current_Poll.php";
include_once "sanitization.php";


if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if (isset($_POST['update'])) {

        $_currentPoll->updateCurrentPoll($_POST["currentPollId"]);
        header("Location: ../dashboard.php");
    }
}
