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
<script>
    $(document).ready(function() {
        $('#printBtn').click(function(){
           window.print(); 
        });
    });
</script>
<div id="generalWrapper" class="adminWrapper">
    <?php
    if (isset($_GET['err']) && $_GET['err'] == 1) {
        $A1 = $_SESSION['errorValuesArray']['a1'];
        $A2 = $_SESSION['errorValuesArray']['a2'];
        $A3 = $_SESSION['errorValuesArray']['a3']; 
        $A4 = $_SESSION['errorValuesArray']['a4'];
        $A5 = $_SESSION['errorValuesArray']['a5'];
        $A6 = $_SESSION['errorValuesArray']['a6'];
        $A7 = $_SESSION['errorValuesArray']['a7'];
    }
    else {
        $sql = 'SELECT * FROM fleetrequest WHERE fleet_id='.(int)$_GET['id'];
        $result = run_q($sql);
        $row = mysql_fetch_array($result);
        $A1 = $row['a1'];
        $A2 = $row['a2'];
        $A3 = $row['a3']; 
        $A4 = $row['a4'];
        $A5 = $row['a5'];
        $A6 = $row['a6'];
        $A7 = $row['a7'];
    }
    ?>
    <form action="../inc/fleet/processFleetRequest.php" method="POST" id="speditionForm" />
    <h1 style="position:relative;left: 30px;margin-top: 30px;">ЗАЯВКА</h1>
    <?php
        if (isset($_GET['succedit']) && $_GET['succedit'] == 1) {
            echo ' <div class="formField" style="background: #98ec76;"><p style="margin: 0 auto;width: 560px;font-size: 27px;margin-top: 30px;color: #3e682d;">ЗАЯВКАТА БЕШЕ РЕДАКТИРАНА УСПЕШНО!</p></div>';
        }
    ?>
    <div class="formField">
        <div style="margin: 32px 20px 0 35px;width: 25px;height: 25px;background: #424952;float: left;"></div>
        <h2>РАБОТНА КАРТА:</h2>
        <table>
            <tr>
                <td>
                    <label for="A1">Клиент: <span>[ задължително ]</span></label><br/>
                    <input type="text" name="A1" id="A1" value="<?php echo $A1; ?>" />
                </td>
                <td rowspan="6"><label for="A7" id="A7Label">Описание:</label><br/><textarea name="A7" id="A7"><?php echo $A7; ?></textarea></td>
            </tr>
            <tr>
                <td>
                    <label for="A2">Автомобил: <span>[ задължително ]</span></label><br/>
                    <input type="text" name="A2" id="A2" value="<?php echo $A2; ?>" />
                </td>
            </tr>
            <tr>
                <td>
                    <label for="A3">Километри: <span>[ задължително ]</span></label><br/>
                    <input type="text" name="A3" id="A3" value="<?php echo $A3; ?>" />
                </td>
            </tr>
            <tr>
                <td>
                    <label for="A4">Рег. №: <span>[ задължително ]</span></label><br/>
                    <input type="text" name="A4" id="A4" value="<?php echo $A4; ?>" />
                </td>
            </tr>
            <tr>
                <td>
                    <label for="A5">РАМА: </label><br/>
                    <input type="text" name="A5" id="A5" value="<?php echo $A5; ?>" />
                </td>
            </tr>
            <tr>
                <td>
                    <label for="A6">ТЕЛ: <span>[ задължително ]</span></label><br/>
                    <input type="text" name="A6" id="A6" value="<?php echo $A6; ?>" />
                </td>
            </tr>
        </table>
    </div>
    <div class="formField tbl">
        <table>
            <tr>
                <td style="width: 2%;">№</td>
                <td style="width: 50%;">Име артикул</td>
                <td style="width: 7%;">Ед. цена</td>
                <td style="width: 5%;">Кол.</td>
                <td style="width: 5%;">Общо</td>
            </tr>
            <?php 
                for ($index = 1; $index < 20; $index++) {
                    echo '<tr>
                <td>'.$index.'</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>';
                }
            ?>
            <tr>
                <td>№</td>
                <td>Име артикул</td>
                <td>Ед. цена</td>
                <td>Кол.</td>
                <td>Общо</td>
            </tr>
        </table>
    </div>
    <div class="formField tbl">
        <table>
            <tr>
                <td style="border:0px;border-bottom: 1px dotted black;">Извършена дейност: </td>
            </tr>
            <tr><td style="border:0px;border-bottom: 1px dotted black;"></td></tr>
            <tr><td style="border:0px;border-bottom: 1px dotted black;"></td></tr>
            <tr><td style="border:0px;border-bottom: 1px dotted black;"></td></tr>
            <tr><td style="border:0px;border-bottom: 1px dotted black;"></td></tr>
            <tr><td style="border:0px;border-bottom: 1px dotted black;"></td></tr>
            <tr><td style="border: 0px;"></td></tr>
            <tr><td style="border:0px;border-bottom: 1px dotted black;">Труд:<span style="float:right;">:ОБЩО</span></td></tr>
        </table>
    </div>
    <!--<p style="text-transform: uppercase;font-size: 14px;">* превозите по тази заявка се извършват на основание оу на нсбс-последно издание</p>-->
    <input type="hidden" name="postFleetAdmin" value="1"/>
    <input type="hidden" name="fleetID" value="<?php echo $_GET['id']; ?>"/>
    <input type="submit" name="postRequest" id="admSubmit" value="ЗАПИШИ" />
    <input type="button" value="ПРИНТИРАЙ" id="printBtn" />
</form>
</div>
