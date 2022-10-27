<?php
    error_reporting(E_ALL);
    ini_set("display_errors", true);
?>

<?php

include $_SERVER['DOCUMENT_ROOT']."/somoim/common/dbConnect.php";

$name = $_POST["name"];
$email = $_POST["email"];
$password = $_POST["password"];
$password_hash = hash("sha256", $password);

$gender = $_POST["gender"];
$phoneNumber = $_POST["phoneNumber"];
$intro = $_POST["intro"];
$address = $_POST["address"];
$birthday = $_POST["birthday"];

$fileCount = $_POST["fileCount"];
$kakaoProfileImage = $_POST["kakaoProfileImage"];
$kakaoId = $_POST["kakaoId"];


$response = array();

$profileImage = "";

// 프로필 사진을 선택해서 파일을 보낸 경우
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
        $profileImage = "http://54.180.115.147/somoim/signUp/".$filePath;
    
        if(move_uploaded_file($tmpName, $filePath)){
            $successImageUpload = true;
            $messageImageUpload = "Successfully Uploaded";

        // echo "move_uploaded_file 성공"."<br><br>"; //파일이 이동됐는지 확인
        } else {
            $successImageUpload = false;
            $messageImageUpload = "Error while uploading";
        };
    }
}

if($kakaoProfileImage != null) {
    $profileImage = $kakaoProfileImage;
    $kakaoImageUpdate = "카카오 프로필 사진으로 업데이트 성공";
    $response["kakaoImageUpdate"] = $kakaoImageUpdate;
}

// // // 이미지 파일의 서버 경로, 고수고유값, 회원고유값을 저장한다.
$sql = "INSERT INTO userInfo (userProfileImage, userName, userEmail, userPassword, 
userGender, userPhoneNumber, userIntro, userAddress, userBirthday, userKakaoId) 
VALUES ('$profileImage', '$name', '$email', '$password_hash',
'$gender', '$phoneNumber', '$intro', '$address', '$birthday', '$kakaoId')";
// mysqli_query($conn, $sql);

if ($conn->query($sql) === TRUE) {
$last_id = mysqli_insert_id($conn);
$messageSQL = "Successfully Uploaded";
} else {
$messageSQL = "Error: " . $sql."<br>".$conn->error;
}

$conn -> close();

// $response["successImageUpload"] = $successImageUpload;
// $response["messageImageUpload"] = $messageImageUpload;
$response["messageSQL"] = $messageSQL;
// $response["fileCount"] = $fileCount;
$response["userSeq"] = $last_id;
$response["kakaoId"] = $kakaoId;
echo json_encode($response);





?>
