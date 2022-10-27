<?php

include $_SERVER['DOCUMENT_ROOT']."/common/dbConnect.php";

$age = $_POST['age'];
$how = $_POST['how'];
$day = $_POST['day'];
$schedule = $_POST['schedule'];
$gender = $_POST['gender'];
$addressInfo = $_POST['addressInfo'];
$question = $_POST['question'];
$selectedExpertId = $_POST['selectedExpertId']; //요청 받는 고수의 고유값
$userIdWhoRequest = $_POST['userIdWhoRequest']; //요청하는 고객의 고유값
$serviceRequested = $_POST['serviceRequested'];
$clientName = $_POST['clientName'];

$sql = "INSERT INTO request (age, how, day, schedule, gender, addressInfo, question, 
                              selectedExpertId, userIdWhoRequest, serviceRequested) 
        VALUES 
        ('$age', '$how', '$day', '$schedule', '$gender','$addressInfo', '$question', 
        '$selectedExpertId', '$userIdWhoRequest', '$serviceRequested')";



if ($conn->query($sql) ===TRUE) {
  // // $last_id = mysqli_insert_id($conn);
  // // echo $last_id;
  // // 현재 등록한 고수 고유값(id)를 변수에 담는다.
  // $last_id = mysqli_insert_id($conn);

  // // expertInfo 테이블에 고수를 등록하면, userInfo 테이블에도 해당 고수의 id값으로 업데이트하는 쿼리문
  // // $sql2 = "UPDATE userInfo SET expert_id = '$last_id' WHERE seq = $userSeq";
  // $sql2 = "UPDATE userInfo SET expert_id = '$last_id' WHERE seq = $userSeq";
  // $conn->query($sql2);

  // $sql3 = "UPDATE userInfo LEFT JOIN expertInfo ON userInfo.expert_id = expertInfo.expertId 
  //           SET expertName = '$userName' WHERE seq = $userSeq";
  // $conn->query($sql3);

  $last_id = mysqli_insert_id($conn); // 방금 전에 생성된 견적서의 seq

  echo $last_id;



} else {
  echo "Error: " . $sql."<br>".$conn->error;
}

$conn -> close();



?>


