<?php

include $_SERVER['DOCUMENT_ROOT']."/somoim/common/dbConnect.php";



//전송할 핸드폰 번호를 여기에 넣는다
$phoneNum = $_POST['phoneNumber'];

// sms 보내기 추가


$sID = "ncp:sms:kr:280346039617:tes_sms"; // 서비스 ID

$smsURL = "https://sens.apigw.ntruss.com/sms/v2/services/".$sID."/messages";
$smsUri = "/sms/v2/services/".$sID."/messages";
$sKey = "5319041e321646c3863846f433de6731";

$accKeyId = "ohGoBcMQ9Gi5lN3QH3sp";   //인증키 id
$accSecKey = "Cm8J3RnSAjUir8ABqfsS7pFRX2d8Tu081YVHF1zt";  //secret key

$sTime = floor(microtime(true) * 1000);

$authNum = rand(100000, 999999);// 랜덤 인증 번호 생성

// The data to send to the API
$postData = array(
    'type' => 'SMS',
    'countryCode' => '82',
    'from' => '01082400704', // 발신번호 (등록되어있어야함)
    'contentType' => 'COMM',
    'content' => "메세지 내용",
    'messages' => array(array('content' => "인증번호: ".$authNum, 'to' => $phoneNum))
);

$postFields = json_encode($postData) ;

$hashString = "POST {$smsUri}\n{$sTime}\n{$accKeyId}";


$dHash = base64_encode( hash_hmac('sha256', $hashString, $accSecKey, true) );

$header = array(
    // "accept: application/json",
    'Content-Type: application/json; charset=utf-8',
    'x-ncp-apigw-timestamp: '.$sTime,
    "x-ncp-iam-access-key: ".$accKeyId,
    "x-ncp-apigw-signature-v2: ".$dHash
);

//curl은 다양한 프로토콜로 전송이 가능한 command line tool 이다
// Setup cURL
$ch = curl_init($smsURL);

curl_setopt_array($ch, array(   //옵션을 배열로 한번에 설정한다
    CURLOPT_POST => TRUE,
    CURLOPT_RETURNTRANSFER => TRUE,
    CURLOPT_HTTPHEADER => $header,
    CURLOPT_POSTFIELDS => $postFields
));

$response = curl_exec($ch);//설정된 옵션으로 실행한다

curl_close($ch);//chrl을 닫아준다

$sql = "INSERT INTO certifyCode (phoneNumber, code) VALUES ('$phoneNum', '$authNum')";
$result = mysqli_query($conn, $sql);


echo json_encode($authNum); //인증번호를 안드로이드로 보내준다


?>