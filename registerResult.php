<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'frameworks/PHPMailer/src/Exception.php';
require 'frameworks/PHPMailer/src/PHPMailer.php';
require 'frameworks/PHPMailer/src/SMTP.php';

if(isset($_POST["nameSurname"])){
    $nameSurname = filterVariable($_POST["nameSurname"]);
} else {
    $nameSurname = "";
}
if(isset($_POST["email"])){
    $email = filterVariable($_POST["email"]);
} else {
    $email = "";
}
if(isset($_POST["password"])){
    $password = filterVariable($_POST["password"]);
} else {
    $password = "";
}
if(isset($_POST["passwordAgain"])){
    $passwordAgain = filterVariable($_POST["passwordAgain"]);
} else {
    $passwordAgain = "";
}
if(isset($_POST["phoneNumber"])){
    $phoneNumber = filterVariable($_POST["phoneNumber"]);
} else {
    $phoneNumber = "";
}
if(isset($_POST["gender"])){
    $gender = filterVariable($_POST["gender"]);
} else {
    $gender = "";
}
if(isset($_POST["confirmContract"])){
    $confirmContract = filterVariable($_POST["confirmContract"]);
} else {
    $confirmContract = "";
}
$activationCode = createActivationCode();

if(!empty($nameSurname) and !empty($email) and !empty($password) and !empty($passwordAgain) and !empty($phoneNumber) and !empty($gender)){
    if ($confirmContract == 0) {
        header("Location:index.php?pageNo=29");
        exit();
    } else {
        if ($password != $passwordAgain) {
            header("Location:index.php?pageNo=28");
            exit();
        } else {
            $query = $db->prepare("SELECT * FROM users WHERE email = ?");
            $query->execute([$email]);
            $checkAlreadyRegister = $query->rowCount();
            if ($checkAlreadyRegister > 0) {
                header("Location:index.php?pageNo=27");
                exit();
            } else {
                $registerQuery =  $db->prepare("INSERT INTO users (nameSurname, email, password, phoneNumber, gender, situation, registerDate, IPAddress, activationCode) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $registerQuery->execute([$nameSurname, $email, md5($password), $phoneNumber, $gender, 0, $timeStamp, $IPAddress, $activationCode]);
                $checkRegister = $registerQuery->rowCount();
                if ($checkRegister > 0) {
                    $mailContent = "Merhaba Sayın " . $nameSurname . "<br><br>Kayıt işleminizi tamamlamak için lütfen <a href='" . $siteLink . "/activation.php?activationCode=" . $activationCode . "&email=". $email . "'>BURAYA TIKLAYINIZ</a>.<br><br>" . $siteName;
                    $sendMail = new PHPMailer(true);
                    try {
                        $sendMail->SMTPDebug = 0;
                        $sendMail->isSMTP();
                        $sendMail->Host = 'smtp.gmail.com';
                        $sendMail->SMTPAuth = true;
                        $sendMail->CharSet = 'UTF-8';
                        $sendMail->Username = backChanges($siteEmail);
                        $sendMail->Password = backChanges($siteEmailPassword);
                        $sendMail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                        $sendMail->Port = 465;
                        $sendMail->setFrom(backChanges($siteEmail), backChanges($siteName));
                        $sendMail->addAddress(backChanges($email), backChanges($nameSurname));
                        $sendMail->addReplyTo(backChanges($siteEmail), backChanges($siteName));
                        $sendMail->isHTML(true);
                        $sendMail->Subject = 'Üyelik Aktivasyonu';
                        $sendMail->msgHTML($mailContent);
                        $sendMail->send();
                        header("Location:index.php?pageNo=24");
                        exit();
                    } catch (Exception $e) {
                        header("Location:index.php?pageNo=25");
                        exit();
                    }
                } else {
                    header("Location:index.php?pageNo=25");
                    exit();
                }
            }
        }
    }
} else {
    header("Location:index.php?pageNo=26");
    exit();
}
?>