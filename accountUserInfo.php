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
                    <td style="color: #FF9900;"><h3>Hesabım > Üyelik Bilgilerim</h3></td>
                </tr>
                <tr height="30">
                    <td valign="top" style="border-bottom: 1px dashed #CCCCCC;">Aşağıdan üyelik bilgilerini görüntüleyebilir veya güncelleyebilirsin.</td>
                </tr>
                <tr height="30">
                    <td valign="bottom" align="left"><b>İsim/Soyisim</b></td>
                </tr>
                <tr height="30">
                    <td valign="top" align="left"><?= $nameSurname ?></td>
                </tr>
                <tr height="30">
                    <td valign="bottom" align="left"><b>E-Mail Adresi</b></td>
                </tr>
                <tr height="30">
                    <td valign="top" align="left"><?= $email ?></td>
                </tr>
                <tr height="30">
                    <td valign="bottom" align="left"><b>Telefon Numarası</b></td>
                </tr>
                <tr height="30">
                    <td valign="top" align="left"><?= $phoneNumber ?></td>
                </tr>
                <tr height="30">
                    <td valign="bottom" align="left"><b>Cinsiyet</b></td>
                </tr>
                <tr height="30">
                    <td valign="top" align="left"><?= $gender ?></td>
                </tr>
                <tr height="30">
                    <td valign="bottom" align="left"><b>Kayıt Tarihi</b></td>
                </tr>
                <tr height="30">
                    <td valign="top" align="left"><?= date("d.m.Y H:i:s", $registerDate) ?></td>
                </tr>
                <tr height="30">
                    <td align="center"><a href="index.php?pageNo=51" class="ModifyButonu">Bilgileri Güncelle</a></td>
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