<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'frameworks/PHPMailer/src/Exception.php';
require 'frameworks/PHPMailer/src/PHPMailer.php';
require 'frameworks/PHPMailer/src/SMTP.php';


if(isset($_POST["email"])){
    $email = filterVariable($_POST["email"]);
} else {
    $email = "";
}
if(isset($_POST["phoneNumber"])){
    $phoneNumber = filterVariable($_POST["phoneNumber"]);
} else {
    $phoneNumber = "";
}

if(!empty($email) or !empty($phoneNumber)){

    $query = $db->prepare("SELECT * FROM users WHERE email = ? OR phoneNumber = ?");
    $query->execute([$email, $phoneNumber]);
    $userExists = $query->rowCount();
    $checkUser = $query->fetch(PDO::FETCH_ASSOC);

    if($userExists > 0){
        $mailContent = "Merhaba Sayın " . $checkUser["nameSurname"] . "<br><br>Hesabınızın şifresini sıfırlamak için lütfen <a href='" . $siteLink . "/index.php?pageNo=43&activationCode=" . $checkUser["activationCode"] . "&email=". $checkUser["email"] . "'>BURAYA TIKLAYINIZ</a>.<br><br>" . $siteName;

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
            $sendMail->addAddress(backChanges($checkUser["email"]), backChanges($checkUser["nameSurname"]));
            $sendMail->addReplyTo(backChanges($siteEmail), backChanges($siteName));
            $sendMail->isHTML(true);
            $sendMail->Subject = 'Şifre Sıfırlama';
            $sendMail->msgHTML($mailContent);
            $sendMail->send();
            header("Location:index.php?pageNo=39");
            exit();
        } catch (Exception $e) {
            header("Location:index.php?pageNo=40");
            exit();
        }
    } else {
        header("Location:index.php?pageNo=41");
        exit();
    }
} else {
    header("Location:index.php?pageNo=42");
    exit();
}
?>