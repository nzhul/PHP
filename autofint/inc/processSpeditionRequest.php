<?php
require 'constants.php';
require 'cfg.php';
if (isset($_POST['postSpeditionVisitor'])) {
    
    if (isset($_POST['Z1_grupajenTransp']) && $_POST['Z1_grupajenTransp'] == "yes") {
        $Z1 = $_POST['Z1_grupajenTransp'];
    }
    else
    {
        $Z1 = "no";
    }
    if (isset($_POST['Z2_chastichniTovari']) && $_POST['Z2_chastichniTovari'] == "yes") {
        $Z2 = $_POST['Z2_chastichniTovari'];
    }
    else
    {
        $Z2 = "no";
    }
    $A1 = htmlspecialchars(mysql_real_escape_string(trim($_POST['A1_firmName'])));
    $A2 = htmlspecialchars(mysql_real_escape_string(trim($_POST['A2_adresRegist'])));
    $A3 = htmlspecialchars(mysql_real_escape_string(trim($_POST['A3_adresKorespondenciq'])));
    $A4 = htmlspecialchars(mysql_real_escape_string(trim($_POST['A4_bulstat'])));
    $A5 = htmlspecialchars(mysql_real_escape_string(trim($_POST['A5_identNomerDDS'])));
    $A6 = htmlspecialchars(mysql_real_escape_string(trim($_POST['A6_izgotvilZaqvkata'])));
    
    $B1 = htmlspecialchars(mysql_real_escape_string(trim($_POST['B1_izprashtach'])));
    $B2 = htmlspecialchars(mysql_real_escape_string(trim($_POST['B2_adresTovarene'])));
    $B3 = htmlspecialchars(mysql_real_escape_string(trim($_POST['B3_gotovnostNatovarvane'])));
    $B4 = htmlspecialchars(mysql_real_escape_string(trim($_POST['B4_poluchavaneDokumenti'])));

    $C1 = htmlspecialchars(mysql_real_escape_string(trim($_POST['C1_izprashtach'])));
    if (isset($_POST['C2_tovareneVurhuKoletite'])) {
        $C2 = htmlspecialchars(mysql_real_escape_string(trim($_POST['C2_tovareneVurhuKoletite'])));
    }
    else
    {
        $C2 = "unknown";
    }
    $C3 = htmlspecialchars(mysql_real_escape_string(trim($_POST['C3_broiKoleti'])));
    $C4 = htmlspecialchars(mysql_real_escape_string(trim($_POST['C4_opakovka'])));
    $C5L = htmlspecialchars(mysql_real_escape_string(trim($_POST['C5_razmerL'])));
    $C5W = htmlspecialchars(mysql_real_escape_string(trim($_POST['C5_razmerW'])));
    $C5H = htmlspecialchars(mysql_real_escape_string(trim($_POST['C5_razmerH'])));
    $C61 = htmlspecialchars(mysql_real_escape_string(trim($_POST['C6_tovarnaPlosht1'])));
    $C62 = htmlspecialchars(mysql_real_escape_string(trim($_POST['C6_tovarnaPlosht2'])));
    $C7 = htmlspecialchars(mysql_real_escape_string(trim($_POST['C7_osobenosti'])));
    $C8 = htmlspecialchars(mysql_real_escape_string(trim($_POST['C8_brutoTeglo'])));
    $C9 = htmlspecialchars(mysql_real_escape_string(trim($_POST['C9_klasOpasenTovar'])));
    $C10 = htmlspecialchars(mysql_real_escape_string(trim($_POST['C10_nomerPoOon'])));
    if (isset($_POST['C11_opasenTovar'])) {
       $C11 = htmlspecialchars(mysql_real_escape_string(trim($_POST['C11_opasenTovar'])));
    }
    else
    {
        $C11 = "unknown";
    }
    if (isset($_POST['C12_kargoZastrahovka'])) {
        $C12 = htmlspecialchars(mysql_real_escape_string(trim($_POST['C12_kargoZastrahovka'])));
    }
    else
    {
        $C12 = "unknown";
    }
    $C13 = htmlspecialchars(mysql_real_escape_string(trim($_POST['C13_mitnTarifenNomer'])));
    $C14 = htmlspecialchars(mysql_real_escape_string(trim($_POST['C14_zastrPremiq'])));
    $C15 = htmlspecialchars(mysql_real_escape_string(trim($_POST['C15_fakturnaStst'])));
    
    $D1 = htmlspecialchars(mysql_real_escape_string(trim($_POST['D1_poluchatel'])));
    $D2 = htmlspecialchars(mysql_real_escape_string(trim($_POST['D2_adresRaztovarvane'])));
    $D3 = htmlspecialchars(mysql_real_escape_string(trim($_POST['D3_rabotnoVremeSkladRaztovarv'])));
    $D4 = htmlspecialchars(mysql_real_escape_string(trim($_POST['D4_ochakvanoPristigane'])));
    $D5 = htmlspecialchars(mysql_real_escape_string(trim($_POST['D5_frankirovka'])));
    $D6 = htmlspecialchars(mysql_real_escape_string(trim($_POST['D6_dogovorenaCena'])));
    $D7 = htmlspecialchars(mysql_real_escape_string(trim($_POST['D7_platecNavlo'])));
    $D8 = htmlspecialchars(mysql_real_escape_string(trim($_POST['D8_dogovorenNachinSrokPlashtane'])));

    $E1 = htmlspecialchars(mysql_real_escape_string(trim($_POST['E1_dopalnitelniUsloviq'])));
    $E2 = htmlspecialchars(mysql_real_escape_string(trim($_POST['E2_dogovorenSrokDostavka'])));
    $E3 = htmlspecialchars(mysql_real_escape_string(trim($_POST['E3_ochakvanoPristigane'])));
    
    $error = false;
    
    if ( $A1 == A1) { $error = true;}
    if ( $A2 == A2) { $error = true;}
    if ( $A3 == A3) { $error = true;}
    if ( $A4 == A4) { $A4 = "";}
    if ( $A5 == A5) { $A4 = "";}
    if ( $A6 == A6) { $error = true;}
    
    if ( $B1 == B1) { $error = true;}
    if ( $B2 == B2) { $error = true;}
    if ( $B3 == B3) {$B3 = "";}
    if ( $B4 == B4) {$B4 = "";}
    
    if ( $C1 == C1) { $error = true;}
    if ( $C2 == C2) { $error = true;}
    if ( $C3 == C3) { $error = true;}
    if ( $C4 == C4) {$C4 = "";}
    if ( $C5H == C5H) {$C5H = "";}
    if ( $C5L == C5L) {$C5L = "";}
    if ( $C5W == C5W) {$C5W = "";}
    if ( $C61 == C61) {$C6 = "";}
    if ( $C62 == C62) {$C6 = "";}
    if ( $C7 == C7) {$C7 = "";}
    if ( $C8 == C8) { $error = true;}
    if ( $C9 == C9) {$C9 = "";}
    if ( $C10 == C10) {$C10 = "";}
    //if ( $C11 == C11) {$C11 = "";}
    //if ( $C12 == C12) {$C12 = "";}
    if ( $C13 == C13) {$C13 = "";}
    if ( $C14 == C14) {$C14 = "";}
    if ( $C15 == C15) {$C15 = "";}
    
    if ( $D1 == D1) { $error = true;}
    if ( $D2 == D2) { $error = true;}
    if ( $D3 == D3) {$D3 = "";}
    if ( $D4 == D4) {$D4 = "";}
    if ( $D5 == D5) {$D5 = "";}
    if ( $D6 == D6) {$D6 = "";}
    if ( $D7 == D7) {$D7 = "";}
    if ( $D8 == D8) {$D8 = "";}
    
    if ( $E1 == E1) {$E1 = "";}
    if ( $E2 == E2) {$E2 = "";}
    if ( $E3 == E3) {$E3 = "";}
    
if ($error) {
    $errorValuesArray = array(
        "z1" => $Z1,
        "z2" => $Z2,
        "a1" => $A1,
        "a2" => $A2,
        "a3" => $A3,
        "a4" => $A4,
        "a5" => $A5,
        "a6" => $A6,
        "b1" => $B1,
        "b2" => $B2,
        "b3" => $B3,
        "b4" => $B4,
        "c1" => $C1,
        "c2" => $C2,
        "c3" => $C3,
        "c4" => $C4,
        "c5h" => $C5H,
        "c5l" => $C5L,
        "c5w" => $C5W,
        "c61" => $C61,
        "c62" => $C62,
        "c7" => $C7,
        "c8" => $C8,
        "c9" => $C9,
        "c10" => $C10,
        "c11" => $C11,
        "c12" => $C12, 
        "c13" => $C13,
        "c14" => $C14,
        "c15" => $C15,
        "d1" => $D1,
        "d2" => $D2,
        "d3" => $D3,
        "d4" => $D4,
        "d5" => $D5,
        "d6" => $D6,
        "d7" => $D7,
        "d8" => $D8,
        "e1" => $E1,
        "e2" => $E2,
        "e3" => $E3);
    $_SESSION['errorValuesArray'] = $errorValuesArray;
    header('Location: ../request.php?err=1');
    exit;
}
else
{
    $sql = 'INSERT INTO speditionrequest 
            (date, z1,z2,a1,a2,a3,a4,a5,a6,b1,b2,b3,b4,c1,c2,c3,c4,c5h,c5l,c5w,c61,c62,c7,
             c8,c9,c10,c11,c12,c13,c14,c15,d1,d2,d3,d4,d5,d6,d7,d8,e1,e2,e3,placeholder ) 
            VALUES ('.time().',"'.$Z1.'","'.$Z2.'","'.$A1.'","'.$A2.'","'.$A3.'","'.$A4.'","'.$A5.'","'.$A6.'","'.$B1.'","'.$B2.'",
                    "'.$B3.'","'.$B4.'","'.$C1.'","'.$C2.'","'.$C3.'","'.$C4.'","'.$C5H.'","'.$C5L.'","'.$C5W.'","'.$C61.'","'.$C62.'","'.$C7.'",
                    "'.$C8.'","'.$C9.'","'.$C10.'","'.$C11.'","'.$C12.'","'.$C13.'","'.$C14.'","'.$C15.'","'.$D1.'","'.$D2.'","'.$D3.'",
                    "'.$D4.'","'.$D5.'","'.$D6.'","'.$D7.'","'.$D8.'","'.$E1.'","'.$E2.'","'.$E3.'","placeholder" )';
    if (run_q($sql)) {
        header('Location: ../request_success.php');
        exit;
    }
}
}

if (isset($_POST['postSpeditionAdmin']) && isset($_POST['speditionID']) ) {
    
    if (isset($_POST['Z1_grupajenTransp']) && $_POST['Z1_grupajenTransp'] == "yes") {
        $Z1 = $_POST['Z1_grupajenTransp'];
    }
    else
    {
        $Z1 = "no";
    }
    if (isset($_POST['Z2_chastichniTovari']) && $_POST['Z2_chastichniTovari'] == "yes") {
        $Z2 = $_POST['Z2_chastichniTovari'];
    }
    else
    {
        $Z2 = "no";
    }
    $A1 = htmlspecialchars(mysql_real_escape_string(trim($_POST['A1_firmName'])));
    $A2 = htmlspecialchars(mysql_real_escape_string(trim($_POST['A2_adresRegist'])));
    $A3 = htmlspecialchars(mysql_real_escape_string(trim($_POST['A3_adresKorespondenciq'])));
    $A4 = htmlspecialchars(mysql_real_escape_string(trim($_POST['A4_bulstat'])));
    $A5 = htmlspecialchars(mysql_real_escape_string(trim($_POST['A5_identNomerDDS'])));
    $A6 = htmlspecialchars(mysql_real_escape_string(trim($_POST['A6_izgotvilZaqvkata'])));
    
    $B1 = htmlspecialchars(mysql_real_escape_string(trim($_POST['B1_izprashtach'])));
    $B2 = htmlspecialchars(mysql_real_escape_string(trim($_POST['B2_adresTovarene'])));
    $B3 = htmlspecialchars(mysql_real_escape_string(trim($_POST['B3_gotovnostNatovarvane'])));
    $B4 = htmlspecialchars(mysql_real_escape_string(trim($_POST['B4_poluchavaneDokumenti'])));

    $C1 = htmlspecialchars(mysql_real_escape_string(trim($_POST['C1_izprashtach'])));
    if (isset($_POST['C2_tovareneVurhuKoletite'])) {
        $C2 = htmlspecialchars(mysql_real_escape_string(trim($_POST['C2_tovareneVurhuKoletite'])));
    }
    else
    {
        $C2 = "unknown";
    }
    $C3 = htmlspecialchars(mysql_real_escape_string(trim($_POST['C3_broiKoleti'])));
    $C4 = htmlspecialchars(mysql_real_escape_string(trim($_POST['C4_opakovka'])));
    $C5L = htmlspecialchars(mysql_real_escape_string(trim($_POST['C5_razmerL'])));
    $C5W = htmlspecialchars(mysql_real_escape_string(trim($_POST['C5_razmerW'])));
    $C5H = htmlspecialchars(mysql_real_escape_string(trim($_POST['C5_razmerH'])));
    $C61 = htmlspecialchars(mysql_real_escape_string(trim($_POST['C6_tovarnaPlosht1'])));
    $C62 = htmlspecialchars(mysql_real_escape_string(trim($_POST['C6_tovarnaPlosht2'])));
    $C7 = htmlspecialchars(mysql_real_escape_string(trim($_POST['C7_osobenosti'])));
    $C8 = htmlspecialchars(mysql_real_escape_string(trim($_POST['C8_brutoTeglo'])));
    $C9 = htmlspecialchars(mysql_real_escape_string(trim($_POST['C9_klasOpasenTovar'])));
    $C10 = htmlspecialchars(mysql_real_escape_string(trim($_POST['C10_nomerPoOon'])));
    if (isset($_POST['C11_opasenTovar'])) {
       $C11 = htmlspecialchars(mysql_real_escape_string(trim($_POST['C11_opasenTovar'])));
    }
    else
    {
        $C11 = "unknown";
    }
    if (isset($_POST['C12_kargoZastrahovka'])) {
        $C12 = htmlspecialchars(mysql_real_escape_string(trim($_POST['C12_kargoZastrahovka'])));
    }
    else
    {
        $C12 = "unknown";
    }
    $C13 = htmlspecialchars(mysql_real_escape_string(trim($_POST['C13_mitnTarifenNomer'])));
    $C14 = htmlspecialchars(mysql_real_escape_string(trim($_POST['C14_zastrPremiq'])));
    $C15 = htmlspecialchars(mysql_real_escape_string(trim($_POST['C15_fakturnaStst'])));
    
    $D1 = htmlspecialchars(mysql_real_escape_string(trim($_POST['D1_poluchatel'])));
    $D2 = htmlspecialchars(mysql_real_escape_string(trim($_POST['D2_adresRaztovarvane'])));
    $D3 = htmlspecialchars(mysql_real_escape_string(trim($_POST['D3_rabotnoVremeSkladRaztovarv'])));
    $D4 = htmlspecialchars(mysql_real_escape_string(trim($_POST['D4_ochakvanoPristigane'])));
    $D5 = htmlspecialchars(mysql_real_escape_string(trim($_POST['D5_frankirovka'])));
    $D6 = htmlspecialchars(mysql_real_escape_string(trim($_POST['D6_dogovorenaCena'])));
    $D7 = htmlspecialchars(mysql_real_escape_string(trim($_POST['D7_platecNavlo'])));
    $D8 = htmlspecialchars(mysql_real_escape_string(trim($_POST['D8_dogovorenNachinSrokPlashtane'])));

    $E1 = htmlspecialchars(mysql_real_escape_string(trim($_POST['E1_dopalnitelniUsloviq'])));
    $E2 = htmlspecialchars(mysql_real_escape_string(trim($_POST['E2_dogovorenSrokDostavka'])));
    $E3 = htmlspecialchars(mysql_real_escape_string(trim($_POST['E3_ochakvanoPristigane'])));
    
    $error = false;
    
    if ( $A1 == A1) { $error = true;}
    if ( $A2 == A2) { $error = true;}
    if ( $A3 == A3) { $error = true;}
    if ( $A4 == A4) { $A4 = "";}
    if ( $A5 == A5) { $A5 = "";}
    if ( $A6 == A6) { $error = true;}
    
    if ( $B1 == B1) { $error = true;}
    if ( $B2 == B2) { $error = true;}
    if ( $B3 == B3) {$B3 = "";}
    if ( $B4 == B4) {$B4 = "";}
    
    if ( $C1 == C1) { $error = true;}
    if ( $C2 == C2) { $error = true;}
    if ( $C3 == C3) { $error = true;}
    if ( $C4 == C4) {$C4 = "";}
    if ( $C5H == C5H) {$C5H = "";}
    if ( $C5L == C5L) {$C5L = "";}
    if ( $C5W == C5W) {$C5W = "";}
    if ( $C61 == C61) {$C6 = "";}
    if ( $C62 == C62) {$C6 = "";}
    if ( $C7 == C7) {$C7 = "";}
    if ( $C8 == C8) { $error = true;}
    if ( $C9 == C9) {$C9 = "";}
    if ( $C10 == C10) {$C10 = "";}
    //if ( $C11 == C11) {$C11 = "";}
    //if ( $C12 == C12) {$C12 = "";}
    if ( $C13 == C13) {$C13 = "";}
    if ( $C14 == C14) {$C14 = "";}
    if ( $C15 == C15) {$C15 = "";}
    
    if ( $D1 == D1) { $error = true;}
    if ( $D2 == D2) { $error = true;}
    if ( $D3 == D3) {$D3 = "";}
    if ( $D4 == D4) {$D4 = "";}
    if ( $D5 == D5) {$D5 = "";}
    if ( $D6 == D6) {$D6 = "";}
    if ( $D7 == D7) {$D7 = "";}
    if ( $D8 == D8) {$D8 = "";}
    
    if ( $E1 == E1) {$E1 = "";}
    if ( $E2 == E2) {$E2 = "";}
    if ( $E3 == E3) {$E3 = "";}
    
if ($error) {
    $errorValuesArray = array(
        "z1" => $Z1,
        "z2" => $Z2,
        "a1" => $A1,
        "a2" => $A2,
        "a3" => $A3,
        "a4" => $A4,
        "a5" => $A5,
        "a6" => $A6,
        "b1" => $B1,
        "b2" => $B2,
        "b3" => $B3,
        "b4" => $B4,
        "c1" => $C1,
        "c2" => $C2,
        "c3" => $C3,
        "c4" => $C4,
        "c5h" => $C5H,
        "c5l" => $C5L,
        "c5w" => $C5W,
        "c61" => $C61,
        "c62" => $C62,
        "c7" => $C7,
        "c8" => $C8,
        "c9" => $C9,
        "c10" => $C10,
        "c11" => $C11,
        "c12" => $C12, 
        "c13" => $C13,
        "c14" => $C14,
        "c15" => $C15,
        "d1" => $D1,
        "d2" => $D2,
        "d3" => $D3,
        "d4" => $D4,
        "d5" => $D5,
        "d6" => $D6,
        "d7" => $D7,
        "d8" => $D8,
        "e1" => $E1,
        "e2" => $E2,
        "e3" => $E3);
    $_SESSION['errorValuesArray'] = $errorValuesArray;
    header('Location: ../admin/speditionView.php?err=1');
    exit;
}
else
{
    $sql = 'UPDATE speditionrequest SET z1="'.$Z1.'",z2="'.$Z2.'",a1="'.$A1.'",a2="'.$A2.'",a3="'.$A3.'",
            a4="'.$A4.'",a5="'.$A5.'",a6="'.$A6.'",b1="'.$B1.'",b2="'.$B2.'",b3="'.$B3.'",b4="'.$B4.'",c1="'.$C1.'",
            c2="'.$C2.'",c3="'.$C3.'",c4="'.$C4.'",c5h="'.$C5H.'",c5l="'.$C5L.'",c5w="'.$C5W.'",c61="'.$C61.'",
            c62="'.$C62.'",c7="'.$C7.'",c8="'.$C8.'",c9="'.$C9.'",c10="'.$C10.'",c11="'.$C11.'",c12="'.$C12.'",
            c13="'.$C10.'",c14="'.$C14.'",c15="'.$C15.'",d1="'.$D1.'",d2="'.$D2.'",d3="'.$D3.'",d4="'.$D4.'",
            d5="'.$D5.'",d6="'.$D6.'",d7="'.$D7.'",d8="'.$D8.'",e1="'.$E1.'",e2="'.$E2.'",e3="'.$E3.'" WHERE request_id='.$_POST['speditionID'];
    if (run_q($sql)) {
        header('Location: ../admin/speditionView.php?id='.$_POST['speditionID'].'&succedit=1');
        exit;
    }
}
}
?>
