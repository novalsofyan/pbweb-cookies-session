<?php
$servername = "localhost";
$username = "id16818617_novalsofyan";
$password = "Fe=e[!G6[6[Tb]#S";
$dbname = "id16818617_tugaslogin";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>