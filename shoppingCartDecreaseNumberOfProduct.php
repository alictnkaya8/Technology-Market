<?php

if(isset($_SESSION['user'])){

    if(isset($_GET["id"])){
        $id = filterVariable($_GET["id"]);
    } else {
        $id = "";
    }

    if(!empty($id)){

        $updateProductInCartQuery = $db->prepare("UPDATE shoppingCart SET numberOfProducts = numberOfProducts - 1 WHERE id = ? AND userId = ? LIMIT 1");
        $updateProductInCartQuery->execute([$id, $userID]);
        $updatedProductCount = $updateProductInCartQuery->rowCount();

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