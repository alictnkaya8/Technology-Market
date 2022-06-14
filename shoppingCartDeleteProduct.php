<?php

if(isset($_SESSION['user'])){

    if(isset($_GET["id"])){
        $id = filterVariable($_GET["id"]);
    } else {
        $id = "";
    }

    if(!empty($id)){

        $deleteProductInCartQuery = $db->prepare("DELETE FROM shoppingCart WHERE id = ? AND userId = ? LIMIT 1");
        $deleteProductInCartQuery->execute([$id, $userID]);
        $deletedProductCount = $deleteProductInCartQuery->rowCount();

        header("Location:index.php?pageNo=95");
        exit();
    } else {
        header("Location:index.php?pageNo=95");
        exit();
    }
} else {
    header("Location:index.php");
    exit();
}
?>