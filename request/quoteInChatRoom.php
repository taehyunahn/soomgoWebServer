<?php

include $_SERVER['DOCUMENT_ROOT']."/common/dbConnect.php";

$chat_room_seq = $_POST['chat_room_seq'];




$result = array();
$result['data'] = array();

// quote 테이블과 expertInfo 테이블을 JOIN 해라
// 지금 필요한 정보는? 현재 userID가 요청한 서비스가 무엇인지 알아야 한다
// 문제 : expertName이 요청서에 해당하는 고수가 아니라, 요청한 고객의 고수 고유값에 해당하는 expertName을 가져온다
// $sql = "SELECT * FROM quote LEFT JOIN expertInfo ON quote.userId = expertInfo.user_id
//  WHERE userId = '$userSeq'";

$sql = "SELECT * FROM quote 
        LEFT JOIN request ON quote.requestId = request.seq
        LEFT JOIN expertInfo ON request.selectedExpertId = expertInfo.expertId 
        LEFT JOIN userInfo ON request.userIdWhoRequest = userInfo.seq 
        WHERE chatRoomId = '$chat_room_seq'"; // 견적서 테이블에서 고객의 이름이 로그인 계정의 이름과 같은 행을 뽑는다.
$response = mysqli_query($conn, $sql);

// $sql = "SELECT * FROM request LEFT JOIN userInfo ON request.userIdWhoRequest = userInfo.seq
//         WHERE selectedExpertId = '$expertSeq'";


if ($response == TRUE) {

while($row = mysqli_fetch_array($response)) {

    $expertId = $row['expertId'];

    // review 테이블의 review 숫자를 구한다
    $sql3 = "SELECT COUNT(reviewId)
    FROM review
    WHERE id_expert =  '$expertId'";
    $result3 = mysqli_query($conn, $sql3);
    $row3 = mysqli_fetch_array($result3);
    $reviewCount = $row3['0'];


    // review 테이블의 reviewGrade의 평균을 구한다
    $sql4 = "SELECT AVG(reviewGrade)
    FROM review
    WHERE id_expert =  '$expertId'";
    $result4 = mysqli_query($conn, $sql4);
    $row4 = mysqli_fetch_array($result4);
    $reviewAverage = $row4['0'];
    if($reviewAverage === null){
        $reviewAverage === '0';
    }

    // 고수 ID를 사용해서, 해당 고수와 관련된 quote 테이블에 dealDone된 개수를 합계한다.
    $sql5 = "SELECT COUNT(dealDone)
    FROM quote LEFT JOIN request ON quote.requestId = request.seq
    WHERE dealDone = 'done' AND selectedExpertId = '$expertId'";
    $result5 = mysqli_query($conn, $sql5);
    $row5 = mysqli_fetch_array($result5);
    $hireCount = $row5['0'];


    $index['expertImage'] = $row['expertProfileImage'];
    $index['expertName'] = $row['expertName'];
    $index['price'] = $row['price'];
    $index['roomNumber'] = $row['chatRoomId'];
    $index['reviewAverage'] = $reviewAverage;
    $index['hireCount'] = $hireCount;
    $index['reviewCount'] = $reviewCount;

    array_push($result['data'], $index);

}

echo json_encode($result, JSON_UNESCAPED_UNICODE);

} else {
    echo "Error: " . $sql."<br>".$conn->error;

}

mysqli_close($conn);

?>

