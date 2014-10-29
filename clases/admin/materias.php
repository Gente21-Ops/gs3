<?php

include("../logon.php");
require_once('../mysqlcon.php');
//este es un hack relativo a windows:
//require_once('general/number_format.php');


    
    //these array of columns is the order in which they wil appear on the table
    //$aColumns = array('idMaterias','nombre');
    
    $elsql = "SELECT materias.idMaterias as qid, 
    materias.nombre as qnom_materia, 
    niveles.nombre as qnom_nivel, 
    users.nombre as qnombre,
    users.apellidos as qapellidos 
    FROM materias, niveles, profesores_mapeo_materias, users 
    WHERE materias.idNiveles = niveles.idNiveles 
    AND materias.idMaterias = profesores_mapeo_materias.idMaterias 
    AND niveles.codeEscuelas = '".$_SESSION['qescuelacode']."' 
    AND profesores_mapeo_materias.idUsers = users.idUsers";

    //echo $elsql;
    $sqlt = $con->query($elsql); 

    $output['aaData'] = array();

   
    while ($row = $sqlt->fetch_assoc()) {
        /*$row = array();

        for ( $i=0 ; $i<sizeof($aColumns) ; $i++ ) {            
            $row[] = $aRow[ $aColumns[$i] ];            
        };*/

        $chido = array();

        $chido[] = $row['qid'];
        $chido[] = $row['qnom_materia'];
        $chido[] = $row['qnom_nivel'];
        $chido[] = $row['qnombre']." ".$row['qapellidos'];

        $output['aaData'][] = $chido;
    }

    print json_encode($output);
    

?>