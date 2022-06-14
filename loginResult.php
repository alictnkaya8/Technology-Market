<?php

if(isset($_POST["email"])){
    $email = filterVariable($_POST["email"]);
} else {
    $email = "";
}
if(isset($_POST["password"])){
    $password = filterVariable($_POST["password"]);
} else {
    $password = "";
}

if(!empty($email) and !empty($password)){
    $query = $db->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
    $query->execute([$email, md5($password)]);
    $checkAlreadyRegister = $query->rowCount();
    $checkActivation = $query->fetch(PDO::FETCH_ASSOC);

    if($checkAlreadyRegister > 0){

        if($checkActivation["situation"] == 1){

            $_SESSION["user"] = $email;

            if($_SESSION["user"] == $email){
                header("Location:index.php?pageNo=50");
                exit();
            } else {
                header("Location:index.php?pageNo=33");
                exit();
            }
        } else {
            header("Location:index.php?pageNo=36");
            exit();
        }
    } else {
        header("Location:index.php?pageNo=35");
        exit();
    }
} else {
    header("Location:index.php?pageNo=34");
    exit();
}
?>