<?php

if(isset($_GET["value"])) {
   $value = $_GET["value"]; // get value from HTTP GET

   $servername = "eu-cdbr-west-02.cleardb.net";
   $username = "b8100c5581c24b";
   $password = "2ab80845";
   $dbname = "test_table";

   // Create connection
   $conn = new mysqli($servername, $username, $password, $dbname);
   // Check connection
   if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
   }

   $sql = "INSERT INTO test_table (temp_value) VALUES ($value)";

   if ($conn->query($sql) === TRUE) {
      echo "New record created successfully";
   } else {
      echo "Error: " . $sql . " => " . $conn->error;
   }

   $conn->close();
} else {
   echo "temperature is not set";
}
?>
