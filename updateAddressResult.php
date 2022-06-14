<?php

if(isset($_SESSION['user'])){

    if(isset($_GET["id"])){
        $incomingId = filterVariable($_GET["id"]);
    } else {
        $incomingId = "";
    }
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

    if(!empty($incomingId) and !empty($inComingNameSurname) and !empty($inComingAddress) and !empty($inComingCity) and !empty($inComingCountry) and !empty($inComingPhoneNumber)){

        $updateAddressQuery =  $db->prepare("UPDATE addresses SET nameSurname = ?, address = ?, city = ?, country = ?, phoneNumber = ? WHERE id = ? AND userId = ? LIMIT 1");
        $updateAddressQuery->execute([$inComingNameSurname, $inComingAddress, $inComingCity, $inComingCountry, $inComingPhoneNumber, $incomingId, $userID]);
        $updateCount = $updateAddressQuery->rowCount();

        if($updateCount > 0){
            header("Location:index.php?pageNo=64");
            exit();
        } else {
            header("Location:index.php?pageNo=65");
            exit();
        }
    } else {
        header("Location:index.php?pageNo=66");
        exit();
    }
} else {
    header("Location:index.php");
    exit();
}
?>