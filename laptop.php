<?php
if(isset($_REQUEST['menuId'])){
    $menuId = onlyAllowNumbers(filterVariable($_REQUEST['menuId']));
    $menuCondition = "AND menuId = $menuId";
    $paginationCondition = "&menuId=" . $menuId;
} else {
    $menuId = "";
    $menuCondition = "";
    $paginationCondition = "";
}
if(isset($_REQUEST['search'])){
    $search = filterVariable($_REQUEST['search']);
    $searchCondition = "AND productName LIKE '%" . $search . "%'";
    $paginationCondition .= "&search=" . $search;
} else {
    $searchCondition = "";
    $paginationCondition .= "";
}
$paginationCount = 2;
$contentPerPage = 8;

$totalContentQuery = $db->prepare("SELECT * FROM products WHERE productType = 'Dizüstü Bilgisayar' AND productSituation = '1' $menuCondition $searchCondition ORDER BY id DESC");
$totalContentQuery->execute();
$totalContentCount = $totalContentQuery->rowCount();

$initialContentOfPagination = ($pagination * $contentPerPage) - $contentPerPage;

$totalPage = ceil($totalContentCount / $contentPerPage);
?>
<table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td width="250" align="left" valign="top">
            <table width="250" align="center" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td>
                        <table width="250" align="center" border="0" cellpadding="0" cellspacing="0">
                            <tr height="50">
                                <td bgcolor="#F1F1F1"><b>&nbsp;MENÜLER</b></td>
                            </tr>
                            <tr height="30">
                                        <td><a href="index.php?pageNo=84" style="text-decoration: none; <?php if($menuId == ""): ?> color: #FF0000; <?php else: ?> color: #646464; <?php endif; ?>  font-weight: bold;">&nbsp;Tüm Ürünler</a></td>
                                    </tr>
                            <?php
                                $menusQuery =  $db->prepare("SELECT * FROM menus WHERE productType = 'Dizüstü Bilgisayar'");
                                $menusQuery->execute();
                                $menuCount = $menusQuery->rowCount();
                                $menus = $menusQuery->fetchAll(PDO::FETCH_ASSOC); 

                                foreach($menus as $menu){
                            ?>
                                    <tr height="30">
                                        <td><a href="index.php?pageNo=84&menuId=<?= $menu['id'] ?>" style="text-decoration: none; <?php if($menuId == $menu['id']): ?> color: #FF0000; <?php else: ?> color: #646464; <?php endif; ?>  font-weight: bold;">&nbsp;<?= backChanges($menu['menuName']) ?></a></td>
                                    </tr>
                            <?php
                                }
                            ?>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
        <td width="11" align="left">&nbsp;</td>
        <td width="795" align="left" valign="top">
            <table width="795" align="center" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td>
                        <div class="searchArea">
                            <form action="<?php if($menuCondition != ""): ?>index.php?pageNo=84&menuId=<?= $menuId ?><?php else: ?>index.php?pageNo=84<?php endif; ?>" method="post">
                                <div class="searchAreaButtonDiv">
                                    <input type="submit" value="" class="searchAreaButton">
                                </div>
                                <div class="searchAreaInputDiv">
                                    <input type="text" name="search" class="searchAreaInput">
                                </div>
                            </form>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>
                        <table width="795" align="center" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                ÜRÜNLERİ LİSTELE
                                <?php
                                $productsQuery = $db->prepare("SELECT * FROM products WHERE productType = 'Dizüstü Bilgisayar' AND productSituation = '1' $menuCondition $searchCondition ORDER BY id DESC LIMIT $initialContentOfPagination, $contentPerPage");
                                $productsQuery->execute();
                                $productCount = $productsQuery->rowCount();
                                $products = $productsQuery->fetchAll(PDO::FETCH_ASSOC);

                                $counter = 1;
                                $rowCount = 4;

                                foreach($products as $product){
                                    $productPrice = backChanges($product['productPrice']);
                                    $productCurrencyUnit = backChanges($product['currencyUnit']);

                                    if($productCurrencyUnit == "USD"){
                                        $productPriceCalculator = $productPrice * $usdChangeRate;
                                    } elseif ($productCurrencyUnit == "EUR"){
                                        $productPriceCalculator = $productPrice * $euroChangeRate;
                                    } else {
                                        $productPriceCalculator = $productPrice;
                                    }

                                    $totalCommentsOfProduct = backChanges($product['numberOfComments']);
                                    $totalPointsOfProduct = backChanges($product['totalCommentPoints']);

                                    if($totalCommentsOfProduct > 0){
                                        $avaragePointOfProduct = number_format($totalPointsOfProduct / $totalCommentsOfProduct, 1, '.', '');
                                    } else {
                                        $avaragePointOfProduct = 0;
                                    }
                            ?>
                                        <td width="191" valign="top">
                                            <table width="191" align="left" border="0" cellpadding="0" cellspacing="0" style="border: 1px solid #A0A0A0; margin-bottom: 20px;">
                                                <tr height="40">
                                                    <td align="center"><a href="index.php?pageNo=82&id=<?= backChanges($product['id']) ?>"><img src="pictures/products/DizüstüBilgisayar/<?php echo $product["productPic1"]; ?>" border="0" width="185" height="247"></a></td>
                                                </tr>
                                                <tr height="25">
                                                    <td width="191" align="center"><a href="index.php?pageNo=82&id=<?= backChanges($product['id']) ?>" style="color: #FF0000; font-weight: bold; text-decoration: none;">Dizüstü Bilgisayar</a></td>
                                                </tr>
                                                <tr height="25">
                                                    <td width="191" align="center"><a href="index.php?pageNo=82&id=<?= backChanges($product['id']) ?>" style="color: #646464; font-weight: bold; text-decoration: none;">
                                                        <div style="width: 191px; max-width: 191px; height: 20px; overflow: hidden; line-height: 20px;">
                                                            <?= backChanges($product['productName']) ?>
                                                        </div>
                                                </a></td>
                                                </tr>
                                                <tr height="25">
                                                    <td width="191" align="center"><?= $avaragePointOfProduct ?> Puan (<?= $totalCommentsOfProduct ?>)</td>
                                                </tr>
                                                <tr height="25">
                                                    <td width="191" align="center"><a href="index.php?pageNo=82&id=<?= backChanges($product['id']) ?>" style="color: #000099; font-weight: bold; text-decoration: none;"><?= priceFormat($productPriceCalculator) ?> TL</a></td>
                                                </tr>
                                                <tr height="10">
                                                    <td width="191" align="center"></td>
                                                </tr>
                                            </table>
                                        </td>
                                    <?php if($counter < $rowCount): ?>
                                        <td width="20">&nbsp;</td>
                                    <?php endif; ?>
                            <?php
                                    $counter++;
                                    if($counter > $rowCount){
                                        echo "</tr><tr>";
                                        $counter = 1;
                                    }
                            }
                            ?>
                            </tr>
                            <?php
                            if($totalPage > 1){
                            ?>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr height="50">
                                <td align="center" colspan="8">
                                    <div class="pagination">
                                        <div class="totalPageInfo">
                                            Toplam <?= $totalPage ?> sayfada, <?= $totalContentCount ?> adet kayıt bulunmaktadır.
                                        </div>
                                        <div class="totalPageNumber">
                                            <?php
                                                if($pagination > 1){
                                                    echo '<span class="paginationPassive"><a href="index.php?pageNo=84' . $paginationCondition . '&pagination=1"><<</a></span>';
                                                    $back = $pagination - 1;
                                                    echo '<span class="paginationPassive"> <a href="index.php?pageNo=84' . $paginationCondition . '&pagination='. $back . '"><</a> </span>';
                                                }
                                                for($i = $pagination - $paginationCount; $i <= $pagination + $paginationCount; $i++){
                                                    if(($i > 0) && ($i <= $totalPage)){
                                                        if($pagination == $i){
                                                            echo '<span class="paginationActive">'. $i .'</span>';
                                                        } else {
                                                            echo '<span class="paginationPassive"> <a href="index.php?pageNo=84' . $paginationCondition . '&pagination='. $i .'">'. $i .'</a></span>';
                                                        }
                                                    }
                                                }
                                                if($pagination != $totalPage){
                                                    $forward = $pagination + 1;
                                                    echo '<span class="paginationPassive"> <a href="index.php?pageNo=84' . $paginationCondition . '&pagination='. $forward .'">></a> </span>';
                                                    echo '<span class="paginationPassive"> <a href="index.php?pageNo=84' . $paginationCondition . '&pagination='. $totalPage .'">>></a> </span>';
                                                }
                                            ?>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <?php
                            }
                            ?>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>