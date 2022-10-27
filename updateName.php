<?php

include $_SERVER['DOCUMENT_ROOT']."/common/dbConnect.php";

$userName = $_POST['userName'];
$userSeq = $_POST['userSeq'];

$sql = "UPDATE userInfo SET userName = '$userName' WHERE seq = $userSeq";

if ($conn->query($sql) ===TRUE) {
  echo $userName;
} else {
  echo "Error: " . $sql."<br>".$conn->error;
}

$conn -> close();


?>
