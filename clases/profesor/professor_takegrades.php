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

    if(strlen($_GET['qparcial'])>0){
        $elsql3 = "SELECT idParciales FROM parciales WHERE idParciales = '".$_GET['qparcial']."' AND codeEscuelas = '".$_SESSION['qescuelacode']."'";
        $sqlt3 = $con->query($elsql3); 
        $row3 = mysqli_fetch_assoc($sqlt3);
    } else {
        $elsql3 = "SELECT idParciales FROM parciales WHERE abierto = '1' AND codeEscuelas = '".$_SESSION['qescuelacode']."'";
        $sqlt3 = $con->query($elsql3); 
        $row3 = mysqli_fetch_assoc($sqlt3);
    }
    

    //print_r(expression);
    $output['aaData'] = array();
    while ($aRow = $sqlt->fetch_assoc()) { 

        //I look for faltas, this is an unefficient process!!
        $elsql2 = "SELECT calificacion FROM calificaciones WHERE idUsers = '".$aRow['qiduser']."' 
                    AND idMaterias = '".$_GET['qidmat']."' 
                    AND idGrupos = '".$_GET['qidgrupo']."' 
                    AND idParciales = '".$row3['idParciales']."'";
        //echo $elsql2;
        $sqlt2 = $con->query($elsql2);
        $row2 = mysqli_fetch_assoc($sqlt2);
        $calo = 'checked';

        if($sqlt2->num_rows === 0){
            $calo = '0';
        } else {
            $calo = $row2['calificacion'];
        }

        $chido = array();

        $chido[] = $aRow['qiduser'];
        $chido[] = $aRow['qapellidos'];
        $chido[] = $aRow['qnombre'];  
        $chido[] = '<div class="formRow" style="border-bottom:0; padding:0;">
                        <div class="grid3">
                            <input id="caja_'.$aRow['qiduser'].'" 
                            data-iduser="'.$aRow['qiduser'].'" 
                            data-nameuser="'.$aRow['qnombre'].' '.$aRow['qapellidos'].'" 
                            data-parcialuser="'.$row3['idParciales'].'" 
                            type="text" name="qcalif" placeholder="0.00" value="'.$calo.'" />
                        </div>
                    </div> ';
        $output['aaData'][] = $chido;
          
    }
    
    print json_encode($output);
    

?>