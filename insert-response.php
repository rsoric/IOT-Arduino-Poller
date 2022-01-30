<?php

if(isset($_GET["q1"],$_GET["q2"],$_GET["q3"])) {
   //$temperature = $_GET["temperature"]; // get temperature value from HTTP GET
   $q1 = $_GET["q1"];
   $q2 = $_GET["q2"];
   $q3 = $_GET["q3"];
   $timeOfPolling = date();

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

   $sql = "INSERT INTO responses (q1, q2, q3, timeOfPolling) VALUES ($q1, $q2, $q3,$timeOfPolling)";

   if ($conn->query($sql) === TRUE) {
      echo "New record created successfully";
   } else {
      echo "Error: " . $sql . " => " . $conn->error;
   }

   $conn->close();
} else {
   echo "Responses are not set";
}
?>

