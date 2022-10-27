<?php

include $_SERVER['DOCUMENT_ROOT']."/common/dbConnect.php";

$userEmail = $_POST['userEmail'];
$userPassword = $_POST['userPassword'];
$userPassword_hash = hash("sha256", $userPassword);

// 클라이언트에서 전달받은 이메일과 비밀번호 값이 동일한 DB 정보를 선택하라는 명령
// $sql = "SELECT * FROM userInfo WHERE userEmail = '$userEmail' AND userPassword = '$userPassword_hash'";
$sql = "SELECT * FROM userInfo
        WHERE userEmail = '$userEmail' AND userPassword = '$userPassword_hash'";
$result = mysqli_query($conn, $sql);

//
$sql2 = "SELECT * FROM userInfo LEFT JOIN expertInfo ON userInfo.expert_id = expertInfo.expertId 
        WHERE userEmail IN ('$userEmail')";
$result2 = mysqli_query($conn, $sql2);

// print_r($arr);

$exist = mysqli_fetch_array($result);

if($result == false){
    echo mysqli_error($conn);
} 

//로그인-비밀번호가 맞지 않다면,
if ($exist == 0) {
    echo "0";
} else {
//로그인-비밀번호가 맞다면,
    // echo $exist['seq'];

    $arr = array(); // 배열 생성

    while ($row = mysqli_fetch_array($result2)) {
   
        $result_array = array(
            "userSeq" => $row['seq'],
            "userStatus" => $row['userStatus'],
            "userName" => $row['userName'],
            "resign" => $row['resign']
        );
        $arr = $result_array;
    }
   
    echo json_encode($arr, JSON_UNESCAPED_UNICODE);
}

mysqli_close($conn);

?>
