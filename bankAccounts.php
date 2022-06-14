<table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
    <tr height="100" bgcolor="#FF9900">
        <td align="left"><h2 style="color:white;">BANKA HESAPLARIMIZ</h2></td>
    </tr>
    <tr height="50">
        <td align="left" style="border-bottom: 1px dashed #CCCCCC;">&nbsp;Ödemeleriniz İçin Çalışmakta Olduğumuz Tüm Banka Hesap Bilgileri Aşağıdadır.</td>
    </tr>
    <tr>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td align="left">
            <table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <?php
                        $bankQuery = $db->prepare("SELECT * FROM bankaccounts");
                        $bankQuery->execute();
                        $bankCount = $bankQuery->rowCount();
                        $banks = $bankQuery->fetchAll(PDO::FETCH_ASSOC);

                        $counter = 1;
                        $rowCount = 3;

                        foreach($banks as $bank){
                    ?>
                                <td width="340">
                                    <table align="center" border="0" cellpadding="0" cellspacing="0" style="border: 1px solid #CCCCCC; margin-bottom: 20px;">
                                        <tr height="40">
                                            <td colspan="4" align="center"><img src="pictures/<?php echo $bank["bankLogo"]; ?>" border="0"></td>
                                        </tr>
                                        <tr height="25">
                                            <td width="5">&nbsp;</td>
                                            <td width="80"><b>Banka Adı</b></td>
                                            <td width="10"><b>:</b></td>
                                            <td width="245"><?php echo backChanges($bank["bankName"]); ?></td>
                                        </tr>
                                        <tr height="25">
                                            <td width="5">&nbsp;</td>
                                            <td><b>Konum</b></td>
                                            <td><b>:</b></td>
                                            <td><?php echo backChanges($bank["cityLocation"]); ?> / <?php echo backChanges($bank["countryLocation"]); ?></td>
                                        </tr>
                                        <tr height="25">
                                            <td width="5">&nbsp;</td>
                                            <td><b>Şube</b></td>
                                            <td><b>:</b></td>
                                            <td><?php echo backChanges($bank["branchName"]); ?> / <?php echo backChanges($bank["branchCode"]); ?></td>
                                        </tr>
                                        <tr height="25">
                                            <td width="5">&nbsp;</td>
                                            <td><b>Birim</b></td>
                                            <td><b>:</b></td>
                                            <td><?php echo backChanges($bank["currencyUnit"]); ?></td>
                                        </tr>
                                        <tr height="25">
                                            <td width="5">&nbsp;</td>
                                            <td><b>Hesap Adı</b></td>
                                            <td><b>:</b></td>
                                            <td><?php echo backChanges($bank["accountHolder"]); ?></td>
                                        </tr>
                                        <tr height="25">
                                            <td width="5">&nbsp;</td>
                                            <td><b>Hesap No</b></td>
                                            <td><b>:</b></td>
                                            <td><?php echo backChanges($bank["accountNumber"]); ?></td>
                                        </tr>
                                        <tr height="25">
                                            <td width="5">&nbsp;</td>
                                            <td><b>IBAN No</b></td>
                                            <td><b>:</b></td>
                                            <td><?php echo formatIBAN(backChanges($bank["ibanNumber"])); ?></td>
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
            </table>
        </td>
    </tr>
</table>