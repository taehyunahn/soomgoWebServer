<?php
//phpinfo();
// Include router class
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
require 'vendor/autoload.php';
include $_SERVER['DOCUMENT_ROOT']."/common/dbConnect.php";

// 1. 클라이언트에서 이메일 주소를 받아온다
$emailAddress = $_POST['emailAddress'];

$sql2 = "SELECT COUNT(seq) FROM userInfo WHERE userEmail = '$emailAddress'";
$result2 = mysqli_query($conn, $sql2);
$exist2 = mysqli_fetch_array($result2);
if ($exist2['0'] == 0) { //해당 이메일이 없는 경우
    echo $exist2['0'];
} else { //해당 이메일이 있는 경우
        // 2. 인증키를 생성한다
        $x = 0;
        $y = 8;
        $Strings = '0123456789abcdefghijklmnopqrstuvwxyz';
        $passwordCode = substr(str_shuffle($Strings), $x, $y);
        // 메일을 보내는 코드 -- 시작
        $mail = new PHPMailer();
        $mail->CharSet = 'UTF-8';
        //Tell PHPMailer to use SMTP
        $mail->isSMTP();
        $mail->SMTPDebug = SMTP::DEBUG_SERVER; // 디버그 모드, DEBUG_OFF 시 출력 없음
        $mail->Host = 'smtp.naver.com';
        //Naver 이용
        $mail->Port = 587;
        //SMTP 고정 포트
        //encrypte 메커니즘 세팅
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        //SMTP AUTH 사용
        $mail->SMTPAuth = true;
        // Naver 계정주소명
        $mail->Username = 'ahnsstory@naver.com';
        // Naver 패스워드
        $mail->Password = 'peter225!@';
        //  보내는 사람 주소, 이름 세팅 - 보내는사람 주소은 추가 세팅을 해주지않으면 Username의 계정
        $mail->setFrom('ahnsstory@naver.com', '숨고');
        $email = $emailAddress;
        // 내가 보낼 주소, 이름(선택)
        $mail->addAddress($email, null);
        // $mail->addCustomHeader('Content-Type', 'text/plain;charset=utf-8');
        // 메일 제목, 내용 세팅
        $mail->Subject = '인증코드';
        $mail->Body = "
        <b>인증코드</b>
         <br/> 비밀번호를 재설정하기 위한 인증코드입니다.
         <br/> 인증번호는 ".$passwordCode." 입니다.
        ";
        $mail->isHTML(true);
        if (!$mail->send()) {
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            echo 'Message sent';
        }
    // 메일 보내는 코드 -- 끝
    // 3. 인증코드를 DB에 저장한다 (SQL문 사용)
    $sql = "INSERT INTO passwordCode (email, code) VALUES ('$email', '$passwordCode')";
    $result = mysqli_query($conn, $sql);
}


$conn -> close();




?>