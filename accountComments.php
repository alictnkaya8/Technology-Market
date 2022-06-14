<?php

if(isset($_SESSION['user'])){

$paginationCount = 2;
$contentPerPage = 10;

$totalContentQuery = $db->prepare("SELECT * FROM comments WHERE userId = ? ORDER BY commentDate DESC");
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
                    <td colspan="2" style="color: #FF9900;"><h3>Hesabım > Yorumlar</h3></td>
                </tr>
                <tr height="30">
                    <td colspan="2" valign="top" style="border-bottom: 1px dashed #CCCCCC;">Tüm Yorumlarınızı Bu Alandan Görüntüleyebilirsiniz.</td>
                </tr>
                <tr height="50">
                    <td width="125" align="left" style="background: #F8FFA7; color: black;">&nbsp;Puan</td>
                    <td width="50" align="left" style="background: #F8FFA7; color: black;">Yorum&nbsp;</td>
                </tr>
                <?php
                    $commentsQuery = $db->prepare("SELECT * FROM comments WHERE userId = ? ORDER BY commentDate DESC LIMIT $initialContentOfPagination, $contentPerPage");
                    $commentsQuery->execute([$userID]);
                    $commentsCount = $commentsQuery->rowCount();
                    $comments = $commentsQuery->fetchAll(PDO::FETCH_ASSOC);
                    
                    if($commentsCount > 0){
                        foreach($comments as $comment){
                            $point = $comment['point'];
                            if($point == 1){
                                $showPoint = "1 yıldız";
                            } elseif($point == 2){
                                $showPoint = "2 yıldız";
                            } elseif($point == 3){
                                $showPoint = "3 yıldız";
                            } elseif($point == 4){
                                $showPoint = "4 yıldız";
                            } elseif($point == 5){
                                $showPoint = "5 yıldız";
                            }
                ?>
                        <tr>
                            <td width="85" align="left" style="border-bottom: 1px dashed #CCCCCC; padding: 15px 0px;" valign="top"><?= $showPoint ?></td>
                            <td width="980" align="left" style="border-bottom: 1px dashed #CCCCCC; padding: 15px 0px"><?= backChanges($comment['comment']); ?></td>
                        </tr>
                <?php
                        }
                    if($totalPage > 1){
                ?>
                    <tr height="50">
                        <td colspan="2" align="center">
                            <div class="pagination">
                                <div class="totalPageInfo">
                                    Toplam <?= $totalPage ?> sayfada, <?= $totalContentCount ?> adet kayıt bulunmaktadır.
                                </div>
                                <div class="totalPageNumber">
                                    <?php
                                        if($pagination > 1){
                                            echo '<span class="paginationPassive"><a href="index.php?pageNo=60&pagination=1"><<</a></span>';
                                            $back = $pagination - 1;
                                            echo '<span class="paginationPassive"> <a href="index.php?pageNo=60&pagination='. $back .'"><</a> </span>';
                                        }
                                        for($i = $pagination - $paginationCount; $i <= $pagination + $paginationCount; $i++){
                                            if(($i > 0) && ($i <= $totalPage)){
                                                if($pagination == $i){
                                                    echo '<span class="paginationActive">'. $i .'</span>';
                                                } else {
                                                    echo '<span class="paginationPassive"> <a href="index.php?pageNo=60&pagination='. $i .'">'. $i .'</a></span>';
                                                }
                                            }
                                        }
                                        if($pagination != $totalPage){
                                            $forward = $pagination + 1;
                                            echo '<span class="paginationPassive"> <a href="index.php?pageNo=60&pagination='. $forward .'">></a> </span>';
                                            echo '<span class="paginationPassive"> <a href="index.php?pageNo=60&pagination='. $totalPage .'">>></a> </span>';
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
                        <td colspan="8" height="50" align="left">Sisteme Kayıtlı Yorumunuz Bulunmamaktadır.</td>
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
    exit();
}
?>