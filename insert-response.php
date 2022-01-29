<?php

if(isset($_GET["q1"] && isset($_GET["q2"] && isset($_GET["q3"])) {
   //$temperature = $_GET["temperature"]; // get temperature value from HTTP GET
   $q1 = $_GET["q1"];
   $q2 = $_GET["q2"];
   $q3 = $_GET["q3"];

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

   $sql = "INSERT INTO responses (q1, q2, q3) VALUES ($q1, $q2, $q3)";

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

