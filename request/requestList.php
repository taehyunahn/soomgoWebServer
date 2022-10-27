<?php

include $_SERVER['DOCUMENT_ROOT']."/common/dbConnect.php";

$userSeq = $_POST['userSeq'];


// 클라이언트에서 userSeq만 받으면, 무엇이든지 테이블을 연결해서 값을 찾을 수 있다 -- 응용 가능
// userSeq의 expert_id를 찾아내자
$sqlForInfo = "SELECT * FROM userInfo LEFT JOIN expertInfo ON userInfo.expert_id = expertInfo.expertId
                WHERE seq LIKE '$userSeq'";
$sqlActivate = mysqli_query($conn, $sqlForInfo);
$sqlresultRow = mysqli_fetch_array($sqlActivate);
$expertSeq = $sqlresultRow['expert_id'];
// 여러가지 값을 넣어서 응용할 수 있다. -- 끝

$result = array();
$result['data'] = array();

$sql = "SELECT * FROM request LEFT JOIN userInfo ON request.userIdWhoRequest = userInfo.seq
        WHERE selectedExpertId = '$expertSeq'";

// $sql = "SELECT * FROM expertInfo LEFT JOIN userInfo ON expertInfo.expertId = userInfo.expert_id
// WHERE exposeOnSearch LIKE '%yes%'";

$response = mysqli_query($conn, $sql);

// userIdWhoRequest를 갖고, 이름을 찾아보자

while($row = mysqli_fetch_array($response)) {
    $index['addressInfo'] = $row['addressInfo'];
    $index['selectedExpertId'] = $row['selectedExpertId'];
    $index['userIdWhoRequest'] = $row['userIdWhoRequest'];
    $index['serviceRequested'] = $row['serviceRequested'];
    $index['requestDate'] = $row['date'];
    $index['clientName'] = $row['userName'];

    array_push($result['data'], $index);

}

echo json_encode($result, JSON_UNESCAPED_UNICODE);
mysqli_close($conn);

?>

