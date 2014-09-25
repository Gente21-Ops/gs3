<?php

//include("../logon.php");
require_once('../mysqlcon.php');
//este es un hack relativo a windows:
//require_once('general/number_format.php');


    
    //these array of columns is the order in which they wil appear on the table
    //$aColumns = array('idMaterias','nombre');
    
    $elsql = "SELECT materias.idMaterias as qid, 
    materias.nombre as qnom_materia, 
    niveles.nombre as qnom_nivel 
    FROM materias, niveles 
    WHERE materias.idNiveles = niveles.idNiveles";

    //echo $elsql;
    $sqlt = $con->query($elsql); 

    $output['aaData'] = [];
   
    while ($row = $sqlt->fetch_assoc()) {
        /*$row = array();

        for ( $i=0 ; $i<sizeof($aColumns) ; $i++ ) {            
            $row[] = $aRow[ $aColumns[$i] ];            
        };*/

        $chido = [];

        $chido[] = $row['qid'];
        $chido[] = $row['qnom_materia'];
        $chido[] = $row['qnom_nivel'];

        $output['aaData'][] = $chido;
    }

    print json_encode($output);
    

?>