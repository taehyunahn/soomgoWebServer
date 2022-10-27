<?php
    error_reporting(E_ALL);
    ini_set("display_errors", true); //에러확인용
?>

<?php

include $_SERVER['DOCUMENT_ROOT']."/somoim/common/dbConnect.php"; //DB서버연결

$address = $_POST["address"]; //모임 지역
$title = $_POST["title"]; // 모임 제목
$content = $_POST["content"]; // 모임 설명
$memberCount = $_POST["memberCount"]; // 모임 정원
$interest = $_POST["interest"]; // 모임 관심분야

$userSeq = $_POST["userSeq"]; // 로그인 사용자 고유번호
$fileCount = $_POST["fileCount"]; // 파일개수

$response = array(); //클라이언트에 보내기 위한 배열 형태 변수
$mainImage = ""; // 파일로 생성한 이미지 저장 주소를 담는 변수

// 이미지 파일 수정하여 파일개수가 1개 이상인 경우에만 동작
if ($fileCount != null){
    for($i=0; $i<$fileCount; $i++){
        $files = $_FILES['imageName'.$i];
        $srcName = $files['name']; //파일 이름
        $tmpName = $files['tmp_name']; //파일 임시이름
        $fileTypr = $files['type']; //파일 타입
        $fileSize = $files['size']; //파일 사이즈
    
        $filePath = "images/". date('Ymd_his'). $srcName; //파일을 저장할 위치 이름 지정
        move_uploaded_file($tmpName, $filePath); //클라이언트에서 전달받은 파일을 지정된 위치에 저장
        $filePathFull = "http://3.39.194.226/somoim/moimManage/".$filePath; // 이미지 파일 최종 저장 위치 URL
        $mainImage = $filePathFull; // 전역변수에 옮겨 담기
    }
}

// 이미지 파일의 서버 경로, 고수고유값, 회원고유값을 저장한다.
$sql = "INSERT INTO moim (leaderSeq, address, title, content, memberCount, interest, mainImage) 
VALUES ('$userSeq', '$address', '$title', '$content', '$memberCount', '$interest', '$mainImage')";
// mysqli_query($conn, $sql);

if ($conn->query($sql) === TRUE) {
$last_id = mysqli_insert_id($conn); // 방금 생성한 데이터의 고유값(seq)을 변수에 담는다. -> 모임의 고유값
$message = "Successfully Uploaded";
$success = "1"; // 성공한 경우 1 전달


// member 테이블에 현재 계정과 모임명을 추가한다

$sql2 = "INSERT INTO member (moimSeq, userSeq) VALUES ('$last_id', '$userSeq')";
if($conn->query($sql2) === TRUE){
    $message = "Successfully Uploaded + 멤버추가";
    $success = "1"; // 성공한 경우 1 전달
}


} else {
$message = "Error: " . $sql."<br>".$conn->error;
$success = "0"; // 실패한 경우 0 전달
}

$conn -> close();

$response["moimSeq"] = $last_id;
$response["message"] = $message;
$response["success"] = $success;
echo json_encode($response);





?>


