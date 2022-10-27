<?php
include $_SERVER['DOCUMENT_ROOT']."/somoim/common/dbConnect.php";

$inputCode = $_POST['inputCode'];
$phoneNumber = $_POST['phoneNumber'];

$sql = "SELECT code FROM certifyCode
        ORDER BY date DESC LIMIT 1";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
$resultCode = $row['0'];
// echo $resultCode;
echo $resultCode;

// echo $passwordCode.$email;


// // print_r($arr);

// $exist = mysqli_fetch_array($result);

// if($result == false){
//     echo mysqli_error($conn);
// } 

// //로그인-비밀번호가 맞지 않다면,
// if ($exist == 0) {
//     echo "0";
// } else {
// //로그인-비밀번호가 맞다면,
//     // echo $exist['seq'];

//     $arr = array(); // 배열 생성

//     while ($row = mysqli_fetch_array($result2)) {
   
//         $result_array = array(
//             "userSeq" => $row['seq'],
//             "userStatus" => $row['userStatus'],
//             "userName" => $row['userName']
//         );
//         $arr = $result_array;
//     }
   
//     echo json_encode($arr, JSON_UNESCAPED_UNICODE);
// }

mysqli_close($conn);
?>