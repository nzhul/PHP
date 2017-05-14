<?php 
require '../cfg.php';
require 'adm_header.php';
if (isset($_SESSION['is_loggedd'])) {
    require 'items_ket_content.php';
} else { ?>
<div class="login_field">
<form method="post" action="login.php">
    <div class="input_field">
        <label for="username">Потребител:</label>
        <input type="text" id="username" name="username" />
    </div>
    <div class="input_field">
        <label for="password">Парола:</label>
        <input type="password" id="password" name="password" />
    </div>
    <input id="save_btn" type="submit" name="submit" value="Влез" />
</form>
</div> 
<?php }
require 'adm_footer.php';
?>