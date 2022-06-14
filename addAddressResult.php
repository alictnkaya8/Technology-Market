<?php

if(isset($_SESSION['user'])){

    if(isset($_POST["nameSurname"])){
        $inComingNameSurname = filterVariable($_POST["nameSurname"]);
    } else {
        $inComingNameSurname = "";
    }
    if(isset($_POST["address"])){
        $inComingAddress = filterVariable($_POST["address"]);
    } else {
        $inComingAddress = "";
    }
    if(isset($_POST["city"])){
        $inComingCity = filterVariable($_POST["city"]);
    } else {
        $inComingCity = "";
    }
    if(isset($_POST["country"])){
        $inComingCountry = filterVariable($_POST["country"]);
    } else {
        $inComingCountry = "";
    }
    if(isset($_POST["phoneNumber"])){
        $inComingPhoneNumber = filterVariable($_POST["phoneNumber"]);
    } else {
        $inComingPhoneNumber = "";
    }

    if(!empty($inComingNameSurname) and !empty($inComingAddress) and !empty($inComingCity) and !empty($inComingCountry) and !empty($inComingPhoneNumber)){

        $addAddressQuery =  $db->prepare("INSERT INTO addresses (userId, nameSurname, address, city, country, phoneNumber) VALUES (?, ?, ?, ?, ?,?)");
        $addAddressQuery->execute([$userID, $inComingNameSurname, $inComingAddress, $inComingCity, $inComingCountry, $inComingPhoneNumber]);
        $addCount = $addAddressQuery->rowCount();

        if($addCount > 0){
            header("Location:index.php?pageNo=72");
            exit();
        } else {
            header("Location:index.php?pageNo=73");
            exit();
        }
    } else {
        header("Location:index.php?pageNo=74");
        exit();
    }
} else {
    header("Location:index.php");
    exit();
}
?>