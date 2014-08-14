<?php

//include("../logon.php");
require_once('../mysqlcon.php');

    //these array of columns is the order in which they wil appear on the table
    $aColumns = array('idUsers','apellidos','nombre','telefono','e_mail','direccion');
    
    $elsql = "SELECT materias.idMaterias, materias.nombre 
FROM materias 
INNER JOIN mapmaterias ON (mapmaterias.idMaterias = materias.idMaterias) 
INNER JOIN users ON (users.idUsers = mapmaterias.idUsers) 
WHERE users.idUsers = '1' 
ORDER BY materias.nombre";

    echo $elsql."<br><br>";
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