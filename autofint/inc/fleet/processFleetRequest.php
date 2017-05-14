<?php
require 'constants.php';
require '../cfg.php';
if (isset($_POST['postFleetVisitor'])) {
    
    $A1 = htmlspecialchars(mysql_real_escape_string(trim($_POST['A1'])));
    $A2 = htmlspecialchars(mysql_real_escape_string(trim($_POST['A2'])));
    $A3 = htmlspecialchars(mysql_real_escape_string(trim($_POST['A3'])));
    $A4 = htmlspecialchars(mysql_real_escape_string(trim($_POST['A4'])));
    $A5 = htmlspecialchars(mysql_real_escape_string(trim($_POST['A5'])));
    $A6 = htmlspecialchars(mysql_real_escape_string(trim($_POST['A6'])));
    $A7 = htmlspecialchars(mysql_real_escape_string(trim($_POST['A7'])));
   
    
    $error = false;
    
    if ( $A1 == A1) { $error = true;}
    if ( $A2 == A2) { $error = true;}
    if ( $A3 == A3) { $error = true;}
    if ( $A4 == A4) { $error = true;}
    if ( $A5 == A5) { $A5 = "";}
    if ( $A6 == A6) { $error = true;}
    if ( $A7 == A7) { $error = true;}
    
if ($error) {
    $errorValuesArray = array(
        "a1" => $A1,
        "a2" => $A2,
        "a3" => $A3,
        "a4" => $A4,
        "a5" => $A5,
        "a6" => $A6,
        "a7" => $A7);
    $_SESSION['errorValuesArray'] = $errorValuesArray;
    header('Location: ../../request_fleet.php?err=1');
    exit;
}
else
{
    $sql = 'INSERT INTO fleetrequest
            (date,a1,a2,a3,a4,a5,a6,a7) 
            VALUES ('.time().',"'.$A1.'","'.$A2.'","'.$A3.'","'.$A4.'","'.$A5.'","'.$A6.'", "'.$A7.'")';
    if (run_q($sql)) {
        header('Location: ../../request_success.php');
        exit;
    }
}
}

if (isset($_POST['postFleetAdmin']) && isset($_POST['fleetID']) ) {
    $A1 = htmlspecialchars(mysql_real_escape_string(trim($_POST['A1'])));
    $A2 = htmlspecialchars(mysql_real_escape_string(trim($_POST['A2'])));
    $A3 = htmlspecialchars(mysql_real_escape_string(trim($_POST['A3'])));
    $A4 = htmlspecialchars(mysql_real_escape_string(trim($_POST['A4'])));
    $A5 = htmlspecialchars(mysql_real_escape_string(trim($_POST['A5'])));
    $A6 = htmlspecialchars(mysql_real_escape_string(trim($_POST['A6'])));
    $A7 = htmlspecialchars(mysql_real_escape_string(trim($_POST['A7'])));
    
    $error = false;
    
    if ( $A1 == A1) { $error = true;}
    if ( $A2 == A2) { $error = true;}
    if ( $A3 == A3) { $error = true;}
    if ( $A4 == A4) { $error = true;}
    if ( $A5 == A5) {$A5 = "";}
    if ( $A6 == A6) { $error = true;}
    if ( $A7 == A7) { $error = true;}
    
if ($error) {
    $errorValuesArray = array(
        "a1" => $A1,
        "a2" => $A2,
        "a3" => $A3,
        "a4" => $A4,
        "a5" => $A5,
        "a6" => $A6,
        "a7" => $A7);
    $_SESSION['errorValuesArray'] = $errorValuesArray;
    header('Location: ../admin/fleetView.php?err=1');
    exit;
}
else
{
    $sql = 'UPDATE fleetrequest SET a1="'.$A1.'",a2="'.$A2.'",a3="'.$A3.'",
            a4="'.$A4.'",a5="'.$A5.'",a6="'.$A6.'", a7="'.$A7.'" WHERE fleet_id='.$_POST['fleetID'];
    if (run_q($sql)) {
        header('Location: ../../admin/fleetView.php?id='.$_POST['fleetID'].'&succedit=1');
        exit;
    }
}
}
?>
