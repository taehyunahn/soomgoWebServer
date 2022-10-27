<?php

include $_SERVER['DOCUMENT_ROOT']."/common/dbConnect.php";

$userSeq = $_POST['userSeq'];

// 카카오톡 아이디가 있는지 확인하는 쿼리문
$sql = "SELECT * FROM userInfo LEFT JOIN expertInfo ON userInfo.expert_id = expertInfo.expertId 
        WHERE seq IN ('$userSeq')";
$result = mysqli_query($conn, $sql);

// sql문 정상 작동하는지 확인
if($result == false){
    echo mysqli_error($conn);
} 


$arr = array(); // 배열 생성

while($row = mysqli_fetch_array($result)) {
    $result_array = array(
        "userName" => $row['userName'],
        "userEmail" => $row['userEmail'],
        "userProfileImage" => $row['userProfileImage'],
        "userPhoneNumber" => $row['userPhoneNumber'],
        "expertId" => $row['expertId']
    );
    $arr = $result_array;
}

echo json_encode($arr, JSON_UNESCAPED_UNICODE);
print_r($arr);
mysqli_close($conn);


?>
