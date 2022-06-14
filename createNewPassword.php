<?php

if(isset($_GET["activationCode"])){
    $activationCode = filterVariable($_GET["activationCode"]);
} else {
    $activationCode = "";
}
if(isset($_GET["email"])){
    $email = filterVariable($_GET["email"]);
} else {
    $email = "";
}

if(!empty($activationCode) and !empty($email)){
    $query = $db->prepare("SELECT * FROM users WHERE email = ? AND activationCode = ?");
    $query->execute([$email, $activationCode]);
    $checkAlreadyRegister = $query->rowCount();
    $checkActivation = $query->fetch(PDO::FETCH_ASSOC);
    
    if($checkAlreadyRegister > 0){
?>


<table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td width="600" valign="top">
            <form action="index.php?pageNo=44&email=<?= $email ?>&activationCode=<?= $activationCode ?>" method="post">
                <table width="500" align="center" border="0" cellpadding="0" cellspacing="0">
                    <tr height="40">
                        <td colspan="2" style="color: #FF9900;"><h3>Şifre Sıfırlama</h3></td>
                    </tr>
                    <tr height="30">
                        <td colspan="2" valign="top" style="border-bottom: 1px dashed #CCCCCC;">Hesabına Yeni Bir Şifre Oluştur.</td>
                    </tr>
                    <tr height="30">
                        <td colspan="2" valign="bottom" align="left">Yeni Şifre</td>
                    </tr>
                    <tr height="30">
                        <td colspan="2" valign="top" align="left"><input type="password" name="password" class="InputAlanlari"></td>
                    </tr><tr height="30">
                        <td colspan="2" valign="bottom" align="left">Yeni Şifre Tekrar</td>
                    </tr>
                    <tr height="30">
                        <td colspan="2" valign="top" align="left"><input type="password" name="passwordAgain" class="InputAlanlari"></td>
                    </tr>
                    <tr height="40">
                        <td colspan="2" align="center"><input type="submit" value="Yeni Şifre Oluştur" class="YesilButton"></td>
                    </tr>
                </table>
            </form>
        </td>
    </tr>
</table>
<?php
    }else {
        header("Location:index.php");
        exit();
    }
}else {
    header("Location:index.php");
    exit();
}
?>