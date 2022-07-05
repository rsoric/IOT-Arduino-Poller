<!DOCTYPE html>
<html>
<head>
<style>
table {
  width: 100%;
  border-collapse: collapse;
}

table, td, th {
  border: 1px solid black;
  padding: 5px;
}

th {text-align: left;}
</style>
</head>
<body>

<?php
$q = intval($_GET['q']);

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

$sql="SELECT * FROM question_replies 
INNER JOIN poll_instances
ON question_replies.pollInstanceId = poll_instances.pollInstanceId
WHERE poll_instances.pollId = '".$q."'";

error_reporting(E_ALL);
ini_set('display_errors', 'on');

$result = $conn->query($sql);

echo "<table>
<tr>
<th>Value</th>
</tr>";
while($row = mysqli_fetch_array($result)) {
  echo "<tr>";
  echo "<td>" . $row['value'] . "</td>";
  echo "</tr>";
}
echo "</table>";
mysqli_close($con);
?>
</body>
</html>