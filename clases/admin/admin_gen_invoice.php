<?php

error_reporting(E_ALL); 
ini_set( 'display_errors','1');

include("../logon.php");
require_once('../mysqlcon.php');



function checkmongo($qcodeuser){ 
    
    $m = new MongoClient();
    $db = $m->selectDB('invoices');
    $collection = new MongoCollection($db, $_SESSION['qescuelacode']);

    $fruitQuery = array("user"=>$qcodeuser, "month"=>$_GET['m'], "year"=>$_GET['y']);
    
    $cursor = $collection->find($fruitQuery);
    $cursor->limit(1);
    if ($cursor->count() < 1){
        return true;
    } else {
        return false;
    }    
    /*return false;*/
}

    //DICCIONARIO el diccionario de los botones va aquí (since I can't access the dict from here)
    if($_SESSION['qlen'] == "es"){
        $texts2 = array(
        "donow" => "Facturar por colegiatura", 
        "delivered" => "Factura entregada");
    } else if($_SESSION['qlen'] == "en"){
        $texts2 = array(
        "donow" => "Tuition fee invoice", 
        "delivered" => "Invoice delivered");
    } else if($_SESSION['qlen'] == "fr"){
        $texts2 = array(
        "donow" => "Faire maintenant", 
        "delivered" => "Faites une revisi&oacute;n S.V.P.");
    }
    
    //these array of columns is the order in which they wil appear on the table
    $aColumns = array('idUsers','apellidos','nombre','telefono','e_mail','code');
    
    $elsql = "SELECT idUsers, nombre, apellidos, code, telefono, e_mail FROM users WHERE tipo = '2'";

    //echo $elsql;
    $sqlt = $con->query($elsql); 
   
    while ($aRow = $sqlt->fetch_assoc()) {
        $row = array();

        for ( $i=0 ; $i<sizeof($aColumns) ; $i++ ) {            

            if ($i == 5){

                //calculo el code
                $elcode = $aRow[$aColumns[$i]]; 

                //echo $elcode."<br>";

                //let's check if this month has been payed
                if (checkmongo($elcode) == false){
                    $row[] = '<strong>'.$texts2['delivered'].'</strong>'; 
                } else {
                    $row[] = '<a href="#" onclick="assignme(\'admin_gen_invoice_do.php?qcode='.$elcode.'&m='.$_GET['m'].'&y='.$_GET['y'].'\',\'content\'); return false;" class="buttonM bGreen"><span class="icon-thumbs-up-2"></span><span>'.$texts2['donow'].'</span></a>';
                }
            } else {
                $row[] = $aRow[ $aColumns[$i] ]; 
            }
                       
        };

        $output['aaData'][] = $row;
    }

    print json_encode($output);
    

?>