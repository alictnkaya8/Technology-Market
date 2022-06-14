<?php

if(isset($_SESSION['user'])){

    if(isset($_POST["nameSurname"])){
        $inComingNameSurname = filterVariable($_POST["nameSurname"]);
    } else {
        $inComingNameSurname = "";
    }
    if(isset($_POST["email"])){
        $inComingEmail = filterVariable($_POST["email"]);
    } else {
        $inComingEmail = "";
    }
    if(isset($_POST["password"])){
        $inComingPassword = filterVariable($_POST["password"]);
    } else {
        $inComingPassword = "";
    }
    if(isset($_POST["passwordAgain"])){
        $inComingPasswordAgain = filterVariable($_POST["passwordAgain"]);
    } else {
        $inComingPasswordAgain = "";
    }
    if(isset($_POST["phoneNumber"])){
        $inComingPhoneNumber = filterVariable($_POST["phoneNumber"]);
    } else {
        $inComingPhoneNumber = "";
    }
    if(isset($_POST["gender"])){
        $inComingGender = filterVariable($_POST["gender"]);
    } else {
        $inComingGender = "";
    }

    if(!empty($inComingNameSurname) and !empty($inComingEmail) and !empty($inComingPassword) and !empty($inComingPasswordAgain) and !empty($inComingPhoneNumber) and !empty($inComingGender)){
        if ($inComingPassword != $inComingPasswordAgain) {
            header("Location:index.php?pageNo=57");
            exit();
        } else {
            if($inComingPassword == 'EskiSifre'){
                $passwordSituation = 0;
            } else {
                $passwordSituation = 1;
            }
            if($email != $inComingEmail){
                $query = $db->prepare("SELECT * FROM users WHERE email = ?");
                $query->execute([$inComingEmail]);
                $userCount = $query->rowCount();
                
                if ($userCount > 0) {
                    header("Location:index.php?pageNo=55");
                    exit();
                }
            }
            if($passwordSituation == 1){
                $modifyUserQuery =  $db->prepare("UPDATE users SET nameSurname = ?, email = ?, password = ?, phoneNumber = ?, gender = ? WHERE id = ? LIMIT 1");
                $modifyUserQuery->execute([$inComingNameSurname, $inComingEmail, md5($inComingPassword), $inComingPhoneNumber, $inComingGender, $userID]);
            } else {
                $modifyUserQuery =  $db->prepare("UPDATE users SET nameSurname = ?, email = ?, phoneNumber = ?, gender = ? WHERE id = ? LIMIT 1");
                $modifyUserQuery->execute([$inComingNameSurname, $inComingEmail, $inComingPhoneNumber, $inComingGender, $userID]);
            }

            $modifyUser = $modifyUserQuery->rowCount();

            if ($modifyUser > 0) {
                $_SESSION['user'] = $inComingEmail;

                header("Location:index.php?pageNo=53");
                exit();
            } else {
                header("Location:index.php?pageNo=54");
                exit();
            }
        }
    } else {
        header("Location:index.php?pageNo=56");
        exit();
    }
} else {
    header("Location:index.php");
    exit();
}
?>