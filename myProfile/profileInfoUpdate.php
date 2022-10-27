<?php
    error_reporting(E_ALL);
    ini_set("display_errors", true);
?>

<?php

include $_SERVER['DOCUMENT_ROOT']."/somoim/common/dbConnect.php";

$userSeq = $_POST["userSeq"];
$name = $_POST["name"];
$gender = $_POST["gender"];
$intro = $_POST["intro"];
$address = $_POST["address"];
$birthday = $_POST["birthday"];

$fileCount = $_POST["fileCount"];

$response = array();

// 이미지 파일 수정한 경우에만 동작
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
        $filePathFull = "http://3.39.194.226/somoim/myProfile/".$filePath;
    
        if(move_uploaded_file($tmpName, $filePath)){
            $successImage = true;
            $messageImage = "Successfully imageFile Uploaded";

            $sql = "UPDATE userInfo SET userProfileImage = '$filePathFull'
                    WHERE seq = '$userSeq'";

            if ($conn->query($sql) === TRUE) {
            $messageImageUpdate = "Successfully Image Updated";
            } else {
            $messageImageUpdate = "Error: " . $sql."<br>".$conn->error;
            }

        // echo "move_uploaded_file 성공"."<br><br>"; //파일이 이동됐는지 확인
        } else {
            $success = false;
            $message = "Error while uploading";
        };
    }
}

$sql = "UPDATE userInfo SET userName = '$name', 
                            userGender = '$gender', 
                            userIntro = '$intro', 
                            userAddress = '$address', 
                            userBirthday = '$birthday'
                        WHERE seq = '$userSeq'";

if ($conn->query($sql) === TRUE) {
    $message = "Successfully userInfo Updated";
    } else {
    $message = "Error: " . $sql."<br>".$conn->error;
    }

// $response["success"] = $success;
$response["message"] = $message;
// $response["successImage"] = $successImage;
// $response["messageImage"] = $messageImage;

// $response["messageImageUpdate"] = $messageImageUpdate;

$response["fileCount"] = $fileCount;
$response["userSeq"] = $userSeq;

echo json_encode($response);

$conn -> close();




?>
