<?php

include $_SERVER['DOCUMENT_ROOT']."/common/dbConnect.php";

$targetdir = $_SERVER['DOCUMENT_ROOT']."/image";
$encodeImage = $_POST['encodeImage'];
$userSeq = $_POST['userSeq'];

$imagestore = rand()."_".time().".jpeg";
$targetdir = $targetdir."/".$imagestore;
file_put_contents($targetdir,base64_decode($encodeImage));
$final_imagestore = "http://54.180.133.35/image/".$imagestore;

$sql = "UPDATE userInfo SET userProfileImage = '$final_imagestore' WHERE seq = $userSeq";

$sql2 = "SELECT * FROM userInfo WHERE seq = '$userSeq'";
$result2 = mysqli_query($conn, $sql2);
$row = mysqli_fetch_array($result2);

// if (userProfileImage)

if ($conn->query($sql) ===TRUE) {
  echo $row['userProfileImage'];
} else {
  echo "Error: " . $sql."<br>".$conn->error;
}

$conn -> close();


?>
