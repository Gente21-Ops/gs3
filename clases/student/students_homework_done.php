<?php

include("../logon.php");
require_once('../mysqlcon.php');

    //these array of columns is the order in which they wil appear on the table
    $aColumns = array('idTareas','nombre','fecha','fechaEntrega','qmatname','qgrade');
    
    //este query obtiene el nombre de otra columna (materias) dado el id (JOIN)
    //elegimos las tareas status 1 & 3
    //aquí hay dos variables, el id del grupo (que identifica a la escuela) y
    //el id del alumno

    //VARS
    $qgrupo = $_SESSION['qidgrupo'];
    $qalumno = $_SESSION['idUsers'];

    //DICCIONARIO el diccionario de los botones va aquí (since I can't access the dict from here)
    if($_SESSION['qlen'] == "es"){
    $texts = array(
        "notgraded" => "NO SE HA CALIFICADO");
    } else if($_SESSION['qlen'] == "en"){
        $texts = array(
        "notgraded" => "NOT GRADED YET");
    } else if($_SESSION['qlen'] == "fr"){
        $texts = array(
        "notgraded" => "PAS ENCORE DE NOTE");
    }

    $elsql = "SELECT tareas.idTareas, tareas.nombre, tareas.fecha, tareas.fechaEntrega, 
    tareas_status.status AS qstatus, tareas_status.grade AS qgrade, materias.nombre AS qmatname 
FROM tareas 
INNER JOIN materias ON (materias.idMaterias = tareas.idMaterias) 
INNER JOIN tareas_status ON (tareas_status.code = tareas.code) 
WHERE tareas.idGrupos = '".$qgrupo."' AND (tareas_status.status = '1' OR tareas_status.status = '3') AND tareas_status.idAlumno = '".$qalumno."' 
ORDER BY qmatname ASC, tareas.fechaEntrega ASC";

    //echo $elsql."<br><br>";
    $sqlt = $con->query($elsql); 
   
   //$output['aaData'] = [];
    while ($aRow = $sqlt->fetch_assoc()) {
        $row = array();

        for ( $i=0 ; $i<sizeof($aColumns) ; $i++ ) {

            //html para botones
            if ($i == 5){
                if($aRow[$aColumns[$i]] == '0'){
                    $row[] = $texts["notgraded"];
                } else {
                    $row[] = '<strong>'.$aRow[ $aColumns[$i] ].'</strong>';
                }
            }

            $row[] = $aRow[ $aColumns[$i] ];            
        };

        $output['aaData'][] = $row;
    }

    print json_encode($output);
    

?>