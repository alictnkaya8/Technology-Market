<?php

if(isset($_SESSION['user'])){

    if(isset($_GET["id"])){
        $id = filterVariable($_GET["id"]);
    } else {
        $id = "";
    }

    if(!empty($id)){

        $deleteAddressQuery = $db->prepare("DELETE FROM addresses WHERE id = ? LIMIT 1");
        $deleteAddressQuery->execute([$id]);
        $addressCount = $deleteAddressQuery->rowCount();

        if($addressCount > 0){
            header("Location:index.php?pageNo=68");
            exit();
        } else {
            header("Location:index.php?pageNo=69");
            exit();
        }
    } else {
        header("Location:index.php?pageNo=69");
        exit();
    }
} else {
    header("Location:index.php");
    exit();
}
?>