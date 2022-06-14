<?php

if(isset($_SESSION['user'])){

$paginationCount = 2;
$contentPerPage = 1;

$totalContentQuery = $db->prepare("SELECT DISTINCT (orderNumber) FROM orders WHERE userId = ? ORDER BY orderNumber DESC");
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
                    <td colspan="8" style="color: #FF9900;"><h3>Hesabım > Siparişler</h3></td>
                </tr>
                <tr height="30">
                    <td colspan="8" valign="top" style="border-bottom: 1px dashed #CCCCCC;">Tüm Siparişlerinizi Bu Alandan Görüntüleyebilirsiniz.</td>
                </tr>
                <tr height="50">
                    <td width="125" align="left" style="background: #F8FFA7; color: black;">&nbsp;Sipariş Numarası</td>
                    <td width="75" align="left" style="background: #F8FFA7; color: black;">Resim</td>
                    <td width="50" align="left" style="background: #F8FFA7; color: black;">Yorum</td>
                    <td width="415" align="left" style="background: #F8FFA7; color: black;">Adı</td>
                    <td width="100" align="left" style="background: #F8FFA7; color: black;">Fiyatı</td>
                    <td width="50" align="left" style="background: #F8FFA7; color: black;">Adet</td>
                    <td width="100" align="left" style="background: #F8FFA7; color: black;">Toplam Fiyat</td>
                    <td width="150" align="left" style="background: #F8FFA7; color: black;">Kargo Durumu / Takip</td>
                </tr>
                <?php
                    $orderNumberQuery = $db->prepare("SELECT DISTINCT (orderNumber) FROM orders WHERE userId = ? ORDER BY orderNumber DESC LIMIT $initialContentOfPagination, $contentPerPage");
                    $orderNumberQuery->execute([$userID]);
                    $orderNumberCount = $orderNumberQuery->rowCount();
                    $orderNumbers = $orderNumberQuery->fetchAll(PDO::FETCH_ASSOC);
                    
                    if($orderNumberCount > 0){
                        foreach($orderNumbers as $orderNumber){
                            $orderNo = backChanges($orderNumber['orderNumber']);

                            $ordersQuery = $db->prepare("SELECT * FROM orders WHERE userId = ? AND orderNumber = ? ORDER BY id ASC");
                            $ordersQuery->execute([$userID, $orderNo]);
                            $orders = $ordersQuery->fetchAll(PDO::FETCH_ASSOC);

                            foreach($orders as $order){
                                $productType = backChanges($order['productType']);
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

                                $shipmentSituation = backChanges($order['shipmentSituation']);
                                if($shipmentSituation == 0){
                                    $shipmentInfo = 'Beklemede.';
                                } else {
                                    $shipmentInfo = backChanges($order['shipmentCode']);
                                }
                ?>
                        <tr>
                            <td width="125" align="left">&nbsp;#<?= backChanges($order['orderNumber']); ?></td>
                            <td width="75" align="left"><img src="pictures/products/<?= $productPicFolder; ?>/<?= backChanges($order['productPic1']); ?>" border="0" width="60" height="80"></td>
                            <td width="50" align="left"><a href="index.php?pageNo=75&productId=<?= backChanges($order['productId']); ?>"><img src="pictures/writing.png" border="0"></a></td>
                            <td width="415" align="left"><?= backChanges($order['productName']); ?></td>
                            <td width="100" align="left"><?= priceFormat(backChanges($order['productPrice'])); ?> TL</td>
                            <td width="50" align="left"><?= backChanges($order['numberOfProducts']); ?></td>
                            <td width="100" align="left"><?= priceFormat(backChanges($order['totalProductAmount'])); ?> TL</td>
                            <td width="150" align="left"><?= $shipmentInfo ?></td>
                        </tr>
                <?php
                            }
                ?>
                        <tr height="30">
                            <td colspan="8"><hr></td>
                        </tr>
                <?php
                        }
                        if($totalPage > 1){
                ?>
                        <tr height="50">
                            <td colspan="8" align="center">
                                <div class="pagination">
                                    <div class="totalPageInfo">
                                        Toplam <?= $totalPage ?> sayfada, <?= $totalContentCount ?> adet kayıt bulunmaktadır.
                                    </div>
                                    <div class="totalPageNumber">
                                        <?php
                                            if($pagination > 1){
                                                echo '<span class="paginationPassive"><a href="index.php?pageNo=61&pagination=1"><<</a></span>';
                                                $back = $pagination - 1;
                                                echo '<span class="paginationPassive"> <a href="index.php?pageNo=61&pagination='. $back .'"><</a> </span>';
                                            }
                                            for($i = $pagination - $paginationCount; $i <= $pagination + $paginationCount; $i++){
                                                if(($i > 0) && ($i <= $totalPage)){
                                                    if($pagination == $i){
                                                        echo '<span class="paginationActive">'. $i .'</span>';
                                                    } else {
                                                        echo '<span class="paginationPassive"> <a href="index.php?pageNo=61&pagination='. $i .'">'. $i .'</a></span>';
                                                    }
                                                }
                                            }
                                            if($pagination != $totalPage){
                                                $forward = $pagination + 1;
                                                echo '<span class="paginationPassive"> <a href="index.php?pageNo=61&pagination='. $forward .'">></a> </span>';
                                                echo '<span class="paginationPassive"> <a href="index.php?pageNo=61&pagination='. $totalPage .'">>></a> </span>';
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
                            <td colspan="8" height="50" align="left">Sisteme Kayıtlı Siparişiniz Bulunmamaktadır.</td>
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