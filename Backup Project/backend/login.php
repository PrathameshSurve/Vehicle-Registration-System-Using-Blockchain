<?php

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;




require 'db.php';
require 'vendor/autoload.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';
require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/Exception.php';



session_start();

// request from client with email address
if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['email'])){
$email = $conn->real_escape_string($_POST['email']);
$result = $conn->query("SELECT * FROM user WHERE email = '$email';");
if($result->num_rows){
    $_SESSION['EMAIL']=$email;
    $otp = rand(1111, 9999);
    $conn->query("UPDATE user SET otp = $otp where email = '$email';");
   
    sendEmail($email, $otp);
    echo json_encode(['status' => 'success']);
}
else
echo json_encode(['status' => 'failure']);
exit();
}

// request from client with OTP code
if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['otp'])){
    $userProvidedOtp = $conn->real_escape_string($_POST['otp']);
    $email = $_SESSION['EMAIL'];
    $result = $conn->query("SELECT * from user where otp = $userProvidedOtp and email = '$email' ;");
    if($result->num_rows){
        $_SESSION['LOGGEDIN']=true;
        echo json_encode(['status' => 'success']); 
    }
    else 
    echo json_encode(['status' => 'failure']);
exit();
}

if($_SERVER['REQUEST_METHOD']=='GET' && isset($_GET['logout'])){
   
    unset($_SESSION['EMAIL']);
    unset($_SESSION['LOGGEDIN']);
    session_destroy();
    echo json_encode(['status' => 'Logged Out.']); 
    
    exit();
}

if($_SERVER['REQUEST_METHOD']=='GET'){
    if(isset($_SESSION['LOGGEDIN']))
    echo json_encode(['status' => 'success']); 
    else
    echo json_encode(['status' => 'logged out.']); 
    exit();
}


// function sendEmail logic
function sendEmail($email, $otp){
   
$mail = new PHPMailer(true);

try{
$mail->SMTPDebug = 0;
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->Username ='sunnysurve196@gmail.com';
$mail->Password = 'sunny#4321';
$mail->SMTPAuth=true;
$mail->Port = 465;
$mail->SMTPSecure = 'ssl';
$mail->setFrom('sunnysurve196@gmail.com', 'Sunny Surve');
$mail->addAddress($email);
$mail->isHTML(true);
$mail->Subject='Your OTP Code';
$mail->Body = "Here is your OTP code for Auto Gazette: <br> $otp";
$mail->send();
}catch(Exception $e)
    {echo $e;}
}