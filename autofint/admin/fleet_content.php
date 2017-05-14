            <div id="adm_table_field">
                <table>
                    <tr class="tbl_head">
                        <td>№</td>
                        <td>Клиент</td>
                        <td>Автомобил</td>
                        <td>Телефон</td>
                        <td>Дата</td>
                        <td>Инструменти</td>
                    </tr>
                    <?php 
                        $sql = 'SELECT fleet_id,date,a1,a2,a6 FROM fleetrequest ORDER BY date DESC';
                        $result = run_q($sql);
                        $rowCount = mysql_num_rows($result);
                        while ($row = mysql_fetch_array($result)){
                            $real_date = date('d/m/Y \- h:i:s A', $row['date']);
                            $short_date = date('d/m/Y', $row['date']);
                            echo '<tr>
                        <td>'.$rowCount.'</td>
                        <td><a href="fleetView.php?id='.$row['fleet_id'].'">'.$row['a1'].'</a></td>
                        <td>'.$row['a2'].'</td>
                        <td>'.$row['a6'].'</td>
                        <td><span title="'.$real_date.'">'.$short_date.'</span></td>
                        <td><a href="fleetView.php?id='.$row['fleet_id'].'" class="icon_btn"><img src="../img/icons/preview.png"/></a><a href="#" class="icon_btn"><img src="../img/icons/edit.png"/></a><a onClick="return question();" href="#" class="icon_btn"><img src="../img/icons/delete.png"/></a></td>
                    </tr>';
                            $rowCount--;
                        }
                    ?>                    
                    <tr class="tbl_head">
                        <td>№</td>
                        <td>Клиент</td>
                        <td>Автомобил</td>
                        <td>Телефон</td>
                        <td>Дата</td>
                        <td>Инструменти</td>
                    </tr>
                </table>
                <a id="add_product_btn" href="../request.php">Добави нова заявка за ремонт!</a>
            </div>