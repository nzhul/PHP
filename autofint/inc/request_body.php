<script>
    $(function() {
        /* Hide form input values on focus*/
        $('input:text').each(function() {
            var txtval = $(this).val();
            $(this).focus(function() {
                if ($(this).val() == txtval) {
                    $(this).val('')
                }
            });
            $(this).blur(function() {
                if ($(this).val() == "") {
                    $(this).val(txtval);
                }
            });
        });
    });
</script>

<script>
// Simple validation
    $(document).ready(function() {
        $('input:text[class!="digit"]').each(function()
        {
            var defValue = $(this).val();
            $(this).blur(function() {
                if ($(this).val() != defValue)
                {
                    if ($(this).val().length < 5)
                    {
                        $(this).siblings('label').append('<span style="font-size:12px;"> Минимална дължина 5 символа!</span>');
                    }
                }
            });
        });
    });
</script>


<div id="generalWrapper">
    <?php
    if (isset($_GET['err']) && $_GET['err'] == 1) {
        $Z1 = $_SESSION['errorValuesArray']['z1'];
        $Z2 = $_SESSION['errorValuesArray']['z2'];
        $A1 = $_SESSION['errorValuesArray']['a1'];
        $A2 = $_SESSION['errorValuesArray']['a2'];
        $A3 = $_SESSION['errorValuesArray']['a3']; 
        $A4 = $_SESSION['errorValuesArray']['a4'];
        $A5 = $_SESSION['errorValuesArray']['a5'];
        $A6 = $_SESSION['errorValuesArray']['a6'];
        $B1 = $_SESSION['errorValuesArray']['b1'];
        $B2 = $_SESSION['errorValuesArray']['b2'];
        $B3 = $_SESSION['errorValuesArray']['b3'];
        $B4 = $_SESSION['errorValuesArray']['b4'];
        $C1 = $_SESSION['errorValuesArray']['c1'];
        $C2 = $_SESSION['errorValuesArray']['c2'];
        $C3 = $_SESSION['errorValuesArray']['c3'];
        $C4 = $_SESSION['errorValuesArray']['c4'];
        $C5H = $_SESSION['errorValuesArray']['c5h'];
        $C5L = $_SESSION['errorValuesArray']['c5l'];
        $C5W = $_SESSION['errorValuesArray']['c5w'];
        $C61 = $_SESSION['errorValuesArray']['c61'];
        $C62 = $_SESSION['errorValuesArray']['c62'];
        $C7 = $_SESSION['errorValuesArray']['c7'];
        $C8 = $_SESSION['errorValuesArray']['c8'];
        $C9 = $_SESSION['errorValuesArray']['c9'];
        $C10 = $_SESSION['errorValuesArray']['c10'];
        $C11 = $_SESSION['errorValuesArray']['c11'];
        $C12 = $_SESSION['errorValuesArray']['c12']; 
        $C13 = $_SESSION['errorValuesArray']['c13'];
        $C14 = $_SESSION['errorValuesArray']['c14'];
        $C15 = $_SESSION['errorValuesArray']['c15'];
        $D1 = $_SESSION['errorValuesArray']['d1'];
        $D2 = $_SESSION['errorValuesArray']['d2'];
        $D3 = $_SESSION['errorValuesArray']['d3'];
        $D4 = $_SESSION['errorValuesArray']['d4'];
        $D5 = $_SESSION['errorValuesArray']['d5'];
        $D6 = $_SESSION['errorValuesArray']['d6'];
        $D7 = $_SESSION['errorValuesArray']['d7'];
        $D8 = $_SESSION['errorValuesArray']['d8'];
        $E1 = $_SESSION['errorValuesArray']['e1'];
        $E2 = $_SESSION['errorValuesArray']['e2'];
        $E3 = $_SESSION['errorValuesArray']['e3'];
    }
    else {
        $Z1 = Z1;
        $Z2 = Z2;
        $A1 = A1;
        $A2 = A2;
        $A3 = A3; 
        $A4 = A4;
        $A5 = A5;
        $A6 = A6;
        $B1 = B1;
        $B2 = B2;
        $B3 = B3;
        $B4 = B4;
        $C1 = C1;
        $C2 = C2;
        $C3 = C3;
        $C4 = C4;
        $C5H = C5H;
        $C5L = C5L;
        $C5W = C5W;
        $C61 = C61;
        $C62 = C62;
        $C7 = C7;
        $C8 = C8;
        $C9 = C9;
        $C10 = C10;
        $C11 = C11;
        $C12 = C12; 
        $C13 = C13;
        $C14 = C14;
        $C15 = C15;
        $D1 = D1;
        $D2 = D2;
        $D3 = D3;
        $D4 = D4;
        $D5 = D5;
        $D6 = D6;
        $D7 = D7;
        $D8 = D8;
        $E1 = E1;
        $E2 = E2;
        $E3 = E3;
    }
    ?>
    <form action="inc/processSpeditionRequest.php" method="POST" id="speditionForm" />
    <h2>НАПРАВИ ЗАЯВКА ЗА СПЕДИЦИЯ:</h2>
    <div class="horizontalDivider"></div>
    <h1>ЗАЯВКА</h1>
    <?php
        if (isset($_GET['err']) && $_GET['err'] == 1) {
            echo ' <div class="formField" style="background: #e34a26;"><p style="margin: 0 auto;width: 688px;font-size: 27px;margin-top: 30px;color: white;">МОЛЯ ПОПЪЛНЕТЕ ВСИЧКИ ЗАДЪЛЖИТЕЛНИ ПОЛЕТА!</p></div>';
        }
    ?>
    <div class="formField">
        <table>
            <tr>
                <td>
                    <p style="margin: 25px 0 0 180px;float:left;">ЗА<input type="checkbox" <?php if($Z1 == "yes"){echo "checked";} ?> value="yes" name="Z1_grupajenTransp" style="width: 30px;height: 30px;margin: 0 10px 0 10px;position: relative;top: 8px;"/>ГРУПАЖЕН ТРАНСПОРТ</p>
                    <p style="margin: 25px 0 0 50px;float:left;"><input type="checkbox" value="yes" <?php if($Z2 == "yes"){echo "checked";} ?> name="Z2_chastichniTovari" style="width: 30px;height: 30px;margin: 0 10px 0 10px;position: relative;top: 8px;" />ТРАНСПОРТ КОМПЛЕКТНИ / ЧАСТИЧНИ ТОВАРИ</p>
                </td>
            </tr>
        </table>
    </div>
    <div class="formField">
        <div style="margin: 32px 20px 0 35px;width: 25px;height: 25px;background: #424952;float: left;"></div>
        <h2>ОТ ФИРМА:</h2>
        <table>
            <tr>
                <td colspan="2">
                    <label for="A1_firmName">Име на фирмата: <span>[ задължително ]</span></label><br/>
                    <input type="text" name="A1_firmName" id="A1_firmName" value="<?php echo $A1; ?>" />
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <label for="A2_adresRegist">Адрес на регистрация: <span>[ задължително ]</span></label><br/>
                    <input type="text" name="A2_adresRegist" id="A2_adresRegist" value="<?php echo $A2; ?>" />
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <label for="A3_adresKorespondenciq">Адрес на кореспонденция: <span>[ задължително ]</span></label><br/>
                    <input type="text" name="A3_adresKorespondenciq" id="A3_adresKorespondenciq" value="<?php echo $A3; ?>" />
                </td>
            </tr>
            <tr>
                <td>
                    <label for="A4_bulstat">булстат:</label><br/>
                    <input type="text" name="A4_bulstat" id="A4_bulstat" value="<?php echo $A4; ?>" />
                </td>
                <td>
                    <label for="A5_identNomerDDS">идент. номер по ддс:</label><br/>
                    <input type="text" name="A5_identNomerDDS" id="A5_identNomerDDS" value="<?php echo $A5; ?>" />
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <label for="A6_izgotvilZaqvkata">изготвил заявката: <span>[ задължително ]</span></label><br/>
                    <input type="text" name="A6_izgotvilZaqvkata" id="A6_izgotvilZaqvkata" value="<?php echo $A6; ?>" />
                </td>
            </tr>
        </table>
    </div>
    <p style="text-transform: uppercase;font-size: 26px;">С настоящата заявка ви възлагаме превоза:</p>
    <div class="formField">
        <div style="margin: 32px 20px 0 35px;width: 25px;height: 25px;background: #424952;float: left;"></div>
        <h2>ИЗПРАЩАЧ:</h2>
        <table>
            <tr>
                <td colspan="2">
                    <label for="B1_izprashtach">ИЗПРАЩАЧ: <span>[ задължително ]</span></label><br/>
                    <input type="text" name="B1_izprashtach" id="B1_izprashtach" value="<?php echo $B1; ?>" />
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <label for="B2_adresTovarene">адрес на товарене: <span>[ задължително ]</span></label><br/>
                    <input type="text" name="B2_adresTovarene" id="B2_adresTovarene" value="<?php echo $B2; ?>" />
                </td>
            </tr>
            <tr>
                <td>
                    <label for="B3_gotovnostNatovarvane">готовност за натоварване:</label><br/>
                    <input type="text" name="B3_gotovnostNatovarvane" id="B3_gotovnostNatovarvane" value="<?php echo $B3; ?>" />
                </td>
                <td>
                    <label for="B4_poluchavaneDokumenti">получаване на документите:</label><br/>
                    <input type="text" name="B4_poluchavaneDokumenti" id="B4_poluchavaneDokumenti" value="<?php echo $B4; ?>" />
                </td>
            </tr>
        </table>
    </div>
    <div class="formField">
        <div style="margin: 32px 20px 0 35px;width: 25px;height: 25px;background: #424952;float: left;"></div>
        <h2>ВИД НА ТОВАРА:</h2>
        <table>
            <tr>
                <td colspan="2">
                    <label for="C1_izprashtach">вид на товара: <span>[ задължително ]</span></label><br/>
                    <input type="text" name="C1_izprashtach" id="C1_izprashtach" value="<?php echo $C1; ?>" />
                </td>
            </tr>
            <tr>
                <td>
                    <label for="C2_tovareneVurhuKoletite">Товарене върху колетите: <span>[ задължително ]</span></label><br/>
                    <label>ДА</label><input type="radio" value="yes" <?php if($C2 == "yes"){echo 'checked';} ?> name="C2_tovareneVurhuKoletite" /> <label>НЕ</label><input type="radio" value="no" <?php if($C2 == "no"){echo 'checked';} ?> name="C2_tovareneVurhuKoletite" />
                </td>
                <td style="width: 528px;">
                    <label for="C3_broiKoleti">брой колети: <span>[ задължително ]</span></label><br/>
                    <input type="text" name="C3_broiKoleti" id="C3_broiKoleti" class="digit" value="<?php echo $C3; ?>" />
                </td>
            </tr>
            <tr>
                <td>
                    <label for="C4_opakovka">ОПАКОВКА:</label><br/>
                    <input type="text" name="C4_opakovka" id="C4_opakovka" value="<?php echo $C4; ?>" />
                </td>
                <td>
                    <label for="C5_razmer">РАЗМЕРИ:</label><br/>
                    <input type="text" name="C5_razmerL" value="<?php echo $C5L; ?>" class="digit" style="width: 155px;"/>
                    <input type="text" name="C5_razmerW" value="<?php echo $C5W; ?>" class="digit" style="width: 155px;" />
                    <input type="text" name="C5_razmerH" value="<?php echo $C5H; ?>" class="digit" style="width: 155px;" />
                </td>
            </tr>
            <tr>
                <td>
                    <label for="C6_tovarnaPlosht">ТОВАРНА ПЛОЩ:</label><br/>
                    <input type="text" name="C6_tovarnaPlosht1" id="C6_tovarnaPlosht" value="<?php echo $C61; ?>" class="digit" style="width: 45%;" />
                    <input type="text" name="C6_tovarnaPlosht2" value="<?php echo $C62; ?>" class="digit" style="width: 46%;" />
                </td>
                <td>
                    <label for="C7_osobenosti">ОСОБЕНОСТИ:</label><br/>
                    <input type="text" name="C7_osobenosti" id="C7_osobenosti" value="<?php echo $C7; ?>" />
                </td>
            </tr>
            <tr>
                <td>
                    <label for="C8_brutoTeglo">бруто тегло: <span>[ задължително ]</span></label><br/>
                    <input type="text" name="C8_brutoTeglo" id="C8_brutoTeglo" class="digit" value="<?php echo $C8; ?>"/>
                </td>
                <td>
                    <label for="C9_klasOpasenTovar">клас опасен товар:</label><label for="C10_nomerPoOon" style="margin-left: 98px;">номер по оон:</label><br/>
                    <input type="text" value="<?php echo $C9; ?>" name="C9_klasOpasenTovar" id="C9_klasOpasenTovar" style="width: 46%;" />
                    <input type="text" value="<?php echo $C10; ?>" name="C10_nomerPoOon" id="C10_nomerPoOon" style="width: 46%;" />
                </td>
            </tr>
            <tr>
                <td>
                    <label for="C11_opasenTovar">опасен товар:</label><br/>
                    <label>ДА</label><input type="radio" value="yes" <?php if($C11 == "yes"){echo 'checked';} ?> name="C11_opasenTovar" /> <label>НЕ</label><input type="radio" value="no" <?php if($C11 == "no"){echo 'checked';} ?> name="C11_opasenTovar" />
                </td>
                <td>
                    <label for="C12_kargoZastrahovka">карго застраховка:</label><br/>
                    <label>ДА</label><input type="radio" value="yes" <?php if($C12 == "yes"){echo 'checked';} ?> name="C12_kargoZastrahovka" /> <label>НЕ</label><input type="radio" value="no" <?php if($C12 == "no"){echo 'checked';} ?> name="C12_kargoZastrahovka" />
                </td>
            </tr>
            <tr>
                <td>
                    <label for="C13_mitnTarifenNomer">митн. тарифен номер:</label><br/>
                    <input type="text" name="C13_mitnTarifenNomer" id="C13_mitnTarifenNomer" value="<?php echo $C13; ?>"/>
                </td>
                <td>
                    <label for="C14_zastrPremiq">застрах. премия, %:</label><label for="C15_fakturnaStst" style="margin-left: 98px;">фактурна ст-ст:</label><br/>
                    <input type="text" name="C14_zastrPremiq" id="C14_zastrPremiq" value="<?php echo $C14; ?>" style="width: 46%;" />
                    <input type="text" name="C15_fakturnaStst" id="C15_fakturnaStst" value="<?php echo $C15; ?>" style="width: 46%;" />
                </td>
            </tr>
        </table>
    </div>
    <div class="formField">
        <div style="margin: 32px 20px 0 35px;width: 25px;height: 25px;background: #424952;float: left;"></div>
        <h2>ПОЛУЧАТЕЛ:</h2>
        <table>
            <tr>
                <td colspan="2">
                    <label for="D1_poluchatel">получател: <span>[ задължително ]</span></label><br/>
                    <input type="text" name="D1_poluchatel" id="D1_poluchatel" value="<?php echo $D1; ?>" />
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <label for="D2_adresRaztovarvane">адрес на разтоварване: <span>[ задължително ]</span></label><br/>
                    <input type="text" name="D2_adresRaztovarvane" id="D2_adresRaztovarvane" value="<?php echo $D2; ?>" />
                </td>
            </tr>
            <tr>
                <td style="width:50%;">
                    <label for="D3_rabotnoVremeSkladRaztovarv">работно време на склада за разтоварване:</label><br/>
                    <input type="text" name="D3_rabotnoVremeSkladRaztovarv" id="D3_rabotnoVremeSkladRaztovarv" value="<?php echo $D3; ?>" />
                </td>
                <td>
                    <label for="D4_ochakvanoPristigane">очаквано пристигане:</label><br/>
                    <input type="text" name="D4_ochakvanoPristigane" id="D4_ochakvanoPristigane" value="<?php echo $D4; ?>" />
                </td>
            </tr>
            <tr>
                <td style="width:50%;">
                    <label for="D5_frankirovka">франкировка:</label><br/>
                    <input type="text" name="D5_frankirovka" id="D5_frankirovka" value="<?php echo $D5; ?>" />
                </td>
                <td>
                    <label for="D6_dogovorenaCena">договорена цена:</label><br/>
                    <input type="text" name="D6_dogovorenaCena" id="D6_dogovorenaCena" class="digit" value="<?php echo $D6; ?>" />
                </td>
            </tr>
            <tr>
                <td style="width:50%;">
                    <label for="D7_platecNavlo">платец на навлото:</label><br/>
                    <input type="text" name="D7_platecNavlo" id="D7_platecNavlo" value="<?php echo $D7; ?>" />
                </td>
                <td>
                    <label for="D8_dogovorenNachinSrokPlashtane">договорен начин и срок за плащане:</label><br/>
                    <input type="text" name="D8_dogovorenNachinSrokPlashtane" id="D8_dogovorenNachinSrokPlashtane" value="<?php echo $D7; ?>" />
                </td>
            </tr>
        </table>
    </div>
    <div class="formField">
        <div style="margin: 32px 20px 0 35px;width: 25px;height: 25px;background: #424952;float: left;"></div>
        <h2>ДОПЪЛНИТЕЛНИ УСЛОВИЯ:</h2>
        <table>
            <tr>
                <td colspan="2">
                    <label for="E1_dopalnitelniUsloviq">допълнителни условия:</label><br/>
                    <input type="text" name="E1_dopalnitelniUsloviq" id="E1_dopalnitelniUsloviq" value="<?php echo $E1; ?>" />
                </td>
            </tr>
            <tr>
                <td style="width:50%;">
                    <label for="E2_dogovorenSrokDostavka">договорен срок на доставка:</label><br/>
                    <input type="text" name="E2_dogovorenSrokDostavka" id="E2_dogovorenSrokDostavka" value="<?php echo $E2; ?>" />
                </td>
                <td>
                    <label for="E3_ochakvanoPristigane">неустойки неспазване срока на доставка:</label><br/>
                    <input type="text" value="<?php echo $E3; ?>" name="E3_ochakvanoPristigane" id="E3_ochakvanoPristigane" />
                </td>
            </tr>
        </table>
    </div>
    <p style="text-transform: uppercase;font-size: 14px;">* превозите по тази заявка се извършват на основание оу на нсбс-последно издание</p>
    <input type="hidden" name="postSpeditionVisitor" value="1"/>
    <input type="submit" name="postRequest" value="ИЗПРАТИ" />
    <input type="reset" value="ИЗЧИСТИ" id="resetBtn" />
</form>
</div>