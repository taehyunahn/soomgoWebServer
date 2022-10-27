<?php
    error_reporting(E_ALL);
    ini_set("display_errors", true);
?>

<?php

include $_SERVER['DOCUMENT_ROOT']."/common/dbConnect.php";

$fileCount = $_POST["fileCount"];
$userSeq = $_POST["userSeq"];
$expertSeq = $_POST["expertSeq"];
$response = array();

$photoPathCount = $_POST["photoPathCount"];

// 1단계 : 기존 데이터를 모두 삭제한다
    $query1 = "DELETE FROM photo WHERE id_expert = '$expertSeq'";
    $result1 = mysqli_query($conn, $query1);


// 2단계 : 전달받은 이미지 경로를 DB 테이블에 저장한다.

for ($i = 0; $i < $photoPathCount; $i++){
    $photoPath = $_POST['photoPath'.$i];
    $sql3 = "INSERT INTO photo (photoPath, id_expert, id_userSeq, position) VALUES ('$photoPath', '$expertSeq', '$userSeq', '$i')";
    mysqli_query($conn, $sql3);    
}


// 3단계 : 전달받은 파일의 경로를 변경하고, DB 테이블에 저장한다

if ($fileCount != null){
    for($i=0; $i<$fileCount; $i++){
        $files = $_FILES['imageName'.$i];
        $srcName = $files['name']; //파일 이름
        $tmpName = $files['tmp_name']; //파일 임시이름
        $fileTypr = $files['type']; //파일 타입
        $fileSize = $files['size']; //파일 사이즈
    
        // echo "파일 이름 : $srcName <br>";
        // echo "파일 임시이름 : $tmpName <br>";
        // echo "파일 타입 : $fileTypr <br>";
        // echo "파일 사이즈 : $fileSize <br>";
    
        $filePath = "images/". date('Ymd_his'). $srcName;
        $filePathFull = "http://54.180.133.35/httpPractice/".$filePath;
    
        if(move_uploaded_file($tmpName, $filePath)){
            $success = true;
            $message = "Successfully Uploaded";
    
            // 이미지 파일의 서버 경로, 고수고유값, 회원고유값을 저장한다.
            $sql = "INSERT INTO photo (photoPath, id_expert, id_userSeq, position) VALUES ('$filePathFull', '$expertSeq', '$userSeq', '$i')";
            mysqli_query($conn, $sql);
    
        // echo "move_uploaded_file 성공"."<br><br>"; //파일이 이동됐는지 확인
        } else {
            $success = false;
            $message = "Error while uploading";
        };
    }

}




$response["userSeq"] = $userSeq;
$response["expertSeq"] = $expertSeq;

echo json_encode($response);

?>
