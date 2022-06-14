<?php

if(isset($_SESSION['user'])){

    $productsStockInCartQuery = $db->prepare("SELECT * FROM shoppingCart WHERE userId = ?");
    $productsStockInCartQuery->execute([$userID]);
    $productsStockInCartCount = $productsStockInCartQuery->rowCount();
    $productsStockInCart = $productsStockInCartQuery->fetchAll(PDO::FETCH_ASSOC);

    if($productsStockInCartCount > 0){
        foreach($productsStockInCart as $productStockInCart){

            $stockCartId = $productStockInCart["id"];
            $stockProductVariantId = $productStockInCart["variantId"];
            $stockNumberOfProducts = $productStockInCart["numberOfProducts"];

            $productStockVariantInfoQuery = $db->prepare("SELECT * FROM variants WHERE id = ? LIMIT 1");
            $productStockVariantInfoQuery->execute([$stockProductVariantId]);
            $productStockVariantInfo = $productStockVariantInfoQuery->fetch(PDO::FETCH_ASSOC);
                $variantStock = $productStockVariantInfo['stockQuantity'];

            if($variantStock == 0){
                $deleteProductInCartQuery = $db->prepare("DELETE FROM shoppingCart WHERE id = ? AND userId = ? LIMIT 1");
                $deleteProductInCartQuery->execute([$stockCartId, $userID]);
            } elseif ($variantStock < $stockNumberOfProducts){
                $updateProductInCartQuery = $db->prepare("UPDATE shoppingCart SET numberOfProducts = ? WHERE id = ? AND userId = ? LIMIT 1");
                $updateProductInCartQuery->execute([$variantStock, $stockCartId, $userID]);
            }
        }
    }
?>
<table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td width="800" valign="top">
            <table width="800" align="center" border="0" cellpadding="0" cellspacing="0">
                <tr height="40">
                    <td style="color: #FF9900;"><h3>Alışveriş Sepeti</h3></td>
                </tr>
                <tr height="30">
                    <td valign="top" style="border-bottom: 1px dashed #CCCCCC;">Aşağıdan sepetinize eklemiş olduğunuz ürünleri görebilirsiniz.</td>
                </tr>
                <?php
                $productsInCartQuery = $db->prepare("SELECT * FROM shoppingCart WHERE userId = ? ORDER BY id DESC");
                $productsInCartQuery->execute([$userID]);
                $productsInCartCount = $productsInCartQuery->rowCount();
                $productsInCart = $productsInCartQuery->fetchAll(PDO::FETCH_ASSOC);

                if($productsInCartCount > 0){
                    $counter = 0;
                    $totalPriceOfCart = 0;
                    foreach($productsInCart as $productInCart){
                        $cartId = $productInCart["id"];
                        $productId = $productInCart["productId"];
                        $productVariantId = $productInCart["variantId"];
                        $numberOfProducts = $productInCart["numberOfProducts"];

                        $productInfoQuery = $db->prepare("SELECT * FROM products WHERE id = ? LIMIT 1");
                        $productInfoQuery->execute([$productId]);
                        $productInfo = $productInfoQuery->fetch(PDO::FETCH_ASSOC);
                            $productType = $productInfo['productType'];
                            $productPicture = $productInfo['productPic1'];
                            $productName = $productInfo['productName'];
                            $productPrice = $productInfo['productPrice'];
                            $productCurrencyUnit = $productInfo['currencyUnit'];
                            $productVariantTitle = $productInfo['variantTitle'];

                        $productVariantInfoQuery = $db->prepare("SELECT * FROM variants WHERE id = ? LIMIT 1");
                        $productVariantInfoQuery->execute([$productVariantId]);
                        $productVariantInfo = $productVariantInfoQuery->fetch(PDO::FETCH_ASSOC);
                            $variantName = $productVariantInfo['variantName'];
                            $variantStock = $productVariantInfo['stockQuantity'];

                            if($productType == "Masaüstü Bilgisayar"){
                                $productPicFolder = "MasaüstüBilgisayar";
                            } elseif ($productType == "Dizüstü Bilgisayar"){
                                $productPicFolder = "DizüstüBilgisayar";
                            } elseif ($productType == "Çevre Birimleri"){
                                $productPicFolder = "ÇevreBirimleri";
                            }elseif ($productType == "Bileşenler"){
                                $productPicFolder = "Bileşenler";
                            }elseif ($productType == "Aksesuar"){
                                $productPicFolder = "Aksesuar";
                            }

                            if($productCurrencyUnit == "USD"){
                                $productPriceCalculator = $productPrice * $usdChangeRate;
                            } elseif ($productCurrencyUnit == "EUR"){
                                $productPriceCalculator = $productPrice * $euroChangeRate;
                            } else {
                                $productPriceCalculator = $productPrice;
                            }
                            $totalProductPrice = $productPriceCalculator * $numberOfProducts;

                            $counter += $numberOfProducts;
                            $totalPriceOfCart += $productPriceCalculator * $numberOfProducts;
                ?>
                <tr height="100">
                    <td valign="bottom" align="left">
                        <table width="800" align="center" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td width="80" style="border-bottom: 1px dashed #CCCCCC;" align="left">
                                    <img src="pictures/products/<?= $productPicFolder ?>/<?= backChanges($productPicture) ?>" border="0" width="60" height="80">
                                </td>
                                <td width="40" style="border-bottom: 1px dashed #CCCCCC;" align="left">
                                    <a href="index.php?pageNo=96&id=<?= backChanges($cartId) ?>"><img src="pictures/cross-button.png" border="0"></a>
                                </td>
                                <td width="530" style="border-bottom: 1px dashed #CCCCCC;" align="left">
                                    <?= backChanges($productName) ?> <br> <?= backChanges($productVariantTitle) ?> : <?= backChanges($variantName) ?>
                                </td>
                                <td width="90" style="border-bottom: 1px dashed #CCCCCC;" align="left">
                                    <table width="90" align="center" border="0" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td width="30" align="right"><a href="index.php?pageNo=97&id=<?= backChanges($cartId) ?>" style="text-decoration: none; color: #646464;"><?php if($numberOfProducts > 1){ ?><img src="pictures/minus-sign.png" border="0" style="margin-top: 5px;"></a><?php } ?></td>
                                            <td width="30" align="center"><?= backChanges($numberOfProducts) ?></td>
                                            <td width="30" align="left"><a href="index.php?pageNo=98&id=<?= backChanges($cartId) ?>"><img src="pictures/plus-sign.png" border="0" style="margin-top: 5px;"></a></td>
                                        </tr>
                                    </table>
                                </td>
                                <td width="150" style="border-bottom: 1px dashed #CCCCCC;" align="right">
                                    <?= priceFormat($productPriceCalculator) ?> TL <br> <?= priceFormat($totalProductPrice) ?> TL
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <?php
                    }
                } else {
                    $counter = 0;
                    $totalPriceOfCart = "0";
                ?>
                <tr height="30">
                    <td valign="bottom" align="left"><b>Alışveriş Sepetinizde Ürün Bulunmamaktadır.</b></td>
                </tr>
                <?php
                }
                ?>
            </table>
        </td>
        <td width="15">&nbsp;</td>
        <td width="250" valign="top">
            <table width="250" align="center" border="0" cellpadding="0" cellspacing="0">
                <tr height="40">
                    <td style="color: #FF9900;" align="right"><h3>Sipariş Özeti</h3></td>
                </tr>
                <tr height="30">
                    <td valign="top" style="border-bottom: 1px dashed #CCCCCC; " align="right">Toplam <b style="color: red;"><?= $counter ?></b> Adet Ürün</td>
                </tr>
                <tr height="5">
                    <td height="5" style="font-size: 5px;">&nbsp;</td>
                </tr>
                <tr height="">
                    <td height="" align="right">Ödenecek Tutar (KDV Dahil)</td>
                </tr>
                <tr height="">
                    <td height="" align="right" style="font-size: 25px; font-weight: bold;"><?= priceFormat($totalPriceOfCart) ?> TL</td>
                </tr>
                <tr height="10">
                    <td height="10" style="font-size: 10px;">&nbsp;</td>
                </tr>
                <tr height="">
                    <td><div class="shoppingCartButton"><a href="index.php?pageNo=100" style="color: white; font-size: 20px; font-weight: bold; text-decoration: none;"><img src="pictures/shopping-cart.png" border="0" style="margin-top: 5px;"><div>Sipariş Ver</div></a></div></td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<?php
} else {
    header("Location:index.php");
}
?>