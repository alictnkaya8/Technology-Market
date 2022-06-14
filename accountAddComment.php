<?php
if(isset($_SESSION['user'])){

    if(isset($_GET["productId"])){
        $incomingProductId = filterVariable($_GET["productId"]);
    } else {
        $incomingProductId = "";
    }
    if($incomingProductId != ""){
?>
<table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td width="600" valign="top">
            <form action="index.php?pageNo=76&productId=<?= $incomingProductId ?>" method="post">
                <table width="500" align="center" border="0" cellpadding="0" cellspacing="0">
                    <tr height="40">
                        <td style="color: #FF9900;"><h3>Hesabım > Yorum Yap</h3></td>
                    </tr>
                    <tr height="30">
                        <td valign="top" style="border-bottom: 1px dashed #CCCCCC;">Satın almış olduğunuz ürün ile ilgili yorumunu aşağıdan belirtebilirsin.</td>
                    </tr>
                    <tr height="30">
                        <td valign="bottom" align="left">Puanlama</td>
                    </tr>
                    <tr height="30">
                        <td valign="top" align="left">
                            <table width="360" align="left" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td width="64">1 yıldız</td>
                                    <td width="10">&nbsp;</td>
                                    <td width="64">2 yıldız</td>
                                    <td width="10">&nbsp;</td>
                                    <td width="64">3 yıldız</td>
                                    <td width="10">&nbsp;</td>
                                    <td width="64">4 yıldız</td>
                                    <td width="10">&nbsp;</td>
                                    <td width="64">5 yıldız</td>
                                </tr>
                                <tr>
                                    <td width="64" align="center"><input type="radio" name="point" value="1"></td>
                                    <td width="10">&nbsp;</td>
                                    <td width="64" align="center"><input type="radio" name="point" value="2"></td>
                                    <td width="10">&nbsp;</td>
                                    <td width="64" align="center"><input type="radio" name="point" value="3"></td>
                                    <td width="10">&nbsp;</td>
                                    <td width="64" align="center"><input type="radio" name="point" value="4"></td>
                                    <td width="10">&nbsp;</td>
                                    <td width="64" align="center"><input type="radio" name="point" value="5"></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr height="30">
                        <td valign="bottom" align="left">Yorum :</td>
                    </tr>
                    <tr height="30">
                        <td valign="top" align="left"><textarea name="comment" class="TextAreaAlanlari"></textarea></td>
                    </tr>
                    <tr height="40">
                        <td align="center"><input type="submit" value="Yorum Yap" class="YesilButton"></td>
                    </tr>
                </table>
            </form>
        </td>
    </tr>
</table>
<?php
    } else {
        header("Location:index.php?pageNo=78");
        exit();
    }
} else {
    header("Location:index.php");
    exit();
}
?>