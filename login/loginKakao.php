<?php

include $_SERVER['DOCUMENT_ROOT']."/somoim/common/dbConnect.php";

$userKakaoId = $_POST['kakaoId'];
$userName = $_POST['kakaoName'];
$userProfileImage = $_POST['kakaoProfileImage'];

// 카카오톡 아이디가 있는지 확인하는 쿼리문
// $sql = "SELECT COUNT(userKakaoId) FROM userInfo WHERE userKakaoId = '$userKakaoId'";
$sql = "SELECT * FROM userInfo WHERE userKakaoId = '$userKakaoId'";
$result = mysqli_query($conn, $sql);
$exist = mysqli_fetch_array($result);

$response = array();

// sql문 정상 작동하는지 확인
if($result == false){
    echo mysqli_error($conn);
} 

if($exist != null) {
    $response["userSeq"] = $exist[0];
    
} else {
    $response["userSeq"] = '0';
}
    
echo json_encode($response, JSON_UNESCAPED_UNICODE);


// if($exist == 0) {
//     // // 카카오톡 정보 기반으로 회원가입을 진행하는 쿼리문
//     // $sql2 = "INSERT INTO userInfo (userEmail, userName, userProfileImage, userKakaoId) VALUES ('$userEmail', '$userName', '$userProfileImage', '$userKakaoId')";
//     // $result2 = mysqli_query($conn, $sql2);
//     // $last_id = mysqli_insert_id($conn);
//     // // echo $last_id;

//     // $arr = array(); // 배열 생성

//     // $sql3 = "SELECT * FROM userInfo WHERE seq IN ('$last_id')";
//     // $result3 = mysqli_query($conn, $sql3);
  
//     // while ($row = mysqli_fetch_array($result3)) {
//     //     $result_array = array(
//     //         "userSeq" => $row['seq'],
//     //         "userName" => $row['userName']
//     //     );
//     //     $arr = $result_array;
//     // }

//     $response["exist"] = "0";
//     $response["message"] = "카카오톡 아이디가 존재하지 않습니다";
//     echo json_encode($response, JSON_UNESCAPED_UNICODE);

    

// } else {
//     // echo $exist['seq'];
//     $userSeq = $exist['seq'];

//     $arr = array(); // 배열 생성

//     $sql4 = "SELECT * FROM userInfo WHERE seq IN ('$userSeq')";
//     $result4 = mysqli_query($conn, $sql4);
  
//     while ($row = mysqli_fetch_array($result4)) {
//         $result_array = array(
//             "userSeq" => $row['seq'],
//             "userName" => $row['userName']
//         );
//         $arr = $result_array;
//     }
   
//     echo json_encode($arr, JSON_UNESCAPED_UNICODE);

    
// }


mysqli_close($conn);



?>
