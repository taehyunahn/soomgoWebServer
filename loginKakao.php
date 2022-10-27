<?php

include $_SERVER['DOCUMENT_ROOT']."/common/dbConnect.php";

$userName = $_POST['userName'];
$userEmail = $_POST['userEmail'];
$userKakaoId = $_POST['userKakaoId'];
$userProfileImage = $_POST['userProfileImage'];

// 카카오톡 아이디가 있는지 확인하는 쿼리문
$sql = "SELECT * FROM userInfo WHERE userKakaoID IN ('$userKakaoId')";
$result = mysqli_query($conn, $sql);
$exist = mysqli_fetch_array($result);


// sql문 정상 작동하는지 확인
if($result == false){
    echo mysqli_error($conn);
} 

if($exist == 0) {
    // 카카오톡 정보 기반으로 회원가입을 진행하는 쿼리문
    $sql2 = "INSERT INTO userInfo (userEmail, userName, userProfileImage, userKakaoId) VALUES ('$userEmail', '$userName', '$userProfileImage', '$userKakaoId')";
    $result2 = mysqli_query($conn, $sql2);
    $last_id = mysqli_insert_id($conn);
    // echo $last_id;

    $arr = array(); // 배열 생성

    $sql3 = "SELECT * FROM userInfo WHERE seq IN ('$last_id')";
    $result3 = mysqli_query($conn, $sql3);
  
    while ($row = mysqli_fetch_array($result3)) {
        $result_array = array(
            "userSeq" => $row['seq'],
            "userName" => $row['userName']
        );
        $arr = $result_array;
    }
   
    echo json_encode($arr, JSON_UNESCAPED_UNICODE);

    

} else {
    // echo $exist['seq'];
    $seq = $exist['seq'];

    $arr = array(); // 배열 생성

    $sql4 = "SELECT * FROM userInfo WHERE seq IN ('$seq')";
    $result4 = mysqli_query($conn, $sql4);
  
    while ($row = mysqli_fetch_array($result4)) {
        $result_array = array(
            "userSeq" => $row['seq'],
            "userName" => $row['userName']
        );
        $arr = $result_array;
    }
   
    echo json_encode($arr, JSON_UNESCAPED_UNICODE);

    
}

mysqli_close($conn);


// 카카오톡 아이디가 DB에 존재하는지 확인

// 1) 존재하지 않는다면, 회원가입을 하는 sql문 실행 -> 이메일, 이름, 프로필사진, 카카오톡 아이디 등록
// if ($exist == 0) {

//     if ($conn->query($sql2) ===TRUE) {
//         $row = mysqli_fetch_array($result);
//         echo $row['seq'];

//         // 여기서 userSeq 값을 클라이언트로 보내줄 수 있어야 한다.... 새로운 query를 써야 할까?
//       } else {
//         echo "Error: " . $sql."<br>".$conn->error;
//       }
      
//     //   $conn -> close();


// } else {
//     // 2) 존재한다면, 카카오톡 정보 기반으로 회원가입 진행 후 끝. userSeq만 전달함.

//     echo $exist['seq'];


// }

// mysqli_close($conn);

// $statement = mysqli_prepare($conn, "SELECT userEmail, userPassword FROM userInfo WHERE userEmail = ? AND userPassword = ?");
// mysqli_stmt_bind_param($statement, "ss", $userEmail, $userPassword_hash);
// mysqli_stmt_execute($statement);

// mysqli_stmt_bind_result($statement, $userEmail, $userPassword_hash);

// $response = array();
// $response["success"] = false;

// while(mysqli_stmt_fetch($statement)) {
//     $response["success"] = true;
//     $response["userEmail"] = $userEmail;
//     $response["userPassword"] = $userPassword_hash;
// }

// echo json_encode($arr);


// print_r($member);
// if($member==0){
//     echo 1;
// } else {
//     echo $member['userName'];
// }
// $member = mysqli_fetch_array($result);
// print_r($member);

// if($member==0) {
//     echo 1;
// } else {
//     echo $member['userName'];
//     exit();
// }

// $conn -> close();



?>
