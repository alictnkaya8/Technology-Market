<?php

if(isset($_SESSION['user'])){

    if(isset($_GET["id"])){
        $id = filterVariable($_GET["id"]);
    } else {
        $id = "";
    }

    if(!empty($id)){

        $checkFavoriteQuery = $db->prepare("SELECT * FROM favorites WHERE productId = ? AND userId = ? LIMIT 1");
        $checkFavoriteQuery->execute([$id, $userID]);
        $checkFavoriteCount = $checkFavoriteQuery->rowCount();

        if($checkFavoriteCount > 0){
            header("Location:index.php?pageNo=91");
            exit();
        } else {
            $addFavoriteQuery = $db->prepare("INSERT INTO favorites (productId, userId) VALUES (?, ?)");
            $addFavoriteQuery->execute([$id, $userID]);
            $addFavoriteCount = $addFavoriteQuery->rowCount();
    
            if($addFavoriteCount > 0){
                header("Location:index.php?pageNo=89");
                exit();
            } else {
                header("Location:index.php?pageNo=90");
                exit();
            }
        }
    } else {
        header("Location:index.php");
        exit();
    }
} else {
    header("Location:index.php");
    exit();
}
?>