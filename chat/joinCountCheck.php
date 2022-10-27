<?php

include $_SERVER['DOCUMENT_ROOT']."/common/dbConnect.php";
// include "./dbConnect.php";

$roomNumber = $_POST['roomNumber'];


$sql = "SELECT * FROM chat_rooms WHERE seq = '$roomNumber'";
$response = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($response);
echo $row['joinCount'];



mysqli_close($conn);

?>

