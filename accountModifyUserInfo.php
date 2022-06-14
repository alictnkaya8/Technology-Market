<?php
if(isset($_SESSION['user'])){
?>
<table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td width="600" valign="top">
            <form action="index.php?pageNo=52" method="post">
                <table width="500" align="center" border="0" cellpadding="0" cellspacing="0">
                    <tr height="40">
                        <td style="color: #FF9900;"><h3>Hesabım > Üyelik Bilgilerim</h3></td>
                    </tr>
                    <tr height="30">
                        <td valign="top" style="border-bottom: 1px dashed #CCCCCC;">Aşağıdan üyelik bilgilerini görüntüleyebilir veya güncelleyebilirsin.</td>
                    </tr>
                    <tr height="30">
                        <td valign="bottom" align="left">İsim Soyisim (*)</td>
                    </tr>
                    <tr height="30">
                        <td valign="top" align="left"><input type="text" name="nameSurname" class="InputAlanlari" value="<?= $nameSurname ?>"></td>
                    </tr>
                    <tr height="30">
                        <td valign="bottom" align="left">E-Mail Adresi (*)</td>
                    </tr>
                    <tr height="30">
                        <td valign="top" align="left"><input type="mail" name="email" class="InputAlanlari" value="<?= $email ?>"></td>
                    </tr><tr height="30">
                        <td valign="bottom" align="left">Şifre (*)</td>
                    </tr>
                    <tr height="30">
                        <td valign="top" align="left"><input type="password" name="password" class="InputAlanlari" value="EskiSifre"></td>
                    </tr>
                    </tr><tr height="30">
                        <td valign="bottom" align="left">Şifre Tekrar (*)</td>
                    </tr>
                    <tr height="30">
                        <td valign="top" align="left"><input type="password" name="passwordAgain" class="InputAlanlari" value="EskiSifre"></td>
                    </tr>
                    <tr height="30">
                        <td valign="bottom" align="left">Telefon Numarası (*)</td>
                    </tr>
                    <tr height="30">
                        <td valign="top" align="left"><input type="text" name="phoneNumber" maxlength="11" class="InputAlanlari" value="<?= $phoneNumber ?>"></td>
                    </tr>
                    <tr height="30">
                        <td valign="bottom" align="left">Cinsiyet (*)</td>
                    </tr>
                    <tr height="30">
                        <td valign="top" align="left">
                            <select name="gender" class="SelectAlanlari">
                                <option value="man" <?php if($gender=='Erkek'){?> selected="selected" <?php }?>>Erkek</option>
                                <option value="woman" <?php if($gender=='Kadın'){?> selected="selected" <?php }?>>Kadın</option>
                            </select>
                        </td>
                    </tr>
                    <tr height="40">
                        <td align="center"><input type="submit" value="Güncelle" class="YesilButton"></td>
                    </tr>
                </table>
            </form>
        </td>
    </tr>
</table>
<?php
}
?>