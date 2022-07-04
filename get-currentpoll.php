<?php
$servername = "eu-cdbr-west-02.cleardb.net";
$username = "b8100c5581c24b";
$password = "2ab80845";
$dbname = "heroku_526e4c652212ab8";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
}

$sql = "
SELECT pollName
FROM polls
INNER JOIN currentpoll
ON polls.PollId = currentpoll.currentPollId;
";

if ($result = $conn->query($sql) === TRUE) {
   echo "Result: ".$result['pollName'];
} else {
   echo "Error: " . $sql . " => " . $conn->error;
}

$conn->close();
