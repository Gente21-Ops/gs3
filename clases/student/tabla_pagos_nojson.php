<?php

//include("../logon.php");



    //VARS
    //These ones need to come from session
    $quser = $_SESSION['idUsers'];
    $qcodeuser = $_SESSION['code'];
    $qidescuela = $_SESSION['qidescuela'];
    $codeescuela = $_SESSION['qescuelacode'];

    //globals
    $qcolcosto = 0.00;
    $qcoldesc = 0;
    $qcolimit = 0;

    //obtengo los datos de pago de la escuela:
    //$querp = "SELECT colegiatura_costo, colegiatura_desc_prontopago, colegiatura_dia_limite FROM settings WHERE idEscuelas = '".$qidescuela."'";
    $querp = "SELECT colegiatura_costo FROM settings WHERE idEscuelas = '".$qidescuela."'";
    $resp = mysqli_query($con, $querp);
    $rowp = mysqli_fetch_assoc($resp);

    $qcolcosto = $rowp['colegiatura_costo'];

    //idParciales, nombre AS qparname, limite_pago AS qfechapago,
    $sqlmaterias = "SELECT idParciales, nombre AS qparname, limite_pago AS qfechapago FROM parciales 
    WHERE parciales.idParciales 
    NOT IN (
       SELECT pagos.idParciales
       FROM pagos
       WHERE pagos.idParciales = parciales.idParciales AND pagos.idUsers = '".$quser."'
    )";  

    //WHERE pagos.idParciales=parciales.idParciales AND pagos.idUsers = '".$quser."' 

    $result = $con->query($sqlmaterias);
    $TotalRcount = $result->num_rows;

    
    //FIRST STEP: I GET THE TOTAL OF PARTIALS
    //if there are more partials than those I've registered, I'll create a record for each one of them
    if ($TotalRcount > 0){
        //we need to get
        while($row=$result->fetch_assoc()){

            //we create token for this payment    require_once('clases/general/number_format.php')    encrypt($decrypted, $password, $salt='!kQm*fF3pXe1Kbm%9')
            $toko = encrypt($quser,$qidescuela,$codeescuela);
            
            $query = "INSERT INTO pagos (idParciales, fecha_pagar, code, cantidad, token) VALUES ('".$row['idParciales']."', '".$row['qfechapago']."', '".$qcodeuser."', '".$qcolcosto."', '".$toko."')";
            $con->query($query);
            
           // echo "FALTA: ".$row['idParciales']." SIZE: ".$TotalRcount."<br>";
        }
    } else {
        //ya se han generado todos los pagos (no hay necesidad de generar más)
        //echo "Ya existen todos los pagos";
    }

    //NOTE: the surcharge when paid after the limit date will be calculated when printing the receipt
    

    //NOW LET'S PRINT THE LIST OF PAYMENTS
    //we get all the payments for this user:
    
    $sqlt = "SELECT pagos.idPagos, pagos.fecha_pagar, pagos.pagado, pagos.cantidad, pagos.token, parciales.nombre AS qnombre, parciales.descripcion AS qdescripcion FROM pagos, parciales WHERE pagos.idParciales = parciales.idParciales"; 
    $resto = "";
    $rest = $con->query($sqlt);
    while ($rowt = $rest->fetch_assoc()) {

        $pagado = '';
        if ($rowt["pagado"] == '0'){

            $pagado = '

            <form action="student_payments_gateway.php" method="POST">
                <input type="hidden" name="t" value="'.rawurlencode($rowt["token"]).'" />
                <button class="buttonM bRed icon-thumbs-up-2"> '.$texts['sec_status_pagar'].'</button>
            </form>

            ';

            //$pagado = '<a href="student_payments_gateway?t='.rawurlencode($rowt["token"]).'" class="buttonM bRed"><span class="icon-thumbs-up-2"></span><span>'.$texts['sec_status_pagar'].'</span></a>';
            $ver = '<a href="#" class="buttonM bGreyish" style="opacity:0.25; filter:alpha(opacity=25); pointer-events: none; cursor: default;"><span class="icon-zoom-in"></span><span>'.$texts['sec_recibo'].'</span></a>';
            $imprimir = '<a href="#" class="buttonM bGreyish" style="opacity:0.25; filter:alpha(opacity=25); pointer-events: none; cursor: default;"><span class="icon-printer"></span><span>'.$texts['sec_imprimir'].'</span></a>';
        } else {
            $pagado = '<a href="#" class="buttonM bGreen" style="opacity:0.25; filter:alpha(opacity=25); pointer-events: none; cursor: default;"><span class="icon-checkmark-3"></span><span>'.$texts['sec_status_pagado'].'</span></a>';
            $ver = '<a href="#" class="buttonM bGreyish"><span class="icon-zoom-in"></span><span>'.$texts['sec_recibo'].'</span></a>';
            $imprimir = '<a href="#" class="buttonM bGreyish"><span class="icon-printer"></span><span>'.$texts['sec_imprimir'].'</span></a>';
        }

        $resto .= '
        <tr>
            <td class="sortCol">'.$rowt["qnombre"].'</td>
            <td>'.$rowt["qdescripcion"].'</td>
            <td>$'.number_format($rowt["cantidad"],2).'</td>
            <td>
            '.$ver.'
            '.$imprimir.'
            </td>
            <td>'.$pagado.'</td>
        </tr>';

    }
    echo $resto;
    //$texts['sec_nombre']   icon-checkmark-3



?>