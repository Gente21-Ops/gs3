<?php

//include("../logon.php");
require_once('../mysqlcon.php');
//este es un hack relativo a windows:
//require_once('general/number_format.php');


    
    //these array of columns is the order in which they wil appear on the table
    //$aColumns = array('idUsers','apellidos','nombre','telefono','e_mail','direccion');
    
    //$elsql = "SELECT idUsers, nombre, apellidos, direccion, telefono, e_mail FROM users WHERE tipo = '1'";
    $elsql = "SELECT profesores_mapeo_materias.idMaterias as qid, materias.nombre as materia 
    FROM materias,  profesores_mapeo_materias 
    WHERE materias.idMaterias = profesores_mapeo_materias.idMaterias
    AND profesores_mapeo_materias.idUsers = '".$_GET['qmaestro']."'";

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
        $chido[] = $row['materia'];

        $output['aaData'][] = $chido;
    }

    print json_encode($output);
    

?>