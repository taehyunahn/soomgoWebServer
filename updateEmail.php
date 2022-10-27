<?php

include $_SERVER['DOCUMENT_ROOT']."/common/dbConnect.php";

$userEmail = $_POST['userEmail'];
$userSeq = $_POST['userSeq'];

$sql = "UPDATE userInfo SET userEmail = '$userEmail' WHERE seq = $userSeq";

if ($conn->query($sql) ===TRUE) {
  echo $userEmail;
} else {
  echo "Error: " . $sql."<br>".$conn->error;
}

$conn -> close();


?>
