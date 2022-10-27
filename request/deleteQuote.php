<?php

include $_SERVER['DOCUMENT_ROOT']."/common/dbConnect.php";

$quoteId = $_POST['quoteId'];
$chatroomId = $_POST['chatroomId'];

$sql = "DELETE FROM quote WHERE seq = '$quoteId'";
$result = mysqli_query($conn, $sql);

$sql2 = "DELETE FROM chat_rooms WHERE seq = '$chatroomId'";
$result2 = mysqli_query($conn, $sql2);

if($result) {
  if($result2) {
    echo "삭제 성공했습니다";
  } else {
    echo "Error: " . $sql."<br>".$conn->error;
  }
} else {
  echo "Error: " . $sql."<br>".$conn->error;
}



$conn -> close();


?>
