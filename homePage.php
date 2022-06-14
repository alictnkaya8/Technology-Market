<table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
    <tr height="75" bgcolor="#FF9900">
        <td align="left"><h2 style="color:white;">ANA SAYFA</h2></td>
    </tr>
    <tr height="10">
        <td></td>
    </tr>
    <tr height="35">
        <td bgcolor="#FF9900" style="color: white; font-size: 18px; font-weight: bold;">&nbsp;En Yeni Ürünler</td>
    </tr>
    <tr height="10">
        <td></td>
    </tr>
    <tr>
        <td>
            <table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
                <?php
                $newProductsQuery = $db->prepare("SELECT * FROM products WHERE productSituation = '1' ORDER BY id DESC LIMIT 5");
                $newProductsQuery->execute();
                $newProductCount = $newProductsQuery->rowCount();
                $newProducts = $newProductsQuery->fetchAll(PDO::FETCH_ASSOC);

                $counter = 1;

                foreach($newProducts as $newProduct){
                    $newProductPrice = backChanges($newProduct['productPrice']);
                    $newProductType = backChanges($newProduct['productType']);
                    $newProductCurrencyUnit = backChanges($newProduct['currencyUnit']);

                    if($newProductCurrencyUnit == "USD"){
                        $newProductPriceCalculator = $newProductPrice * $usdChangeRate;
                    } elseif ($newProductCurrencyUnit == "EUR"){
                        $newProductPriceCalculator = $newProductPrice * $euroChangeRate;
                    } else {
                        $newProductPriceCalculator = $newProductPrice;
                    }

                    if($newProductType == "Masaüstü Bilgisayar"){
                        $newProductPicFolder = "MasaüstüBilgisayar";
                    } elseif ($newProductType == "Dizüstü Bilgisayar"){
                        $newProductPicFolder = "DizüstüBilgisayar";
                    } elseif ($newProductType == "Çevre Birimleri"){
                        $newProductPicFolder = "ÇevreBirimleri";
                    }elseif ($newProductType == "Bileşenler"){
                        $newProductPicFolder = "Bileşenler";
                    }elseif ($newProductType == "Aksesuar"){
                        $newProductPicFolder = "Aksesuar";
                    }

                    $totalCommentsOfProduct = backChanges($newProduct['numberOfComments']);
                    $totalPointsOfProduct = backChanges($newProduct['totalCommentPoints']);

                    if($totalCommentsOfProduct > 0){
                        $avaragePointOfProduct = number_format($totalPointsOfProduct / $totalCommentsOfProduct, 1, '.', '');
                    } else {
                        $avaragePointOfProduct = 0;
                    }
            ?>
                    <td width="205" valign="top">
                        <table width="205" align="left" border="0" cellpadding="0" cellspacing="0" style="border: 1px solid #A0A0A0; margin-bottom: 20px;">
                            <tr height="40">
                                <td align="center"><a href="index.php?pageNo=82&id=<?= backChanges($newProduct['id']) ?>"><img src="pictures/products/<?= $newProductPicFolder ?>/<?php echo $newProduct["productPic1"]; ?>" border="0" width="205" height="273"></a></td>
                            </tr>
                            <tr height="25">
                                <td width="205" align="center"><a href="index.php?pageNo=82&id=<?= backChanges($newProduct['id']) ?>" style="color: #FF0000; font-weight: bold; text-decoration: none;"><?= $newProductType ?></a></td>
                            </tr>
                            <tr height="25">
                                <td width="205" align="center"><a href="index.php?pageNo=82&id=<?= backChanges($newProduct['id']) ?>" style="color: #646464; font-weight: bold; text-decoration: none;">
                                    <div style="width: 205px; max-width: 205px; height: 20px; overflow: hidden; line-height: 20px;">
                                        <?= backChanges($newProduct['productName']) ?>
                                    </div>
                            </a></td>
                            </tr>
                            <tr height="25">
                                <td width="205" align="center"><?= $avaragePointOfProduct ?> Puan (<?= $totalCommentsOfProduct ?>)</td>
                            </tr>
                            <tr height="25">
                                <td width="205" align="center"><a href="index.php?pageNo=82&id=<?= backChanges($newProduct['id']) ?>" style="color: #000099; font-weight: bold; text-decoration: none;"><?= priceFormat($newProductPriceCalculator) ?> TL</a></td>
                            </tr>
                            <tr height="10">
                                <td width="205" align="center"></td>
                            </tr>
                        </table>
                    </td>
                <?php if($counter < 5): ?>
                    <td width="20">&nbsp;</td>
                <?php endif; ?>
        <?php
                $counter++;
        }
        ?>
        </tr>
            </table>
        </td>
    </tr>
    <tr height="35">
        <td bgcolor="#FF9900" style="color: white; font-size: 18px; font-weight: bold;">&nbsp;En Popüler Ürünler</td>
    </tr>
    <tr height="10">
        <td></td>
    </tr>
    <tr>
        <td>
            <table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
                <?php
                $mostPopularsQuery = $db->prepare("SELECT * FROM products WHERE productSituation = '1' ORDER BY views DESC LIMIT 5");
                $mostPopularsQuery->execute();
                $mostPopularCount = $mostPopularsQuery->rowCount();
                $mostPopulars = $mostPopularsQuery->fetchAll(PDO::FETCH_ASSOC);

                $counter = 1;

                foreach($mostPopulars as $mostPopular){
                    $mostPopularPrice = backChanges($mostPopular['productPrice']);
                    $mostPopularType = backChanges($mostPopular['productType']);
                    $mostPopularCurrencyUnit = backChanges($mostPopular['currencyUnit']);

                    if($mostPopularCurrencyUnit == "USD"){
                        $mostPopularPriceCalculator = $mostPopularPrice * $usdChangeRate;
                    } elseif ($mostPopularCurrencyUnit == "EUR"){
                        $mostPopularPriceCalculator = $mostPopularPrice * $euroChangeRate;
                    } else {
                        $mostPopularPriceCalculator = $mostPopularPrice;
                    }

                    if($mostPopularType == "Masaüstü Bilgisayar"){
                        $mostPopularPicFolder = "MasaüstüBilgisayar";
                    } elseif ($mostPopularType == "Dizüstü Bilgisayar"){
                        $mostPopularPicFolder = "DizüstüBilgisayar";
                    } elseif ($mostPopularType == "Çevre Birimleri"){
                        $mostPopularPicFolder = "ÇevreBirimleri";
                    }elseif ($mostPopularType == "Bileşenler"){
                        $mostPopularPicFolder = "Bileşenler";
                    }elseif ($mostPopularType == "Aksesuar"){
                        $mostPopularPicFolder = "Aksesuar";
                    }

                    $totalCommentsOfProduct = backChanges($mostPopular['numberOfComments']);
                    $totalPointsOfProduct = backChanges($mostPopular['totalCommentPoints']);

                    if($totalCommentsOfProduct > 0){
                        $avaragePointOfProduct = number_format($totalPointsOfProduct / $totalCommentsOfProduct, 1, '.', '');
                    } else {
                        $avaragePointOfProduct = 0;
                    }
            ?>
                    <td width="205" valign="top">
                        <table width="205" align="left" border="0" cellpadding="0" cellspacing="0" style="border: 1px solid #A0A0A0; margin-bottom: 20px;">
                            <tr height="40">
                                <td align="center"><a href="index.php?pageNo=82&id=<?= backChanges($mostPopular['id']) ?>"><img src="pictures/products/<?= $mostPopularPicFolder ?>/<?php echo $mostPopular["productPic1"]; ?>" border="0" width="205" height="273"></a></td>
                            </tr>
                            <tr height="25">
                                <td width="205" align="center"><a href="index.php?pageNo=82&id=<?= backChanges($mostPopular['id']) ?>" style="color: #FF0000; font-weight: bold; text-decoration: none;"><?= $mostPopularType ?></a></td>
                            </tr>
                            <tr height="25">
                                <td width="205" align="center"><a href="index.php?pageNo=82&id=<?= backChanges($mostPopular['id']) ?>" style="color: #646464; font-weight: bold; text-decoration: none;">
                                    <div style="width: 205px; max-width: 205px; height: 20px; overflow: hidden; line-height: 20px;">
                                        <?= backChanges($mostPopular['productName']) ?>
                                    </div>
                            </a></td>
                            </tr>
                            <tr height="25">
                                <td width="205" align="center"><?= $avaragePointOfProduct ?> Puan (<?= $totalCommentsOfProduct ?>)</td>
                            </tr>
                            <tr height="25">
                                <td width="205" align="center"><a href="index.php?pageNo=82&id=<?= backChanges($mostPopular['id']) ?>" style="color: #000099; font-weight: bold; text-decoration: none;"><?= priceFormat($mostPopularPriceCalculator) ?> TL</a></td>
                            </tr>
                            <tr height="10">
                                <td width="205" align="center"></td>
                            </tr>
                        </table>
                    </td>
                <?php if($counter < 5): ?>
                    <td width="20">&nbsp;</td>
                <?php endif; ?>
        <?php
                $counter++;
        }
        ?>
        </tr>
            </table>
        </td>
    </tr>
    <tr height="35">
        <td bgcolor="#FF9900" style="color: white; font-size: 18px; font-weight: bold;">&nbsp;En Çok Satan Ürünler</td>
    </tr>
    <tr height="10">
        <td></td>
    </tr>
    <tr>
        <td>
            <table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
                <?php
                $mostSellProductsQuery = $db->prepare("SELECT * FROM products WHERE productSituation = '1' ORDER BY totalNumberOfSales DESC LIMIT 5");
                $mostSellProductsQuery->execute();
                $mostSellProductCount = $mostSellProductsQuery->rowCount();
                $mostSellProducts = $mostSellProductsQuery->fetchAll(PDO::FETCH_ASSOC);

                $counter = 1;

                foreach($mostSellProducts as $mostSellProduct){
                    $mostSellProductPrice = backChanges($mostSellProduct['productPrice']);
                    $mostSellProductType = backChanges($mostSellProduct['productType']);
                    $mostSellProductCurrencyUnit = backChanges($mostSellProduct['currencyUnit']);

                    if($mostSellProductCurrencyUnit == "USD"){
                        $mostSellProductPriceCalculator = $mostSellProductPrice * $usdChangeRate;
                    } elseif ($mostSellProductCurrencyUnit == "EUR"){
                        $mostSellProductPriceCalculator = $mostSellProductPrice * $euroChangeRate;
                    } else {
                        $mostSellProductPriceCalculator = $mostSellProductPrice;
                    }

                    if($mostSellProductType == "Masaüstü Bilgisayar"){
                        $mostSellProductPicFolder = "MasaüstüBilgisayar";
                    } elseif ($mostSellProductType == "Dizüstü Bilgisayar"){
                        $mostSellProductPicFolder = "DizüstüBilgisayar";
                    } elseif ($mostSellProductType == "Çevre Birimleri"){
                        $mostSellProductPicFolder = "ÇevreBirimleri";
                    }elseif ($mostSellProductType == "Bileşenler"){
                        $mostSellProductPicFolder = "Bileşenler";
                    }elseif ($mostSellProductType == "Aksesuar"){
                        $mostSellProductPicFolder = "Aksesuar";
                    }

                    $totalCommentsOfProduct = backChanges($mostSellProduct['numberOfComments']);
                    $totalPointsOfProduct = backChanges($mostSellProduct['totalCommentPoints']);

                    if($totalCommentsOfProduct > 0){
                        $avaragePointOfProduct = number_format($totalPointsOfProduct / $totalCommentsOfProduct, 1, '.', '');
                    } else {
                        $avaragePointOfProduct = 0;
                    }
            ?>
                    <td width="205" valign="top">
                        <table width="205" align="left" border="0" cellpadding="0" cellspacing="0" style="border: 1px solid #A0A0A0; margin-bottom: 20px;">
                            <tr height="40">
                                <td align="center"><a href="index.php?pageNo=82&id=<?= backChanges($mostSellProduct['id']) ?>"><img src="pictures/products/<?= $mostSellProductPicFolder ?>/<?php echo $mostSellProduct["productPic1"]; ?>" border="0" width="205" height="273"></a></td>
                            </tr>
                            <tr height="25">
                                <td width="205" align="center"><a href="index.php?pageNo=82&id=<?= backChanges($mostSellProduct['id']) ?>" style="color: #FF0000; font-weight: bold; text-decoration: none;"><?= $mostSellProductType ?></a></td>
                            </tr>
                            <tr height="25">
                                <td width="205" align="center"><a href="index.php?pageNo=82&id=<?= backChanges($mostSellProduct['id']) ?>" style="color: #646464; font-weight: bold; text-decoration: none;">
                                    <div style="width: 205px; max-width: 205px; height: 20px; overflow: hidden; line-height: 20px;">
                                        <?= backChanges($mostSellProduct['productName']) ?>
                                    </div>
                            </a></td>
                            </tr>
                            <tr height="25">
                                <td width="205" align="center"><?= $avaragePointOfProduct ?> Puan (<?= $totalCommentsOfProduct ?>)</td>
                            </tr>
                            <tr height="25">
                                <td width="205" align="center"><a href="index.php?pageNo=82&id=<?= backChanges($mostSellProduct['id']) ?>" style="color: #000099; font-weight: bold; text-decoration: none;"><?= priceFormat($mostSellProductPriceCalculator) ?> TL</a></td>
                            </tr>
                            <tr height="10">
                                <td width="205" align="center"></td>
                            </tr>
                        </table>
                    </td>
                <?php if($counter < 5): ?>
                    <td width="20">&nbsp;</td>
                <?php endif; ?>
        <?php
                $counter++;
        }
        ?>
        </tr>
            </table>
        </td>
    </tr>
</table>