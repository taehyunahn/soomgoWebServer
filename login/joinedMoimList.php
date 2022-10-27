<?php

include $_SERVER['DOCUMENT_ROOT']."/somoim/common/dbConnect.php";

$userSeq = $_POST['userSeq'];
// $userSeq = '92';

// member 테이블에 userSeq 칼럼이 계정의 고유값과 동일한 행의 moimSeq를 종합한다.

$sql = "SELECT moimSeq FROM member WHERE userSeq = '$userSeq'";
$result = mysqli_query($conn, $sql);

$i = 0;
$final = "";
while($row = mysqli_fetch_array($result)){
    
    // print_r($row);
    $peter = $row[0];
    // print_r($peter.'<br>');
    // print_r($i.'<br>');

    ${"test".$i} = $peter;
    $i++;

    $joinedMoimSeqList = $joinedMoimSeqList.$peter.';';
}


$arr = array(); // 배열 생성

$sql2 = "SELECT * FROM userInfo WHERE seq = '$userSeq'";
$result2 = mysqli_query($conn, $sql2);

// 클라이언트로 보낼 값 : meetupData, meetupTime, address, meetupSeq, moimSeq
while ($row = mysqli_fetch_array($result2)) {
    $result_array = array(
        "userName" => $row['userName'],
        "meetupTime" => $row['meetupTime'],
        "userProfileImage" => $row['userProfileImage'],
        "userIntro" => $row['userIntro'],
        "joinedMoimSeqList" => $joinedMoimSeqList

    );
    $arr = $result_array;
}


echo json_encode($arr, JSON_UNESCAPED_UNICODE);



// // // 클라이언트에서 전달받은 이메일과 비밀번호 값이 동일한 DB 정보를 선택하라는 명령
// // $sql = "SELECT * FROM userInfo WHERE userEmail = '$userEmail' AND userPassword = '$userPassword_hash'";
// $sql = "SELECT joinedMoimSeq FROM userInfo
//         WHERE seq = '$userSeq'";
// $result = mysqli_query($conn, $sql);

// if($result == false){
//     echo mysqli_error($conn);
// } else {
//     $arr = array();

//     while ($row = mysqli_fetch_array($result)){
//         $result_array = array(
//             "joinedMoimSeq" => $row['joinedMoimSeq']
//         );
//         $arr = $result_array;            
//     }

//     echo json_encode($arr, JSON_UNESCAPED_UNICODE);

// }
// mysqli_close($conn);

?>
