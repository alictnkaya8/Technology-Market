<?php

if(isset($_SESSION['user'])){

    $shoppingCartQuery = $db->prepare("SELECT * FROM shoppingcart WHERE userId = ?");
    $shoppingCartQuery->execute([$userID]);
    $shoppingCartCount = $shoppingCartQuery->rowCount();
    $productsInCart = $shoppingCartQuery->fetchAll(PDO::FETCH_ASSOC);

    if($shoppingCartCount > 0){
        $totalPriceOfCart = 0;
        foreach($productsInCart as $productInCart){
            $cartId = $productInCart["id"];
            $cartNumber = $productInCart["cartNumber"];
            $userId = $productInCart["userId"];
            $productId = $productInCart["productId"];
            $addressId = $productInCart["addressId"];
            $productVariantId = $productInCart["variantId"];
            $numberOfProducts = $productInCart["numberOfProducts"];
            $shipmentCompanySelection = $productInCart["shipmentCompanySelection"];
            $paymentChoice = $productInCart["paymentChoice"];
            $installmentSelection = $productInCart["installmentSelection"];
        
        
            $productInfoQuery = $db->prepare("SELECT * FROM products WHERE id = ? LIMIT 1");
            $productInfoQuery->execute([$productId]);
            $productInfo = $productInfoQuery->fetch(PDO::FETCH_ASSOC);
                $productType = $productInfo['productType'];
                $productPicture = $productInfo['productPic1'];
                $productName = $productInfo['productName'];
                $productPrice = $productInfo['productPrice'];
                $productCurrencyUnit = $productInfo['currencyUnit'];
                $productKdvRate = $productInfo['kdvRate'];
                $productShippingCost = $productInfo['shippingCost'];
                $productVariantTitle = $productInfo['variantTitle'];

            $productVariantInfoQuery = $db->prepare("SELECT * FROM variants WHERE id = ? LIMIT 1");
            $productVariantInfoQuery->execute([$productVariantId]);
            $productVariantInfo = $productVariantInfoQuery->fetch(PDO::FETCH_ASSOC);
                $variantName = $productVariantInfo['variantName'];
                $variantStock = $productVariantInfo['stockQuantity'];
        
                if($productCurrencyUnit == "USD"){
                    $productPriceCalculator = $productPrice * $usdChangeRate;
                } elseif ($productCurrencyUnit == "EUR"){
                    $productPriceCalculator = $productPrice * $euroChangeRate;
                } else {
                    $productPriceCalculator = $productPrice;
                }

            $totalPriceOfCart = $productPriceCalculator * $numberOfProducts;

            $addOrder = $db->prepare("INSERT INTO orders (userId, orderNumber, productId, productType, productName, productPrice, kdvRate, numberOfProducts, totalProductAmount, shippingCost, productPic1, variantTitle, variantSelection, addressNameSurname, addressDetail, addressPhoneNumber, paymentChoice, orderDate, orderIpAddress) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $addOrder->execute([$userId, $cartNumber, $productId, $productType, $productName, $productPriceCalculator, $productKdvRate, $numberOfProducts, $totalPriceOfCart, $productShippingCost, $productPicture, $productVariantTitle, $variantName, $nameSurname, "", "", "", $timeStamp, $IPAddress]);
            $addCount = $addOrder->rowCount();

            if($addCount > 0){
                $deleteShippingCart = $db->prepare("DELETE FROM shoppingcart WHERE id = ? AND userId = ? LIMIT 1");
                $deleteShippingCart->execute([$cartId, $userId]);
            }
        }

        header("Location:index.php?pageNo=101");
        exit();
    } else {
        header("Location:index.php");
        exit();
    }
} else {
    header("Location:index.php");
    exit();
}
?>