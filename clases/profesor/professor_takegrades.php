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
    //$eldato = $_GET['qyear'].'-'.$_GET['qmonth'].'-'.$_GET['qday'];
    $sqlt = $con->query($elsql); 

    $elsql3 = "SELECT idParciales FROM parciales WHERE abierto = '1' AND codeEscuelas = '".$_SESSION['qescuelacode']."'";
    $sqlt3 = $con->query($elsql3); 
    $row3 = mysqli_fetch_assoc($sqlt3);

    //print_r(expression);
    $output['aaData'] = [];
    while ($aRow = $sqlt->fetch_assoc()) { 

        //I look for faltas, this is an unefficient process!!
        $elsql2 = "SELECT calificacion FROM calificaciones WHERE idUsers = '".$aRow['qiduser']."' 
                    AND idMaterias = '".$_GET['qidmat']."' 
                    AND idGrupos = '".$_GET['qidgrupo']."' 
                    AND idParciales = '".$row3['idParciales']."'";
        echo $elsql2;
        $sqlt2 = $con->query($elsql2);
        $row2 = mysqli_fetch_assoc($sqlt2);
        $faltas = 'checked';

        if(mysqli_num_rows($sqlt2) > 0){
            $faltas = '';
        }

        $chido = [];

        $chido[] = $aRow['qiduser'];
        $chido[] = $aRow['qapellidos'];
        $chido[] = $aRow['qnombre'];  
        $chido[] = '<input type="text" value="'.$row2['calificaciones'].'" />';
        //$aRow['qidgrupos'];

        $output['aaData'][] = $chido;
          
    }
    
    print json_encode($output);
    

?>