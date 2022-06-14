<?php

if(isset($_SESSION['user'])){

    if(isset($_GET["id"])){
        $id = filterVariable($_GET["id"]);
    } else {
        $id = "";
    }

    if(!empty($id)){

        $deleteFavoriteQuery = $db->prepare("DELETE FROM favorites WHERE id = ? AND userId = ? LIMIT 1");
        $deleteFavoriteQuery->execute([$id, $userID]);
        $favoriteDeleteCount = $deleteFavoriteQuery->rowCount();

        if($favoriteDeleteCount > 0){
            header("Location:index.php?pageNo=59");
            exit();
        } else {
            header("Location:index.php?pageNo=81");
            exit();
        }
    } else {
        header("Location:index.php?pageNo=81");
        exit();
    }
} else {
    header("Location:index.php");
    exit();
}
?>