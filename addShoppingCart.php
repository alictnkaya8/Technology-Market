<?php

if(isset($_SESSION['user'])){

    if(isset($_GET["id"])){
        $id = filterVariable($_GET["id"]);
    } else {
        $id = "";
    }
    if(isset($_POST["variant"])){
        $variantId = filterVariable($_POST["variant"]);
    } else {
        $variantId = "";
    }

    if(($id != "") and ($variantId != "")){

    $checkUserShoppingCartQuery = $db->prepare("SELECT * FROM shoppingCart WHERE userId = ? ORDER BY id DESC LIMIT 1");
    $checkUserShoppingCartQuery->execute([$userID]);
    $userShoppingCartCount = $checkUserShoppingCartQuery->rowCount();

    if($userShoppingCartCount > 0){

        $checkProductShoppingCartQuery = $db->prepare("SELECT * FROM shoppingCart WHERE userId = ? AND productId = ? AND variantId = ? ORDER BY id DESC LIMIT 1");
        $checkProductShoppingCartQuery->execute([$userID, $userID, $variantId]);
        $productShoppingCartCount = $checkProductShoppingCartQuery->rowCount();
        $productShoppingCart = $checkProductShoppingCartQuery->fetch(PDO::FETCH_ASSOC);

        if($productShoppingCartCount > 0){
            $productId = $productShoppingCart['id'];
            $numberOfProductInCart = $productShoppingCart["numberOfProducts"];
            $newNumberOfProduct = $numberOfProductInCart + 1;

            $updateNumberOfProductQuery = $db->prepare("UPDATE shoppingCart SET numberOfProducts = ? WHERE id = ? AND userId = ? AND productId = ? LIMIT 1");
            $updateNumberOfProductQuery->execute([$newNumberOfProduct, $productId, $userID, $id]);
            $updateProductCount = $updateNumberOfProductQuery->rowCount();

            if($updateProductCount > 0){
                header("Location:index.php?pageNo=95");
                exit();
            } else {
                header("Location:index.php?pageNo=93");
                exit();
            }
        } else {
            $addProductQuery = $db->prepare("INSERT INTO shoppingCart (userId, productId, variantId, numberOfProducts) VALUES (?, ?, ?, ?)");
            $addProductQuery->execute([$userID, $id, $variantId, 1]);
            $addProductCount = $addProductQuery->rowCount();
            $lastId = $db->lastInsertId();
            
            if($addProductCount > 0){
                $updateCartNumberQuery = $db->prepare("UPDATE shoppingCart SET cartNumber = ? WHERE userId = ?");
                $updateCartNumberQuery->execute([$lastId, $userID]);
                $updateCartNumberCount = $updateCartNumberQuery->rowCount();

                if($updateCartNumberCount > 0){
                    header("Location:index.php?pageNo=95");
                    exit();
                } else {
                    header("Location:index.php?pageNo=93");
                    exit();
                }
            } else {
                header("Location:index.php?pageNo=93");
                exit();
            }
        }
    } else {
        $addProductQuery = $db->prepare("INSERT INTO shoppingCart (userId, productId, variantId, numberOfProducts) VALUES (?, ?, ?, ?)");
        $addProductQuery->execute([$userID, $id, $variantId, 1]);
        $addProductCount = $addProductQuery->rowCount();
        $lastId = $db->lastInsertId();
        
        if($addProductCount > 0){
            $updateCartNumberQuery = $db->prepare("UPDATE shoppingCart SET cartNumber = ? WHERE userId = ?");
            $updateCartNumberQuery->execute([$lastId, $userID]);
            $updateCartNumberCount = $updateCartNumberQuery->rowCount();

            if($updateCartNumberCount > 0){
                header("Location:index.php?pageNo=95");
                exit();
            } else {
                header("Location:index.php?pageNo=93");
                exit();
            }
        } else {
            header("Location:index.php?pageNo=93");
            exit();
        }
    }
    } else {
        header("Location:index.php");
        exit();
    }
} else {
    header("Location:index.php?pageNo=94");
    exit();
}
?>