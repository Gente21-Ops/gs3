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

    $notin = " WHERE code <> '".$_SESSION['code']."'";
    if (strlen($_GET['igot']) > 1){
        $notin = " WHERE code NOT IN (".$_GET['igot'].",'".$_SESSION['code']."')";
    }
    
    //I'm going to add myself to the list because I don't want to add myself as friend
    $elsql = "SELECT idUsers, nick, nombre, apellidos, tipo, code FROM users".$notin;
    //echo $elsql; exit();
    $sqlt = $con->query($elsql); 
   
    while ($aRow = $sqlt->fetch_assoc()) {
        $row = array();
            
        $row[] = $aRow['idUsers'];
        $row[] = '<img src="images/users/72/'.$aRow['code'].'.jpg" style="width:50px; height:50px;">';
        $row[] = $aRow['nick'];
        $row[] = $aRow['nombre'].' '.$aRow['apellidos'];
        $row[] = getmytype($aRow['tipo']);
        $row[] = '<div class="on_off">
                <input type="checkbox" id="fcheck_'.$aRow['code'].'" data-name="'.$aRow['nombre'].' '.$aRow['apellidos'].'" />
                </div>';

        $output['aaData'][] = $row;
        
    }

    //print_r($output['aaData']); exit();
    print json_encode($output);
    

?>