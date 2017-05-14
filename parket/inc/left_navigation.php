    <div id="product_navigation">
        <h3>ПРОДУКТИ:</h3>
        <div style="clear:both;"></div>
        <ul>
<?php 
$group_result = run_q('SELECT group_id,gname FROM `group`');
while ($group_row = mysql_fetch_array($group_result)){
    echo '<li><div class="bullet"></div><a href="products.php?group='.$group_row['group_id'].'">'.$group_row['gname'].'</a></li>';
}
?>
        </ul>
        <div id="fast_connection">
            <h3>БЪРЗА ВРЪЗКА:</h3>
            <table>
                <tr>
                    <td style="width:20px;"><img src="img/phone_ico.jpg"/></td>
                    <td>0887062636</td>
                </tr>
                <tr>
                    <td><img src="img/email_ico.jpg"/></td>
                    <td><a href="mailto:clients@parket.com?Subject=Запитване%20за%20Оферта">clients@parket-tapeti.com</a></td>
                </tr>
                <tr>
                    <td><img src="img/addr_ico.jpg"/></td>
                    <td>Адрес: София, ж.к. Дървеница, <br/>ул. Иван Боримечката 3А</td>
                </tr>
            </table>
        </div>
    </div>