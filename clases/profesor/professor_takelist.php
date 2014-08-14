<?php
//echo "SE<br>";
include("../logon.php");
require_once('../mysqlcon.php');

error_reporting(E_ALL);
ini_set('display_errors', '1');
   
    //lista de alumnos de este grupo
    $elsql = "SELECT 
                users.idUsers AS qiduser, users.nombre AS qnombre, 
                users.apellidos AS qapellidos, map_grupos.idMap_grupos AS qidgrupos
                FROM users, map_grupos 
                WHERE map_grupos.idUsers = users.idUsers 
                AND users.tipo = '2' 
                AND map_grupos.idGrupos = ".$_GET['qidgrupo']." 
                ORDER BY users.apellidos ASC";

    //echo $elsql;
    
    $sqlt = $con->query($elsql); 
    //print_r(expression);
    $output['aaData'] = [];
    while ($aRow = $sqlt->fetch_assoc()) { 

        $chido = [];

        $chido[] = $aRow['qiduser'];
        $chido[] = $aRow['qapellidos'];
        $chido[] = $aRow['qnombre'];  
        $chido[] = '<div class="on_off" onclick="missedday(\''.$aRow['qiduser'].'\'); return false;">
                        <input type="checkbox" id="check1" checked="checked" name="chbox" />
                    </div>';
        //$aRow['qidgrupos'];

        $output['aaData'][] = $chido;
          
    }
    
    print json_encode($output);
    

?>