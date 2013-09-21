<?php
require 'inc/header.php';
require 'inc/constants.php';
?>
<div id="navigation">
    <ul id="menu">
        <li>
            <a href="form.php">Add Expense</a>
        </li>
        <li><a href="#">Filter</a>
            <ul class="sub-menu">
                <li><a href="index.php">All</a></li>
                <?php
                foreach ($types as $key => $value) {
                    echo '<li><a href="index.php?filter=' . $key . '">' . $value . '</a></li>';
                }
                ?>
            </ul>
        </li>
    </ul>
</div>
<table border="0">
    <tr>
        <td class="sum">№</td>
        <td class="sum">Name</td>
        <td class="sum">Cost</td>
        <td class="sum">Type</td>
        <td class="sum">Date</td>
        <td class="sum"></td>
        <td class="sum"></td>
    </tr>
    <?php
    $rawData = file('database.txt');
    if (count($rawData) == 0) {
                echo '<tr><td colspan="7" style="color: #93c72e;height: 50px;">';
                echo 'At the moment there is not even one record in the  table!<br/><a href="form.php">Make the first record from here!</a>';
                echo '</td></tr>';
            }
    $counter = 1;
    $sum = 0;
    for ($i = 0; $i < count($rawData); $i++) {
        $splitedArray = explode('|', $rawData[$i]);
        if (isset($_GET['filter']) && (int) $_GET['filter'] >= 0) {
            if ((int) $_GET['filter'] == $splitedArray[2]) {
                echo '<tr>';
                echo '<td>' . $counter . '.</td>
        <td>' . $splitedArray[0] . '</td>
        <td>' . number_format($splitedArray[1], 2)  . '</td>
        <td>' . $types[$splitedArray[2]] . '</td>
        <td title="' . date("H:m:s", (int) $splitedArray[3]) . '">' . date("d.m.y", (int) $splitedArray[3]) . '</td>
        <td><a class="btn edit" href="form.php?edit=' . (int) $splitedArray[3] . '">edit</a></td>
        <td><a class="btn del" href="form.php?del=' . (int) $splitedArray[3] . '">del</a></td>';
                echo '</tr>';
                $sum += $splitedArray[1];
                $counter++;
            }
        } else {
            echo '<tr>';
            echo '<td>' . $counter . '.</td>
        <td>' . $splitedArray[0] . '</td>
        <td>' . number_format($splitedArray[1], 2) . '</td>
        <td>' . $types[$splitedArray[2]] . '</td>
        <td title="' . date("H:i:s", (int) $splitedArray[3]) . '">' . date("d.m.y", (int) $splitedArray[3]) . '</td>
        <td><a class="btn edit" href="form.php?edit=' . (int) $splitedArray[3] . '">edit</a></td>
        <td><a class="btn del" href="form.php?del=' . (int) $splitedArray[3] . '">del</a></td>';
            echo '</tr>';
            $sum += $splitedArray[1];
            $counter++;
        }
    }
    ?>
    <tr>
        <td></td>
        <td></td>
        <td><span class="sum"><?= number_format($sum, 2) ; ?></span></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
</table>

<?php
include 'inc/footer.php';
?>