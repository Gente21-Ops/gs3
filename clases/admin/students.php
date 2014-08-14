<?php

//include("../logon.php");
require_once('../mysqlcon.php');
//este es un hack relativo a windows:
//require_once('general/number_format.php');


    
    //these array of columns is the order in which they wil appear on the table
    $aColumns = array('idUsers','nombre','apellidos','direccion','telefono','e_mail','nacimiento','code');
    
    $elsql = "SELECT idUsers, nombre, apellidos, direccion, telefono, e_mail, nacimiento, code FROM users WHERE tipo = '2'";

    //echo $elsql;
    $sqlt = $con->query($elsql); 

    //var para agarra el id
    $elid = 0;
    $elcode = '0';
    
    while ($aRow = $sqlt->fetch_assoc()) {
        $row = array();

        for ( $i=0 ; $i<sizeof($aColumns) ; $i++ ) {            
            //html para botones
            if ($i == 6){
                //calculo el code
                $elcode = $aRow[$aColumns[$i + 1]];
                $row[] = '<a href="#" onclick="assignme(\'students_homework_do.php?qcode='.$elcode.'\',\'content\'); return false;" class="buttonM bGreen"><span class="icon-thumbs-up-2"></span>TUIT</a>';
                //echo "||".$elcode."||<br><br>";
            } else {
                //seteamos el id
                if ($i == 0){
                    $elid = $aRow[$aColumns[$i]];
                }
                //si no pus solo el valor        
                $row[] = $aRow[ $aColumns[$i] ];
            }           
        };

        $output['aaData'][] = $row;
    }

    print json_encode($output);
    

?>