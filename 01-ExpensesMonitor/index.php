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
                                echo '<li><a href="index.php?sortid='.$key.'">'.$value.'</a></li>';
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
                </tr>
                <tr>
                    <td>1.</td>
                    <td>Sandwich</td>
                    <td>5.88</td>
                    <td>Food</td>
                    <td>22.09.2013</td>
                </tr>
                <tr>
                    <td>1.</td>
                    <td>Sandwich</td>
                    <td>5.88</td>
                    <td>Food</td>
                    <td>22.09.2013</td>
                </tr>
                <tr>
                    <td>1.</td>
                    <td>Sandwich</td>
                    <td>5.88</td>
                    <td>Food</td>
                    <td>22.09.2013</td>
                </tr>
                <tr>
                    <td>1.</td>
                    <td>Sandwich</td>
                    <td>5.88</td>
                    <td>Food</td>
                    <td>22.09.2013</td>
                </tr>
                <tr>
                    <td>1.</td>
                    <td>Sandwich</td>
                    <td>5.88</td>
                    <td>Food</td>
                    <td>22.09.2013</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td><span class="sum">365.00</span></td>
                    <td></td>
                    <td></td>
                </tr>
            </table>
<?php
include 'inc/footer.php';
?>