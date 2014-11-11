<?php

error_reporting(E_ALL); 
ini_set( 'display_errors','1');

//echo "SE<br>";
include("../logon.php");
require_once('../mysqlcon.php');

    function getmytype($num){
        if ($num == 1){
            return 'Maestro';
        } else if ($num == 2){
            return 'Alumno';
        } else if ($num == 3){
            return 'Administrativo';
        } else if ($num == 4){
            return 'Padre de familia';
        }
    }
    
    $elsql = "SELECT idUsers, nick, nombre, apellidos, tipo, code FROM users WHERE code NOT IN (".$_GET['igot'].")";

    $sqlt = $con->query($elsql); 
   
    while ($aRow = $sqlt->fetch_assoc()) {
        $row = array();
            
        $row[] = $aRow['idUsers'];
        $row[] = '<img src="images/users/72/'.$aRow['code'].'.jpg" style="width:50px; height:50px;">';
        $row[] = $aRow['nick'];
        $row[] = $aRow['nombre'].' '.$aRow['apellidos'];
        $row[] = getmytype($aRow['tipo']);
        $row[] = '<div class="on_off">
                                <input type="checkbox" id="fcheck_'.$aRow['idUsers'].'" />
                            </div>';

        $output['aaData'][] = $row;
        
    }

    //print_r($output['aaData']); exit();
    print json_encode($output);
    

?>