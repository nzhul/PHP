            <div id="adm_table_field">
                <table>
                    <tr class="tbl_head">
                        <td>№</td>
                        <td>Име на фирмата</td>
                        <td>Вид на товара</td>
                        <td>Тегло</td>
                        <td>Дата</td>
                        <td>Инструменти</td>
                    </tr>
                    <?php 
                        $sql = 'SELECT request_id,date,a1,c1,c8 FROM speditionrequest ORDER BY date DESC';
                        $result = run_q($sql);
                        $rowCount = mysql_num_rows($result);
                        while ($row = mysql_fetch_array($result)){
                            $real_date = date('d/m/Y \- h:i:s A', $row['date']);
                            $short_date = date('d/m/Y', $row['date']);
                            echo '<tr>
                        <td>'.$rowCount.'</td>
                        <td><a href="speditionView.php?id='.$row['request_id'].'">'.$row['a1'].'</a></td>
                        <td>'.$row['c1'].'</td>
                        <td>'.$row['c8'].'</td>
                        <td><span title="'.$real_date.'">'.$short_date.'</span></td>
                        <td><a href="speditionView.php?id='.$row['request_id'].'" class="icon_btn"><img src="../img/icons/preview.png"/></a><a href="#" class="icon_btn"><img src="../img/icons/edit.png"/></a><a onClick="return question();" href="#" class="icon_btn"><img src="../img/icons/delete.png"/></a></td>
                    </tr>';
                            $rowCount--;
                        }
                    ?>                    
                    <tr class="tbl_head">
                        <td>№</td>
                        <td>Име на фирмата</td>
                        <td>Вид на товара</td>
                        <td>Тегло</td>
                        <td>Дата</td>
                        <td>Инструменти</td>
                    </tr>
                </table>
                <a id="add_product_btn" href="../request.php">Добави нова спедиция!</a>
            </div>