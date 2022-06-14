<?php

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
if(isset($_POST["password"])){
    $password = filterVariable($_POST["password"]);
} else {
    $password = "";
}
if(isset($_POST["passwordAgain"])){
    $passwordAgain = filterVariable($_POST["passwordAgain"]);
} else {
    $passwordAgain = "";
}

$hashedPassword = md5($password);

if(!empty($email) and !empty($activationCode) and !empty($password) and !empty($passwordAgain)){
    if ($password != $passwordAgain) {
        header("Location:index.php?pageNo=47");
        exit();
    } else {
        $query = $db->prepare("UPDATE users SET password = ? WHERE email = ? AND activationCode = ? LIMIT 1");
        $query->execute([$hashedPassword, $email, $activationCode]);
        $isSuccess = $query->rowCount();
     
        if($isSuccess > 0){
            header("Location:index.php?pageNo=45");
            exit();
        } else {
            header("Location:index.php?pageNo=46");
            exit();
        }
    }
} else {
    header("Location:index.php?pageNo=48");
    exit();
}
?>