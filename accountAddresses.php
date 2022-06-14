<?php

if(isset($_SESSION['user'])){
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
                    <td colspan="5" style="color: #FF9900;"><h3>Hesabım > Adreslerim</h3></td>
                </tr>
                <tr height="30">
                    <td colspan="5" valign="top" style="border-bottom: 1px dashed #CCCCCC;">Adres bilgilerini görüntüleyebilir veya güncelleyebilirsin.</td>
                </tr>
                <tr height="50">
                    <td colspan="1" align="left" style="background: #F8FFA7; color: black; font-weight: bold;">&nbsp;Adresler</td>
                    <td colspan="4" align="right" style="background: #F8FFA7; color: black; font-weight: bold;"><a href="index.php?pageNo=70" style="text-decoration: none; color: black;">+ Yeni Adres Ekle</a></td>
                </tr>
                <?php
                    $adressQuery = $db->prepare("SELECT * FROM addresses WHERE userId = ?");
                    $adressQuery->execute([$userID]);
                    $addressCount = $adressQuery->rowCount();
                    $addresses = $adressQuery->fetchAll(PDO::FETCH_ASSOC);
                    
                    $firstColor = "#F1F1F1";
                    $secondColor = "#FFFFFF";
                    $counter = 1;

                    if($addressCount > 0){
                        foreach($addresses as $address){
                            if($counter % 2){
                                $backgroundColor = $firstColor;
                            } else {
                                $backgroundColor = $secondColor;
                            }
                ?>
                        <tr height="50" bgcolor="<?= $backgroundColor ?>">
                            <td height="50" align="left"><?= $address['nameSurname'] ?> - <?= $address['address'] ?> <?= $address['country'] ?> / <?= $address['city'] ?> - <?= $address['phoneNumber'] ?></td>
                            <td width="25"><a href="index.php?pageNo=62&id=<?= $address['id'] ?>"><img src="pictures/loop.png" border="0" style="margin-top: 4px;"></a></td>
                            <td width="70"><a href="index.php?pageNo=62&id=<?= $address['id'] ?>" style="text-decoration: none; color: #646464;">Güncelle</a></td>
                            <td width="25"><a href="index.php?pageNo=67&id=<?= $address['id'] ?>"><img src="pictures/delete.png" border="0" style="margin-top: 4px;"></a></td>
                            <td width="20"><a href="index.php?pageNo=67&id=<?= $address['id'] ?>" style="text-decoration: none; color: #646464;">Sil</a></td>
                        </tr>
                <?php
                        $counter++;
                        }
                    } else {
                ?>
                        <tr>
                            <td colspan="5" height="50" align="left">Sisteme Kayıtlı Adresiniz Bulunmamaktadır.</td>
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