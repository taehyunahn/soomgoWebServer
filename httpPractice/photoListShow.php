<?php

include $_SERVER['DOCUMENT_ROOT']."/common/dbConnect.php";

$userSeq = $_POST["userSeq"];
$expertSeq = $_POST["expertSeq"];
$response = array();
$arr = array();

// 회원 고유값(userSeq)에 해당되는 칼럼 정보(userName, userEmail)를 찾아서 배열에 담는다
$query = "SELECT * FROM photo WHERE id_expert = '$expertSeq'";
$result = mysqli_query($conn, $query);


while($row = mysqli_fetch_array($result)) {
    $result_array = array(
        'photoPath' => $row['photoPath'],
        'userSeq' => $row['id_userSeq'],
        'expertSeq' => $row['id_expert']
    );
    $arr[] = $result_array;
}

echo json_encode($arr, JSON_UNESCAPED_UNICODE);    


mysqli_close($conn);

?>
