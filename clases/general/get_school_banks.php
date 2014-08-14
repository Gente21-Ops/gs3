<?php

    //require_once('../../clases/mysqlcon.php');
    //$_SESSION['qidescuela'] = '1';
    
    $sqlt = "SELECT bancos.idBancos, bancos.nombre, bancos.processor, bancos_mappings.referenciaprefix, bancos_mappings.numcuenta FROM bancos, bancos_mappings WHERE bancos_mappings.idBancos = bancos.idBancos AND bancos_mappings.idEscuelas = '".$_SESSION['qidescuela']."'"; 
    //echo "<br>".$sqlt;
    $resto = "";
    $rest = $con->query($sqlt);
    while ($rowt = $rest->fetch_assoc()) {

        $resto .= '<option value="'.$rowt["processor"].'">'.$rowt["nombre"].'</option>';

    }
    echo $resto;
    //$texts['sec_nombre']   icon-checkmark-3



?>