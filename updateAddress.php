<?php 
if(isset($_SESSION['user'])){

    if(isset($_GET["id"])){
        $id = filterVariable($_GET["id"]);
    } else {
        $id = "";
    }
    if($id != ""){
        $adressQuery = $db->prepare("SELECT * FROM addresses WHERE id = ? AND userId = ? LIMIT 1");
        $adressQuery->execute([$id, $userID]);
        $addressCount = $adressQuery->rowCount();
        $addressInfo = $adressQuery->fetch(PDO::FETCH_ASSOC);
        if($addressCount > 0){
?>
            <table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td width="600" valign="top">
                        <form action="index.php?pageNo=63&id=<?= $id ?>" method="post">
                            <table width="500" align="center" border="0" cellpadding="0" cellspacing="0">
                                <tr height="40">
                                    <td style="color: #FF9900;"><h3>Hesabım > Adresler</h3></td>
                                </tr>
                                <tr height="30">
                                    <td valign="top" style="border-bottom: 1px dashed #CCCCCC;">Adres bilgilerini görüntüleyebilir veya güncelleyebilirsin.</td>
                                </tr>
                                <tr height="30">
                                    <td valign="bottom" align="left">İsim Soyisim (*)</td>
                                </tr>
                                <tr height="30">
                                    <td valign="top" align="left"><input type="text" name="nameSurname" class="InputAlanlari" value="<?= $addressInfo['nameSurname'] ?>"></td>
                                </tr>
                                <tr height="30">
                                    <td valign="bottom" align="left">Adres (*)</td>
                                </tr>
                                <tr height="30">
                                    <td valign="top" align="left"><input type="text" name="address" class="InputAlanlari" value="<?= $addressInfo['address'] ?>"></td>
                                </tr><tr height="30">
                                    <td valign="bottom" align="left">İl (*)</td>
                                </tr>
                                <tr height="30">
                                    <td valign="top" align="left"><input type="text" name="city" class="InputAlanlari" value="<?= $addressInfo['city'] ?>"></td>
                                </tr>
                                </tr><tr height="30">
                                    <td valign="bottom" align="left">İlçe (*)</td>
                                </tr>
                                <tr height="30">
                                    <td valign="top" align="left"><input type="text" name="country" class="InputAlanlari" value="<?= $addressInfo['country'] ?>"></td>
                                </tr>
                                <tr height="30">
                                    <td valign="bottom" align="left">Telefon Numarası (*)</td>
                                </tr>
                                <tr height="30">
                                    <td valign="top" align="left"><input type="text" name="phoneNumber" maxlength="11" class="InputAlanlari" value="<?= $addressInfo['phoneNumber'] ?>"></td>
                                </tr>
                                <tr height="50">
                                    <td align="center"><input type="submit" value="Adresi Güncelle" class="YesilButton"></td>
                                </tr>
                            </table>
                        </form>
                    </td>
                </tr>
            </table>
<?php 
        } else {
            header('Location:index.php?pageNo=65');
            exit();
        }
    } else {
        header('Location:index.php?pageNo=65');
        exit();
    }
} else {
    header('Location:index.php');
    exit();
}
?>