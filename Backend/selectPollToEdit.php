<?php


include_once "polls.php";
include_once "sanitization.php";


if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $selectedPollToEdit = sanitizeInput($_POST["selectedPollToEdit"]);

    if (isset($_POST['select'])) {
        header("Location: ../dashboard_edit_poll.php?PollID=".$selectedPollToEdit);
    }
}
