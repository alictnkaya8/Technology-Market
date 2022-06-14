<?php

if(isset($_SESSION['user'])){

$paginationCount = 2;
$contentPerPage = 10;

$totalContentQuery = $db->prepare("SELECT * FROM favorites WHERE userId = ? ORDER BY id DESC");
$totalContentQuery->execute([$userID]);
$totalContentCount = $totalContentQuery->rowCount();

$initialContentOfPagination = ($pagination * $contentPerPage) - $contentPerPage;

$totalPage = ceil($totalContentCount / $contentPerPage);

?>

<table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td><hr></td>
    </tr>
    <tr>
        <td>
            <table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td width="203" style="border: 1px solid grey; text-align: center; padding: 10px 0px; font-weight: bold;"><a href="index.php?pageNo=50" style="text-decoration: none; color: black;">Üyelik Bilgilerim</a></td>
                    <td width="10">&nbsp;</td>
                    <td width="203" style="border: 1px solid grey; text-align: center; padding: 10px 0px; font-weight: bold;"><a href="index.php?pageNo=58" style="text-decoration: none; color: black;">Adreslerim</a></td>
                    <td width="10">&nbsp;</td>
                    <td width="203" style="border: 1px solid grey; text-align: center; padding: 10px 0px; font-weight: bold;"><a href="index.php?pageNo=59" style="text-decoration: none; color: black;">Favorilerim</a></td>
                    <td width="10">&nbsp;</td>
                    <td width="203" style="border: 1px solid grey; text-align: center; padding: 10px 0px; font-weight: bold;"><a href="index.php?pageNo=60" style="text-decoration: none; color: black;">Yorumlarım</a></td>
                    <td width="10">&nbsp;</td>
                    <td width="203" style="border: 1px solid grey; text-align: center; padding: 10px 0px; font-weight: bold;"><a href="index.php?pageNo=61" style="text-decoration: none; color: black;">Siparişlerim</a></td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td><hr></td>
    </tr>
    <tr>
        <td width="1065" valign="top">
            <table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
                <tr height="40">
                    <td colspan="4" style="color: #FF9900;"><h3>Hesabım > Favoriler</h3></td>
                </tr>
                <tr height="30">
                    <td colspan="4" valign="top" style="border-bottom: 1px dashed #CCCCCC;">Favorilerinize Eklediğiniz Ürünleri Bu Alandan Görüntüleyebilirsiniz.</td>
                </tr>
                <tr height="50">
                    <td width="75" align="left" style="background: #F8FFA7; color: black;">Resim</td>
                    <td width="50" align="left" style="background: #F8FFA7; color: black;">Sil</td>
                    <td width="865" align="left" style="background: #F8FFA7; color: black;">Adı</td>
                    <td width="100" align="left" style="background: #F8FFA7; color: black;">Fiyatı</td>
                </tr>
                <?php
                    $favoritesQuery = $db->prepare("SELECT * FROM favorites WHERE userId = ? ORDER BY id DESC LIMIT $initialContentOfPagination, $contentPerPage");
                    $favoritesQuery->execute([$userID]);
                    $favoritesCount = $favoritesQuery->rowCount();
                    $favorites = $favoritesQuery->fetchAll(PDO::FETCH_ASSOC);
                    
                    if($favoritesCount > 0){
                        foreach($favorites as $favorite){

                            $productsQuery = $db->prepare("SELECT * FROM products WHERE id = ? LIMIT 1");
                            $productsQuery->execute([$favorite['productId']]);
                            $product = $productsQuery->fetch(PDO::FETCH_ASSOC);

                            $productName = $product['productName'];
                            $productType = $product['productType'];
                            $productPic = $product['productPic1'];
                            $productPrice = $product['productPrice'];
                            $productCurrencyUnit = $product['currencyUnit'];

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
                ?>
                        <tr>
                            <td width="75" align="left" style="border-bottom: 1px dashed #CCCCCC;"><a href="index.php?pageNo=82&id=<?= backChanges($product['id']); ?>"><img src="pictures/products/<?= $productPicFolder; ?>/<?= backChanges($productPic); ?>" border="0" width="60" height="80"></a></td>
                            <td width="50" align="left" style="border-bottom: 1px dashed #CCCCCC;"><a href="index.php?pageNo=80&id=<?= backChanges($favorite['id']); ?>"><img src="pictures/delete.png"></a></td>
                            <td width="415" align="left" style="border-bottom: 1px dashed #CCCCCC;"><?= backChanges($productName); ?></td>
                            <td width="100" align="left" style="border-bottom: 1px dashed #CCCCCC;"><?= priceFormat(backChanges($productPrice)); ?> <?= backChanges($productCurrencyUnit); ?></td>
                        </tr>
                <?php
                            }
                        if($totalPage > 1){
                ?>
                        <tr height="50">
                            <td colspan="4" align="center">
                                <div class="pagination">
                                    <div class="totalPageInfo">
                                        Toplam <?= $totalPage ?> sayfada, <?= $totalContentCount ?> adet kayıt bulunmaktadır.
                                    </div>
                                    <div class="totalPageNumber">
                                        <?php
                                            if($pagination > 1){
                                                echo '<span class="paginationPassive"><a href="index.php?pageNo=59&pagination=1"><<</a></span>';
                                                $back = $pagination - 1;
                                                echo '<span class="paginationPassive"> <a href="index.php?pageNo=59&pagination='. $back .'"><</a> </span>';
                                            }
                                            for($i = $pagination - $paginationCount; $i <= $pagination + $paginationCount; $i++){
                                                if(($i > 0) && ($i <= $totalPage)){
                                                    if($pagination == $i){
                                                        echo '<span class="paginationActive">'. $i .'</span>';
                                                    } else {
                                                        echo '<span class="paginationPassive"> <a href="index.php?pageNo=59&pagination='. $i .'">'. $i .'</a></span>';
                                                    }
                                                }
                                            }
                                            if($pagination != $totalPage){
                                                $forward = $pagination + 1;
                                                echo '<span class="paginationPassive"> <a href="index.php?pageNo=59&pagination='. $forward .'">></a> </span>';
                                                echo '<span class="paginationPassive"> <a href="index.php?pageNo=59&pagination='. $totalPage .'">>></a> </span>';
                                            }
                                        ?>
                                    </div>
                                </div>
                            </td>
                        </tr>
                <?php
                        }
                    } else {
                ?>
                        <tr height="50">
                            <td colspan="4" height="50" align="left">Favorilere Eklenen Ürününüz Bulunmamaktadır.</td>
                        </tr>
                <?php
                    }
                ?>
            </table>
        </td>
    </tr>
</table>

<?php   
} else {
    header("Location:index.php");
}
?>