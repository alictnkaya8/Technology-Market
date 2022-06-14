<?php

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
if(isset($_POST["bankSelection"])){
    $bankSelection = filterVariable($_POST["bankSelection"]);
} else {
    $bankSelection = "";
}
if(isset($_POST["decription"])){
    $decription = filterVariable($_POST["decription"]);
} else {
    $decription = "";
}

if(!empty($nameSurname) and !empty($email) and !empty($phoneNumber) and !empty($bankSelection)){

    $remittanceQuery = $db->prepare("INSERT INTO remittancenotifications (bankId, nameSurname, email, phoneNumber, description, transactionDate, situation) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $remittanceQuery->execute([$bankSelection, $nameSurname, $email, $phoneNumber, $decription, $timeStamp, 0]);
    $remittanceNotificationCount = $remittanceQuery->rowCount();

    if($remittanceNotificationCount > 0){
        header("Location:index.php?pageNo=11");
        exit();
    } else {
        header("Location:index.php?pageNo=12");
        exit();
    }
} else {
    header("Location:index.php?pageNo=13");
    exit();
}
?>