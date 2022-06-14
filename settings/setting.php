<?php

try{
    $db = new PDO("mysql:host=localhost;dbname=grad-project;charset=UTF8", "root", "");
} catch (PDOException $error){
    //echo $error->getMessage();
    die();
}

$settingQuery = $db->prepare("SELECT * FROM settings LIMIT 1");
$settingQuery->execute();
$settingCount = $settingQuery->rowCount();
$setting = $settingQuery->fetch(PDO::FETCH_ASSOC);

if($settingCount > 0){
    $siteName = $setting["siteName"];
    $siteTitle = $setting["siteTitle"];
    $siteDescription = $setting["siteDescription"];
    $siteKeywords = $setting["siteKeywords"];
    $siteCopyright = $setting["siteCopyright"];
    $siteLogo = $setting["siteLogo"];
    $siteLink = $setting["siteLink"];
    $siteEmail = $setting["siteEmail"];
    $siteEmailPassword = $setting["siteEmailPassword"];
    $facebookLink = $setting["facebookLink"];
    $twitterLink = $setting["twitterLink"];
    $instagramLink = $setting["instagramLink"];
    $linkedinLink = $setting["linkedinLink"];
    $youtubeLink = $setting["youtubeLink"];
    $usdChangeRate = $setting["usdChangeRate"];
    $euroChangeRate = $setting["euroChangeRate"];
} else {
    die();
}

$textsQuery = $db->prepare("SELECT * FROM agreementsandtexts LIMIT 1");
$textsQuery->execute();
$textsCount = $textsQuery->rowCount();
$text = $textsQuery->fetch(PDO::FETCH_ASSOC);

if($textsCount > 0){
    $aboutUs = $text["aboutUs"];
    $membershipAgreement = $text["membershipAgreement"];
    $termOfUse = $text["termOfUse"];
    $confidentialityAgreement = $text["confidentialityAgreement"];
    $distanceSellingContract = $text["distanceSellingContract"];
    $delivery = $text["delivery"];
    $cancellationRefundExchange = $text["cancellationRefundExchange"];
} else {
    die();
}
if(isset($_SESSION["user"])){
    $userQuery = $db->prepare("SELECT * FROM users WHERE email = ? LIMIT 1");
    $userQuery->execute([$_SESSION["user"]]);
    $userCount = $userQuery->rowCount();
    $user = $userQuery->fetch(PDO::FETCH_ASSOC);

    if($userCount > 0){
        $userID = $user["id"];
        $nameSurname = $user["nameSurname"];
        $email = $user["email"];
        $password = $user["password"];
        $phoneNumber = $user["phoneNumber"];
        $gender = $user["gender"];
        $situation = $user["situation"];
        $registerDate = $user["registerDate"];
        $IPAddress = $user["IPAddress"];
        $activationCode = $user["activationCode"];
    } else {
        die();
    }
}
?>