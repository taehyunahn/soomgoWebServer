<?php
$servername = "54.180.133.35";
$MySQLusername = "test";
$password = "1234";
$dbname = "soomgo";

// Create connection
$conn = mysqli_connect($servername, $MySQLusername, $password, $dbname);
mysqli_query($conn, 'SET NAMES utf8');


// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
?>