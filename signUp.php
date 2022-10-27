<?php

include $_SERVER['DOCUMENT_ROOT']."/common/dbConnect.php";

$userEmail = $_POST['userEmail'];
$userPassword = $_POST['userPassword'];
$userPassword_hash = hash("sha256", $userPassword);
$userName = $_POST['userName'];
$userOption = $_POST['userOption'];


$sql = "INSERT INTO userInfo (userEmail, userPassword, userName, userOption) VALUES ('$userEmail', '$userPassword_hash', '$userName', '$userOption')";




if ($conn->query($sql) ===TRUE) {
  $last_id = mysqli_insert_id($conn);
  // echo $last_id;


  $arr = array(); // 배열 생성

  $sql2 = "SELECT * FROM userInfo WHERE seq IN ('$last_id')";
  $result2 = mysqli_query($conn, $sql2);

  while ($row = mysqli_fetch_array($result2)) {
      $result_array = array(
          "userSeq" => $row['seq'],
          "userName" => $row['userName']
      );
      $arr = $result_array;
  }
 
  echo json_encode($arr, JSON_UNESCAPED_UNICODE);


} else {
  echo "Error: " . $sql."<br>".$conn->error;
}

$conn -> close();


?>
