<?php

$IPAddress = $_SERVER["REMOTE_ADDR"];
$timeStamp = time();
$dateTime = date("d.m.Y H:i:s", $timeStamp);

function onlyAllowNumbers($variable){
    $result = preg_replace("/[^0-9]/", "", $variable);
    return $result;
}

function clearAllSpace($variable){
    $result = preg_replace("/\s|&nbsp;/", "", $variable);
    return $result;
}

function backChanges($variable){
    $result = htmlspecialchars_decode($variable, ENT_QUOTES);
    return $result;
}

function filterVariable($variable){
    $result = htmlspecialchars(strip_tags(trim($variable)), ENT_QUOTES);
    return $result;
}
function filterNumberedVariable($variable){
    $result = htmlspecialchars(strip_tags(trim($variable)), ENT_QUOTES);
    $clear = onlyAllowNumbers($result);
    return $clear;
}

function formatIBAN($variable){
    $clearSpace = clearAllSpace($variable);
    $firstBlock = substr($clearSpace, 0, 4);
    $secondBlock = substr($clearSpace, 4, 4);
    $thirdBlock = substr($clearSpace, 8, 4);
    $fourthBlock = substr($clearSpace, 12, 4);
    $fifthBlock = substr($clearSpace, 16, 4);
    $sixthBlock = substr($clearSpace, 20, 4);
    $seventhBlock = substr($clearSpace, 24, 2);
    return $firstBlock . " " . $secondBlock . " " . $thirdBlock . " " . $fourthBlock . " " . $fifthBlock . " " . $sixthBlock . " " . $seventhBlock;
}

function createActivationCode(){
    $first = rand(10000, 99999);
    $second = rand(10000, 99999);
    $third = rand(10000, 99999);
    $code = $first . "-" . $second . "-" . $third;
    return $code;
}

function priceFormat($variable){
    $formattedPrice = number_format($variable, "2", ",", ".");
    return $formattedPrice;
}
?>