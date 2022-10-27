<?php

include $_SERVER['DOCUMENT_ROOT']."/common/dbConnect.php";

$expertService = $_POST['cb_1'].'-'.$_POST['cb_2'].'-'.$_POST['cb_3'].'-'.$_POST['cb_4'];
$expertAddress = $_POST['address'];
$expertGender = $_POST['gender'];
$expertPhoneNumber = $_POST['phoneNumber'];
$userSeq = $_POST['userSeq'];
$userName = $_POST['userName'];


// 고수등록할 때, 프로필 사진이 고수 프로필 사진에도 저장되도록 급하게 만듬 - 시작
$sql99 = "SELECT * FROM userInfo WHERE seq = '$userSeq'";
$result = mysqli_query($conn, $sql99);
$row = mysqli_fetch_array($result);
$userProfileImage = $row['userProfileImage'];
// 끝

$sql = "INSERT INTO expertInfo (expertService, 
                            expertAddress, expertGender, expertPhoneNumber, user_id, expertProfileImage) 
        VALUES 
        ('$expertService', 
         '$expertAddress', '$expertGender', '$expertPhoneNumber', '$userSeq', '$userProfileImage')";



if ($conn->query($sql) ===TRUE) {
  // $last_id = mysqli_insert_id($conn);
  // echo $last_id;
  // 현재 등록한 고수 고유값(id)를 변수에 담는다.
  $last_id = mysqli_insert_id($conn);

  // expertInfo 테이블에 고수를 등록하면, userInfo 테이블에도 해당 고수의 id값으로 업데이트하는 쿼리문
  // $sql2 = "UPDATE userInfo SET expert_id = '$last_id' WHERE seq = $userSeq";
  $sql2 = "UPDATE userInfo SET expert_id = '$last_id' WHERE seq = $userSeq";
  $conn->query($sql2);

  $sql3 = "UPDATE userInfo LEFT JOIN expertInfo ON userInfo.expert_id = expertInfo.expertId 
            SET expertName = '$userName' WHERE seq = $userSeq";
  $conn->query($sql3);

  echo "성공했습니다";



} else {
  echo "Error: " . $sql."<br>".$conn->error;
}

$conn -> close();


?>
