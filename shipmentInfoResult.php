<?php

if(isset($_POST["shippingTrackingNumber"])){
    $shippingTrackingNumber = filterNumberedVariable(filterVariable($_POST["shippingTrackingNumber"]));
} else {
    $shippingTrackingNumber = "";
}
if($shippingTrackingNumber != ""){
    header("Location:https://www.yurticikargo.com/tr/online-servisler/gonderi-sorgula?code=" . $shippingTrackingNumber);
    exit();
} else {
    header("Location:index.php?pageNo=14");
    exit();
}
?>

