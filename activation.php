<?php

require_once("settings/setting.php");
require_once("settings/functions.php");


if(isset($_GET["activationCode"])){
    $activationCode = filterVariable($_GET["activationCode"]);
} else {
    $activationCode = "";
}
if(isset($_GET["email"])){
    $email = filterVariable($_GET["email"]);
} else {
    $email = "";
}

if(!empty($activationCode) and !empty($email)){
    $query = $db->prepare("SELECT * FROM users WHERE email = ? AND activationCode = ? AND situation = ?");
    $query->execute([$email, $activationCode, 0]);
    $checkAvtivationCode = $query->rowCount();

    if($checkAvtivationCode > 0){
        $query = $db->prepare("UPDATE users SET situation = 1");
        $query->execute();
        $isSuccess = $query->rowCount();
     
        if($isSuccess > 0){
            header("Location:index.php?pageNo=30");
            exit();
        } else {
            header("Location:" . $siteLink);
            exit();
        }
    } else {
        header("Location:" . $siteLink);
        exit();
    }
} else {
    header("Location:" . $siteLink);
    exit();
}
?>