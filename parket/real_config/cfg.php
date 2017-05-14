<?php
session_start();
mysql_connect('localhost','parketta_niki','0cRemWs!3YL_B>f') or die (mysql_error());
mysql_select_db('parketta_parket') or die (mysql_error());
function run_q ($query){
    mysql_query('SET NAMES UTF8');
    $result=mysql_query($query);
    if(mysql_error()){
        echo mysql_error(). ' SQL: ' . $query;
    }
    return $result;
}

function redirect ($url) {
    echo '<META HTTP-EQUIV="Refresh" CONTENT="0; URL='.$url.'">';
    exit;
}
function fetch_all($mysql_resource){
    while($row=  mysql_fetch_assoc($mysql_resource)){
        $resp[]=$row;
    }
    return $resp;
}
?>

<?php
function ae_detect_ie()
{
    if (isset($_SERVER['HTTP_USER_AGENT']) && 
    (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false))
        return true;
    else
        return false;
}
?>