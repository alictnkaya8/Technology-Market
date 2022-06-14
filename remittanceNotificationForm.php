<table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td width="500" valign="top">
            <form action="index.php?pageNo=10" method="post">
                <table width="500" align="center" border="0" cellpadding="0" cellspacing="0">
                    <tr height="40">
                        <td style="color: #FF9900;"><h3>Havale Bildirim Formu</h3></td>
                    </tr>
                    <tr height="30">
                        <td valign="top" style="border-bottom: 1px dashed #CCCCCC;">Tamamlanmış Olan Ödeme İşleminizi Aşağıdaki Formdan İletiniz.</td>
                    </tr>
                    <tr height="30">
                        <td valign="bottom" align="left">İsim Soyisim (*)</td>
                    </tr>
                    <tr height="30">
                        <td valign="top" align="left"><input type="text" name="nameSurname" class="InputAlanlari"></td>
                    </tr>
                    <tr height="30">
                        <td valign="bottom" align="left">E-Mail Adresi (*)</td>
                    </tr>
                    <tr height="30">
                        <td valign="top" align="left"><input type="mail" name="email" class="InputAlanlari"></td>
                    </tr>
                    <tr height="30">
                        <td valign="bottom" align="left">Telefon Numarası (*)</td>
                    </tr>
                    <tr height="30">
                        <td valign="top" align="left"><input type="text" name="phoneNumber" maxlength="11" class="InputAlanlari"></td>
                    </tr>
                    <tr height="30">
                        <td valign="bottom" align="left">Ödeme Yapılan Banka (*)</td>
                    </tr>
                    <tr>
                        <td valign="top" align="left">
                            <select name="bankSelection" class="SelectAlanlari">
                            <?php
                                $bankQuery = $db->prepare("SELECT * FROM bankaccounts ORDER BY bankName");
                                $bankQuery->execute();
                                $bankCount = $bankQuery->rowCount();
                                $banks = $bankQuery->fetchAll(PDO::FETCH_ASSOC);

                                foreach($banks as $bank):
                            ?>
                                <option value="<?php echo backChanges($bank["id"]); ?>"><?php echo backChanges($bank["bankName"]); ?></option>
                            <?php endforeach; ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td valign="bottom" align="left">Açıklama</td>
                    </tr>
                    <tr>
                        <td valign="top" align="left"><textarea name="decription" class="TextAreaAlanlari"></textarea></td>
                    </tr>
                    <tr>
                        <td align="center"><input type="submit" value="Gönder" class="YesilButton"></td>
                    </tr>
                </table>
            </form>
        </td>
        <td width="20">&nbsp;</td>
        <td width="545" valign="top">
            <table width="545" align="center" border="0" cellpadding="0" cellspacing="0">
                <tr height="40">
                    <td colspan="2" style="color: #FF9900;"><h3>İşleyiş</h3></td>
                </tr>
                <tr height="30">
                    <td colspan="2" valign="top" style="border-bottom: 1px dashed #CCCCCC;">Havale / EFT İşlemlerinin Kontrolü.</td>
                </tr>
                <tr height="5">
                    <td colspan="2" height="5"></td>
                </tr>
                <tr height="30">
                    <td align="left" width="30"><img src="pictures/bank-building.png" border="0" style="margin-top: 3px;"></td>
                    <td align="left"><b>Havale / EFT işlemi</b></td>
                </tr>
                <tr>
                    <td colspan="2" align="left">Müşteri tarafından öncelikle banka hesaplarımız sayfasında bulunan herhangi bir hesaba ödeme işlemi gerçekleştirilir.</td>
                </tr>
                <tr>
                    <td width="20">&nbsp;</td>
                </tr>
                <tr height="30">
                    <td align="left" width="30"><img src="pictures/writing.png" border="0" style="margin-top: 3px;"></td>
                    <td align="left"><b>Bildirim İşlemi</b></td>
                </tr>
                <tr>
                    <td colspan="2" align="left">Ödeme işleminizi tamamladıktan sonra "Havale Bildirim Formu" sayfasından müşteri yapmış olduğu ödeme için bildirim formunu doldurarak online olarak gönderir.</td>
                </tr>
                <tr>
                    <td width="20">&nbsp;</td>
                </tr>
                <tr height="30">
                    <td align="left" width="30"><img src="pictures/settings.png" border="0" style="margin-top: 3px;"></td>
                    <td align="left"><b>Kontroller</b></td>
                </tr>
                <tr>
                    <td colspan="2" align="left">"Havale Bildirim Formu"'nuz tarafımıza ulaştığı anda ilgili departman tarafından yapmış olduğunuz Havale / EFT işlemi ilgili banka üzerinden kontrol edilir.</td>
                <tr>
                    <td width="20">&nbsp;</td>
                </tr>
                <tr height="30">
                    <td align="left" width="30"><img src="pictures/users-avatar.png" border="0" style="margin-top: 3px;"></td>
                    <td align="left"><b>Onay / Red</b></td>
                </tr>
                <tr>
                    <td colspan="2" align="left">Havale bildirimi geçerli ise, yani hesaba ödeme geçmiş ise, yönetici ilgili ödeme onayını vererek, siparişiniz teslimat birimine iletilir.</td>
                </tr>
                <tr>
                    <td width="20">&nbsp;</td>
                </tr>
                <tr height="30">
                    <td align="left" width="30"><img src="pictures/clock.png" border="0" style="margin-top: 3px;"></td>
                    <td align="left"><b>Sipariş Hazırlama & Teslimat</b></td>
                </tr>
                <tr>
                    <td colspan="2" align="left">Yönetici ödeme onayından sonra sayfamız üzerinden vermiş olduğunuz sipariş en kısa sürede hazrılanarak kargoya teslim edilir ve tarafınıza ulaştırılır...</td>
                </tr>
            </table>
        </td>
    </tr>
</table>