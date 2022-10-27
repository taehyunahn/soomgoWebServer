<?php
$servername = "3.39.194.226";
$MySQLusername = "peter";
$password = "peter225!@";
$dbname = "somoim";

// Create connection
$conn = mysqli_connect('localhost', $MySQLusername, $password, $dbname);
mysqli_query($conn, 'SET NAMES utf8');


// Check connection
if (!$conn) {
  die("DB 연결 실패 : " . mysqli_connect_error());
} else {
    // echo "DB 연결 성공";
}

?>