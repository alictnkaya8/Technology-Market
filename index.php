<?php
session_start();
ob_start();
require_once("settings/setting.php");
require_once("settings/functions.php");
require_once("settings/sitePages.php");

if(isset($_REQUEST["pageNo"])){
    $pageNumber = onlyAllowNumbers($_REQUEST["pageNo"]);
} else {
    $pageNumber = 0;
}
if(isset($_REQUEST["pagination"])){
    $pagination = onlyAllowNumbers($_REQUEST["pagination"]);
} else {
    $pagination = 1;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="Content-Language" content="tr">
    <meta charset="utf-8">
    <meta name="robots" content="index, follow">
    <meta name="googlebot" content="index, follow">
    <meta name="revisit-after" content="7 Days">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo backChanges($siteTitle); ?></title>
    <meta name="description" content="<?php echo backChanges($siteDescription); ?>">
    <meta name="keywords" content="<?php echo backChanges($siteKeywords); ?>">
    <script type="text/javascript" src="frameworks/JQuery/jquery-3.6.0.min.js" lang="javascript"></script>
    <link type="text/css" rel="stylesheet" href="settings/style.css">
    <script type="text/javascript" src="settings/functions.js" lang="javascript"></script>

</head>

<body>
    <table width="1065" height="100%" align="center" border="0" cellpadding="0" cellspacing="0">
        <tr height="40" bgcolor="whitesmoke">
            <td><img src="pictures/HeaderMesaj.png" border="0"></td>
        </tr>
        <tr height="110">
            <td>
                <table width="1065" height="30" align="center" border="0" cellpadding="0" cellspacing="0">
                    <tr bgcolor="#0099CC">
                        <td>&nbsp;</td>
                        <?php
                            if(isset($_SESSION['user'])){
                        ?>
                                <td width="24"><a href="index.php?pageNo=31"><img src="pictures/account.png" border="0" style="margin-top: 5px;"></a></td>
                                <td width="70" class="MaviMenuAlani"><a href="index.php?pageNo=50">Hesabım</a></td>
                                <td width="24"><a href="index.php?pageNo=22"><img src="pictures/exit.png" border="0" style="margin-top: 5px;"></a></td>
                                <td width="70" class="MaviMenuAlani"><a href="index.php?pageNo=49">Çıkış Yap</a></td>
                        <?php
                            }else {
                        ?>
                                <td width="24"><a href="index.php?pageNo=31"><img src="pictures/login.png" border="0" style="margin-top: 5px;"></a></td>
                                <td width="70" class="MaviMenuAlani"><a href="index.php?pageNo=31">Giriş Yap</a></td>
                                <td width="24"><a href="index.php?pageNo=22"><img src="pictures/register.png" border="0" style="margin-top: 5px;"></a></td>
                                <td width="55" class="MaviMenuAlani"><a href="index.php?pageNo=22">Üye ol</a></td>
                        <?php 
                            }
                        ?>
                        <td width="24"><?php if(isset($_SESSION['user'])): ?><a href="index.php?pageNo=95" ><img src="pictures/shopping-cart.png" border="0" style="margin-top: 5px;"></a><?php else: ?><img src="pictures/shopping-cart.png" border="0" style="margin-top: 5px;"><?php endif; ?></td>
                        <td width="103" class="MaviMenuAlani"><?php if(isset($_SESSION['user'])): ?><a href="index.php?pageNo=95" >Alışveriş Sepeti</a><?php else: ?>Alışveriş Sepeti<?php endif; ?></td>
                    </tr>
                </table>
                <table width="1065" height="80" align="center" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                        <td width="200"><a href="index.php"><img src="pictures/<?php echo backChanges($siteLogo); ?>" border="0"></a></td>
                        <td>
                            <table width="865" height="30" align="center" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td width="245">&nbsp;</td>
                                    <td width="75" class="AnaMenu"><a href="index.php">Anasayfa</a></td>
                                    <td width="150" class="AnaMenu"><a href="index.php?pageNo=83">Masaüstü Bilgisayar</a></td>
                                    <td width="135" class="AnaMenu"><a href="index.php?pageNo=84">Dizüstü Bilgisayar</a></td>
                                    <td width="110" class="AnaMenu"><a href="index.php?pageNo=85">Çevre Birimleri</a></td>
                                    <td width="80" class="AnaMenu"><a href="index.php?pageNo=86">Bileşenler</a></td>
                                    <td width="70" class="AnaMenu"><a href="index.php?pageNo=87">Aksesuar</a></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td valign="top">
                <table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                        <td align="center">
                            <?php
                                if((!$pageNumber) || ($pageNumber == "") || ($pageNumber == 0)){
                                    include($page[0]);
                                } else {
                                    include($page[$pageNumber]);
                                }
                            ?> <br>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr height="210">
            <td>
                <table width="1065" align="center" border="0" cellpadding="0" cellspacing="0" bgcolor="#F9F9F9">
                    <tr height="30">
                        <td width="250" style="border-bottom: 1px dashed #CCCCCC;"><b>Kurumsal</b></td>
                        <td width="22">&nbsp;</td>
                        <td width="250" style="border-bottom: 1px dashed #CCCCCC;"><b>Üyelik & Hizmetler</b></td>
                        <td width="22">&nbsp;</td>
                        <td width="250" style="border-bottom: 1px dashed #CCCCCC;"><b>Sözleşmeler</b></td>
                        <td width="21">&nbsp;</td>
                        <td width="250" style="border-bottom: 1px dashed #CCCCCC;"><b>Bizi Takip Edin</b></td>
                    </tr>
                    <tr height="30">
                        <td class="AltMenu"><a href="index.php?pageNo=1">Hakkımızda</a></td>
                        <td>&nbsp;</td>
                        <?php
                            if(isset($_SESSION['user'])){
                        ?>
                                <td class="AltMenu"><a href="index.php?pageNo=50">Hesabım</a></td>
                        <?php
                            }else {
                        ?>
                                <td class="AltMenu"><a href="index.php?pageNo=31">Giriş Yap</a></td>
                        <?php 
                            }
                        ?>
                        <td>&nbsp;</td>
                        <td class="AltMenu"><a href="index.php?pageNo=2">Üyelik Sözleşmesi</a></td>
                        <td>&nbsp;</td>
                            <td width="">
                            <table width="250" align="center" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td width="24" class="AltMenu"><a href="<?php echo backChanges($facebookLink); ?>" target="_blank"><img src="pictures/facebook.png" style="margin-top: 5px;"></a></td>
                                    <td width="226" class="AltMenu"><a href="<?php echo backChanges($facebookLink); ?>" target="_blank">Facebook</a></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr height="30">
                        <td class="AltMenu"><a href="index.php?pageNo=8">Banka Hesaplarımız</a></td>
                        <td>&nbsp;</td>
                        <?php
                            if(isset($_SESSION['user'])){
                        ?>
                                <td class="AltMenu"><a href="index.php?pageNo=49">Çıkış Yap</a></td>
                        <?php
                            }else {
                        ?>
                                <td class="AltMenu"><a href="index.php?pageNo=22">Üye Ol</a></td>
                        <?php 
                            }
                        ?>

                        <td>&nbsp;</td>
                        <td class="AltMenu"><a href="index.php?pageNo=3">Kullanım Koşulları</a></td>
                        <td>&nbsp;</td>
                        <td>
                            <table width="250" align="center" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td width="24" class="AltMenu"><a href=""<?php echo backChanges($twitterLink); ?>" target="_blank"><img src="pictures/twitter.png" style="margin-top: 5px;"></a></td>
                                    <td width="226" class="AltMenu"><a href="<?php echo backChanges($twitterLink); ?>" target="_blank">Twitter</a></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr height="30">
                        <td class="AltMenu"><a href="index.php?pageNo=9">Havale Bildirim Formu</a></td>
                        <td>&nbsp;</td>
                        <td class="AltMenu"><a href="index.php?pageNo=21">Sık Sorulan Sorular</a></td>
                        <td>&nbsp;</td>
                        <td class="AltMenu"><a href="index.php?pageNo=4">Gizlilik Sözleşmesi</a></td>
                        <td>&nbsp;</td>
                        <td>
                            <table width="250" align="center" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td width="24" class="AltMenu"><a href="<?php echo backChanges($instagramLink); ?>" target="_blank"><img src="pictures/instagram.png" style="margin-top: 5px;"></a></td>
                                    <td width="226" class="AltMenu"><a href="<?php echo backChanges($instagramLink); ?>" target="_blank">Instagram</a></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr height="30">
                        <td class="AltMenu"><a href="index.php?pageNo=14">Kargom Nerede?</a></td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td class="AltMenu"><a href="index.php?pageNo=5">Mesafeli Satış Sözleşmesi</a></td>
                        <td>&nbsp;</td>
                        <td>
                            <table width="250" align="center" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td width="24" class="AltMenu"><a href="<?php echo backChanges($linkedinLink); ?>" target="_blank"><img src="pictures/linkedin.png" style="margin-top: 5px;"></a></td>
                                    <td width="226" class="AltMenu"><a href="<?php echo backChanges($linkedinLink); ?>" target="_blank">LinkedIn</a></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr height="30">
                        <td class="AltMenu"><a href="index.php?pageNo=16">İletişim</a></td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td class="AltMenu"><a href="index.php?pageNo=6">Teslimat</a></td>
                        <td>&nbsp;</td>
                        <td>
                            <table width="250" align="center" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td width="24" class="AltMenu"><a href="<?php echo backChanges($youtubeLink); ?>" target="_blank"><img src="pictures/youtube.png" style="margin-top: 5px;"></a></td>
                                    <td width="226" class="AltMenu"><a href="<?php echo backChanges($youtubeLink); ?>" target="_blank">YouTube</a></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr height="30">
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td class="AltMenu"><a href="index.php?pageNo=7">İptal & İade & Değişim</a></td>
                        <td>&nbsp;</td>
                        <td></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr height="30">
            <td>
                <table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                        <td width="24"><img src="pictures/copyright.png" style="margin-top: 5px;"></td>
                        <td><?php echo backChanges($siteCopyright); ?></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>

<?php
$db = null;
ob_end_flush();
?>