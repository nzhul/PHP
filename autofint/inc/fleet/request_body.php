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
        $A1 = $_SESSION['errorValuesArray']['a1'];
        $A2 = $_SESSION['errorValuesArray']['a2'];
        $A3 = $_SESSION['errorValuesArray']['a3']; 
        $A4 = $_SESSION['errorValuesArray']['a4'];
        $A5 = $_SESSION['errorValuesArray']['a5'];
        $A6 = $_SESSION['errorValuesArray']['a6'];
        $A7 = $_SESSION['errorValuesArray']['a7'];
    }
    else {
        $A1 = A1;
        $A2 = A2;
        $A3 = A3; 
        $A4 = A4;
        $A5 = A5;
        $A6 = A6;
        $A7 = A7;
    }
    ?>
    <form action="inc/fleet/processFleetRequest.php" method="POST" id="speditionForm" />
    <h2>НАПРАВИ ЗАЯВКА ЗА РЕМОНТ:</h2>
    <div class="horizontalDivider"></div>
    <h1>ЗАЯВКА</h1>
    <?php
        if (isset($_GET['err']) && $_GET['err'] == 1) {
            echo ' <div class="formField" style="background: #e34a26;"><p style="margin: 0 auto;width: 688px;font-size: 27px;margin-top: 30px;color: white;">МОЛЯ ПОПЪЛНЕТЕ ВСИЧКИ ЗАДЪЛЖИТЕЛНИ ПОЛЕТА!</p></div>';
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
    <!--<p style="text-transform: uppercase;font-size: 14px;">* превозите по тази заявка се извършват на основание оу на нсбс-последно издание</p>-->
    <input type="hidden" name="postFleetVisitor" value="1"/>
    <input type="submit" name="postRequest" id="FleetRequestBtn" value="ИЗПРАТИ" />
    <input type="reset" value="ИЗЧИСТИ" id="resetBtn" />
</form>
</div>