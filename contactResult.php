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
if(isset($_POST["phoneNumber"])){
    $phoneNumber = filterVariable($_POST["phoneNumber"]);
} else {
    $phoneNumber = "";
}
if(isset($_POST["message"])){
    $message = filterVariable($_POST["message"]);
} else {
    $message = "";
}

if(!empty($nameSurname) and !empty($email) and !empty($phoneNumber) and !empty($message)){
    $mailContent = "İsim Soyisim : " . $nameSurname . "<br>E-mail Adresi : " . $email . "<br>Telefon Numarası : " . $phoneNumber . "<br>Mesaj : " . $message;

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
        $sendMail->addAddress(backChanges($siteEmail), backChanges($siteName));
        $sendMail->addReplyTo($email, $nameSurname);
        $sendMail->isHTML(true);
        $sendMail->Subject = 'İletişim Formu Mesajı';
        $sendMail->msgHTML($mailContent);
        $sendMail->send();

        header("Location:index.php?pageNo=18");
        exit();
    } catch (Exception $e) {
        header("Location:index.php?pageNo=19");
        exit();
    }
} else {
    header("Location:index.php?pageNo=20");
    exit();
}
?>