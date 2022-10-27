<?php
    error_reporting(E_ALL);
    ini_set("display_errors", true); //에러확인용
?>

<?php

include $_SERVER['DOCUMENT_ROOT']."/somoim/common/dbConnect.php"; //DB서버연결

$moimSeq = $_POST["moimSeq"]; //
$userSeq = $_POST["userSeq"]; //

$response = array(); //클라이언트에 보내기 위한 배열 형태 변수

$sql = "INSERT INTO member (moimSeq, userSeq) 
                    VALUES ('$moimSeq', '$userSeq')";


$joinedMoimSeqList = "";

if ($conn->query($sql) === TRUE) {
    $message = "Successfully 모임 목록에서 추가";
    $success = "1"; // 성공한 경우 1 전달

    // 현재 계정이 멤버로 존재하는 모임 고유값 목록을 하나의 변수에 담는다 → $joinedMoimSeqList
        $sql2 = "SELECT moimSeq FROM member WHERE userSeq = '$userSeq'";
        $result2 = mysqli_query($conn, $sql2);

        $i = 0;
        $final = "";
        while($row2 = mysqli_fetch_array($result2)){
            
            // print_r($row);
            $peter = $row2[0];
            // print_r($peter.'<br>');
            // print_r($i.'<br>');

            ${"test".$i} = $peter;
            $i++;

            $joinedMoimSeqList = $joinedMoimSeqList.$peter.';';
        }


} else {
$message = "Error: " . $sql."<br>".$conn->error;
$success = "0"; // 실패한 경우 0 전달
}


// $updatedMyRoom_id = str_replace($currentRoom_id, "", $currentMyRoom_id);


$conn -> close();

$response["message"] = $message;
$response["success"] = $success;
$response["joinedMoimSeqList"] = $joinedMoimSeqList;

echo json_encode($response, JSON_UNESCAPED_UNICODE);







?>


