<?php

include $_SERVER['DOCUMENT_ROOT']."/somoim/common/dbConnect.php";

// $userEmail = $_POST['email'];
// $userPassword = $_POST['password'];

$userEmail = $_POST['email'];
$userPassword = $_POST['password'];
$userPassword_hash = hash("sha256", $userPassword);



// // 클라이언트에서 전달받은 이메일과 비밀번호 값이 동일한 DB 정보를 선택하라는 명령
// $sql = "SELECT * FROM userInfo WHERE userEmail = '$userEmail' AND userPassword = '$userPassword_hash'";
$sql = "SELECT * FROM userInfo
        WHERE userEmail = '$userEmail' AND userPassword = '$userPassword_hash'";
$result = mysqli_query($conn, $sql);

$sql2 = "SELECT * FROM userInfo
        WHERE userEmail IN ('$userEmail')";
$result2 = mysqli_query($conn, $sql2);

// print_r($arr);

if($result == false){
    echo mysqli_error($conn);
} else {
    $exist = mysqli_fetch_array($result);
    if ($exist == 0) {
        echo "0";
    } else {
        $arr = array();

        while ($row = mysqli_fetch_array($result2)){
            $result_array = array(
                "userSeq" => $row['seq'],
                "userName" => $row['userName'],
                "resign" => $row['resign']
            );
            $arr = $result_array;            
        }

        echo json_encode($arr, JSON_UNESCAPED_UNICODE);

    }
}
mysqli_close($conn);

?>
