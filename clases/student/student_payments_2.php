<?php

    //require_once('../../clases/mysqlcon.php');
    //$_SESSION['qidescuela'] = '1';
    
    
    $sqlt = "SELECT bancos.idBancos, bancos.nombre, 
    bancos_mappings.referenciaprefix, bancos_mappings.numcuenta, 
    pagos.idParciales, parciales.nombre AS qnombre, parciales.descripcion 
    FROM bancos, bancos_mappings, pagos, parciales 
    WHERE bancos_mappings.idBancos = bancos.idBancos 
    AND bancos_mappings.idEscuelas = '".$_SESSION['qidescuela']."' AND bancos_mappings.idBancos = '".$qidbank."' 
    AND pagos.token = '".rawurldecode($_POST['selectt'])."' 
    AND pagos.idPagos = parciales.idParciales"; 
    /*
    $sqlt = "SELECT bancos.idBancos, bancos.nombre, 
    bancos_mappings.referenciaprefix, bancos_mappings.numcuenta, 
    pagos.idParciales, parciales.nombre AS qnombre, parciales.descripcion 
    FROM bancos, bancos_mappings, pagos, parciales 
    WHERE bancos_mappings.idBancos = bancos.idBancos 
    AND bancos_mappings.idEscuelas = '1' AND bancos_mappings.idBancos = '2' 
    AND pagos.token = 'v5l7d59UCmQPLbvSFktaqgPE/KPFR7PWlxJ8gTK722LTvzOK39PUqX5sKtlWn' 
    AND pagos.idPagos = parciales.idParciales";
    */ 
    //$sqlt = "SELECT bancos.idBancos, bancos.nombre, bancos_mappings.referenciaprefix, bancos_mappings.numcuenta FROM bancos, bancos_mappings WHERE bancos_mappings.idBancos = bancos.idBancos AND bancos_mappings.idEscuelas = '1' AND bancos_mappings.idBancos = '".$_GET['qid']."'"; 
    //echo "<br>".$sqlt."<br>";
    $resexist = $con->query($sqlt);
    $row = $resexist->fetch_assoc();
    //print_r($row);

    
    $nombrebanco = $row['nombre'];
    $numreferencia = $row['referenciaprefix'];
    $numconcentradora = $row['numcuenta'];
    $pagoname = $row['qnombre'];
    $pagodesc = $row['descripcion'];
 //echo $numconcentradora;
    //$texts['sec_nombre']   icon-checkmark-3



?>