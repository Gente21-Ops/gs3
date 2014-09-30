<?php

//include("../logon.php");
require_once('../mysqlcon.php');
//este es un hack relativo a windows:
//require_once('general/number_format.php');


    
    //these array of columns is the order in which they wil appear on the table
    //$aColumns = array('idUsers','apellidos','nombre','telefono','e_mail','direccion');
    
    $elsql = "SELECT users.idUsers, users.nombre, users.apellidos, users.direccion, users.telefono, users.e_mail 
    FROM users, map_familiares
    WHERE users.idUsers = map_familiares.idFamiliar 
    AND map_familiares.idEstudiante = '".$_GET['qestudiante']."'";

    //echo $elsql;
    $sqlt = $con->query($elsql); 
   
    while ($row = $sqlt->fetch_assoc()) {
        /*$row = array();

        for ( $i=0 ; $i<sizeof($aColumns) ; $i++ ) {            
            $row[] = $aRow[ $aColumns[$i] ];            
        };
        */
        $chido[] = $row['idUsers'];
        $chido[] = $row['apellidos'];
        $chido[] = $row['nombre'];
        $chido[] = $row['direccion'];
        $chido[] = $row['telefono'];
        $chido[] = $row['e_mail'];
        
        $output['aaData'][] = $chido;
    }

    print json_encode($output);
    

?>