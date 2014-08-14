<?php

//include("../logon.php");
require_once('../mysqlcon.php');
//este es un hack relativo a windows:
//require_once('general/number_format.php');


    
    //these array of columns is the order in which they wil appear on the table
    $aColumns = array('idMaterias','nombre');
    
    $elsql = "SELECT idMaterias, nombre FROM materias";

    //echo $elsql;
    $sqlt = $con->query($elsql); 
   
    while ($aRow = $sqlt->fetch_assoc()) {
        $row = array();

        for ( $i=0 ; $i<sizeof($aColumns) ; $i++ ) {            
            $row[] = $aRow[ $aColumns[$i] ];            
        };

        $output['aaData'][] = $row;
    }

    print json_encode($output);
    

?>