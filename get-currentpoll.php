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
SELECT questionText
FROM questions
INNER JOIN currentpoll
ON questions.pollId = currentpoll.currentPollId;
";

error_reporting(E_ALL);
ini_set('display_errors', 'on');

$result = $conn->query($sql);
if ($result->num_rows > 0) {
   // output data of each row
   while($question = $result->fetch_assoc()) {
     //echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
     echo $question['questionText']." ";
   }
 } else {
   echo "0 results";
 }
/*
$stmt = $conn->prepare($sql);
try {
   $stmt->execute();
   $stmt->setFetchMode(PDO::FETCH_ASSOC);
   $questions = $stmt->fetch();
   while ($question = $questions->fetch()){
      echo $question['questionText'];
   }
} catch (Exception $e) {
   echo $e->getMessage();*/





$conn->close();
