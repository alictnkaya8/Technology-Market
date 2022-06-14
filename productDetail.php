<?php
if(isset($_GET['id'])){
    $id = onlyAllowNumbers(filterVariable($_GET['id']));

    $productViewQuery =  $db->prepare("UPDATE products SET views = views + 1 WHERE id = ? AND productSituation = ? LIMIT 1");
    $productViewQuery->execute([$id, 1]);

    $productQuery =  $db->prepare("SELECT * FROM products WHERE id = ? AND productSituation = ? LIMIT 1");
    $productQuery->execute([$id, 1]);
    $productCount = $productQuery->rowCount();
    $product = $productQuery->fetch(PDO::FETCH_ASSOC); 

    if($productCount > 0){
        $productType = $product['productType'];

        if($productType == 'Masaüstü Bilgisayar'){
            $productPicFolder = 'MasaüstüBilgisayar';
        } elseif($productType == 'Dizüstü Bilgisayar'){
            $productPicFolder = 'DizüstüBilgisayar';
        } elseif($productType == 'Çevre Birimleri'){
            $productPicFolder = 'ÇevreBirimleri';
        } elseif($productType == 'Bileşenler'){
            $productPicFolder = 'Bileşenler';
        } elseif($productType == 'Aksesuar'){
            $productPicFolder = 'Aksesuar';
        }

        $productPrice = backChanges($product['productPrice']);
        $productCurrencyUnit = backChanges($product['currencyUnit']);

        if($productCurrencyUnit == "USD"){
            $productPriceCalculator = $productPrice * $usdChangeRate;
        } elseif ($productCurrencyUnit == "EUR"){
            $productPriceCalculator = $productPrice * $euroChangeRate;
        } else {
            $productPriceCalculator = $productPrice;
        }

?>
<table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td width="350" valign="top">
            <table width="350" align="center" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td style="border: 1px solid #CCCCCC;" align="center">
                        <img id="bigPicture" src="pictures/products/<?= $productPicFolder ?>/<?= $product['productPic1'] ?>" border="0" width="330" height="440">
                    </td>
                </tr>
                <tr>
                    <td style="font-size: 5px;">&nbsp;</td>
                </tr>
                <tr>
                    <td>
                        <table width="350" align="center" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td width="78"><img src="pictures/products/<?= $productPicFolder ?>/<?= $product['productPic1'] ?>" border="0" width="78" height="104" style="border: 1px solid #CCCCCC;" onclick="$.changeProductDetailPicture('<?= $productPicFolder ?>', '<?= $product['productPic1'] ?>');"></td>
                                <td width="10">&nbsp;</td>

                                <?php if($product['productPic2'] != ""){ ?>
                                <td width="78"><img src="pictures/products/<?= $productPicFolder ?>/<?= $product['productPic2'] ?>" border="0" width="78" height="104" style="border: 1px solid #CCCCCC;" onclick="$.changeProductDetailPicture('<?= $productPicFolder ?>', '<?= $product['productPic2'] ?>');"></td>
                                <td width="10">&nbsp;</td>
                                <?php } else { ?>
                                    <td width="78">&nbsp;</td>
                                <?php } ?>

                                <?php if($product['productPic3'] != ""){ ?>
                                <td width="78"><img src="pictures/products/<?= $productPicFolder ?>/<?= $product['productPic3'] ?>" border="0" width="78" height="104" style="border: 1px solid #CCCCCC;" onclick="$.changeProductDetailPicture('<?= $productPicFolder ?>', '<?= $product['productPic3'] ?>');"></td>
                                <td width="10">&nbsp;</td>
                                <?php } else { ?>
                                    <td width="78">&nbsp;</td>
                                <?php } ?>

                                <?php if($product['productPic4'] != ""){ ?>
                                <td width="78"><img src="pictures/products/<?= $productPicFolder ?>/<?= $product['productPic4'] ?>" border="0" width="78" height="104" style="border: 1px solid #CCCCCC;" onclick="$.changeProductDetailPicture('<?= $productPicFolder ?>', '<?= $product['productPic4'] ?>');"></td>
                                <td width="10">&nbsp;</td>
                                <?php } else { ?>
                                    <td width="78">&nbsp;</td>
                                <?php } ?>

                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>

        <td width="15" valign="top">&nbsp;</td>

        <td width="700" valign="top">
            <table width="700" align="center" border="0" cellpadding="0" cellspacing="0">
                <tr height="50">
                    <td bgcolor="#F1F1F1" style="font-size: 20px;"><b>&nbsp;ÜRÜN BİLGİLERİ</b></td>
                </tr>
                <tr height="50">
                    <td style="text-align: left; font-size: 18px; font-weight: bold;">&nbsp;<?= backChanges($product['productName']) ?></td>
                </tr>
                <tr>
                    <td>
                        <form action="index.php?pageNo=92&id=<?= $product['id'] ?>" method="post">
                            <table width="700" align="center" border="0" cellpadding="0" cellspacing="0">
                                <tr height="40">
                                    <td width="20" style="padding-top: 5px;">
                                    <?php if(isset($_SESSION['user'])){ ?>
                                        <a href="index.php?pageNo=88&id=<?= $product['id'] ?>"><img src="pictures/fav.png" border="0"></a>
                                    <?php } else { ?>
                                        <img src="pictures/fav.png" border="0">
                                    <?php } ?>
                                    </td>

                                    <td width="10">&nbsp;</td>

                                    <td width="640">
                                        <input type="submit" value="Sepete Ekle" class="addToCartButton">
                                    </td>
                                </tr>
                                <tr height="40">
                                    <td colspan="5">
                                        <table width="700" align="center" border="0" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td width="500" align="left">
                                                    <select name="variant" class="SelectAlanlari">
                                                        <option value="">Lütfen <?= $product['variantTitle'] ?> Seçiniz</option>
                                                        <?php 
                                                            $variantQuery =  $db->prepare("SELECT * FROM variants WHERE productId = ? AND stockQuantity > 0 ORDER BY variantName ASC");
                                                            $variantQuery->execute([$product['id']]);
                                                            $variantCount = $variantQuery->rowCount();
                                                            $variants = $variantQuery->fetchAll(PDO::FETCH_ASSOC);

                                                            foreach($variants as $variant){
                                                        ?>
                                                        <option value="<?= $variant['id'] ?>"><?= $variant['variantName'] ?></option>
                                                        <?php
                                                            }
                                                        ?>
                                                    </select>
                                                </td>
                                                <td width="200" align="right" style="font-size: 24px; color: black; font-weight: bold;"><?= priceFormat($productPriceCalculator) ?> TL</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </td>
                </tr>
                <tr>
                    <td><hr></td>
                </tr>
                <tr height="30">
                    <td style="background: #FF9900; color: white;">&nbsp;Ürün Açıklaması</td>
                </tr>
                <tr>
                    <td><?= backChanges($product['productDescription']) ?></td>
                </tr>
                <tr>
                    <td><hr></td>
                </tr>
                <tr height="30">
                    <td style="background: #FF9900; color: white;">&nbsp;Ürün Yorumları</td>
                </tr>
                <tr>
                    <td>
                        <div style="width: 700px; max-width: 700px; height: 300px; max-height: 300px; overflow-y: scroll;">
                            <table width="680" align="left" border="0" cellpadding="0" cellspacing="0">
                            <?php 
                                $commentsQuery =  $db->prepare("SELECT * FROM comments WHERE productId = ? ORDER BY commentDate DESC");
                                $commentsQuery->execute([$product['id']]);
                                $commentCount = $commentsQuery->rowCount();
                                $comments = $commentsQuery->fetchAll(PDO::FETCH_ASSOC);

                                if($commentCount > 0){
                                    foreach($comments as $comment){
                                        $commentPoint = backChanges($comment['point']);

                                        if($commentPoint == 1){
                                            $showPoint = "1 yıldız";
                                        } elseif($commentPoint == 2){
                                            $showPoint = "2 yıldız";
                                        } elseif($commentPoint == 3){
                                            $showPoint = "3 yıldız";
                                        } elseif($commentPoint == 4){
                                            $showPoint = "4 yıldız";
                                        } elseif($commentPoint == 5){
                                            $showPoint = "5 yıldız";
                                        }

                                        $userQuery =  $db->prepare("SELECT * FROM users WHERE id = ? LIMIT 1");
                                        $userQuery->execute([$comment['userId']]);
                                        $user = $userQuery->fetch(PDO::FETCH_ASSOC);
                            ?>
                                <tr height="30">
                                    <td width="65"><?= $showPoint ?></td>
                                    <td width="10"> &nbsp; </td>
                                    <td width="445"> <?= $user['nameSurname'] ?> </td>
                                    <td width="10"> &nbsp; </td>
                                    <td width="150" align="right"><?= date("d.m.Y H:i:s", backChanges($comment['commentDate'])) ?></td>
                                </tr>
                                <tr>
                                    <td colspan="5" style="border-bottom: 1px dashed #CCCCCC;"><?= backChanges($comment['comment']) ?></td>
                                </tr>
                            <?php
                                    }
                                } else {
                            ?>
                                <tr height="30">
                                    <td> Bu ürüne henüz yorum yapılmamış. </td>
                                </tr>
                            <?php
                                }
                            ?>
                            </table>
                        </div>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<?php
    } else {
        header('Location:index.php');
        exit();
    }
} else {
    header('Location:index.php');
    exit();
}
?>