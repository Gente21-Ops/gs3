<?php

//include("../logon.php");
require_once('../mysqlcon.php');
//este es un hack relativo a windows:
require_once('../general/number_format.php');


    //VARS
    //These ones need to come from session
    $quser = "1";
    $qidescuela = "1";

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
            
            $query = "INSERT INTO pagos (idParciales, fecha_pagar, idUsers, cantidad) VALUES ('".$row['idParciales']."', '".$row['qfechapago']."', '".$quser."', '".$qcolcosto."')";
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
    //these array of columns is the order in which they wil appear on the table
    $aColumns = array('qnombre','qdescripcion','cantidad','idPagos','idPagos','idPagos','pagado');
    
    $sqlt = $con->query("SELECT pagos.idPagos, pagos.fecha_pagar, pagos.pagado, pagos.cantidad, parciales.nombre AS qnombre, parciales.descripcion AS qdescripcion FROM pagos, parciales WHERE pagos.idParciales = parciales.idParciales"); 
   
    while ($aRow = $sqlt->fetch_assoc()) {
        $row = array();

        for ( $i=0 ; $i<sizeof($aColumns) ; $i++ ) {

            //formatting
            if ($aColumns[$i] == 'cantidad'){
                $row[] = "$".money_format('%!n',$aRow[ $aColumns[$i] ]);
            } else if ($aColumns[$i] == 'pagado'){
                if ($aRow[ $aColumns[$i] ] == '1'){
                    $row[] = '<a href="'.$aRow[ $aColumns[$i] ].'" title="" original-title="Remove" class="tablectrl_small bGreen tipS"><span class="iconb" data-icon="&#xe134;"></span></a>';
                } else {
                    $row[] = '<a href="'.$aRow[ $aColumns[$i] ].'" title="" original-title="Remove" class="tablectrl_small bRed tipS"><span class="iconb" data-icon="&#xe136;"></span></a>';
                }
            } else {
                $row[] = $aRow[ $aColumns[$i] ];
            }
            
        };

        //printf ("%s (%s)\n", $row["qnombre"], $row["qdescripcion"]);
        $output['aaData'][] = $row;
    }

    print json_encode($output);
    

?>