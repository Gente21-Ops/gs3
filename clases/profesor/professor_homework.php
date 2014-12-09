<?php
//echo "SE<br>";
include("../logon.php");
require_once('../mysqlcon.php');


error_reporting(E_ALL);
ini_set('display_errors', '1');

//DICCIONARIO el diccionario de los botones va aquí (since I can't access the dict from here)
    if($_SESSION['qlen'] == "es"){
    $texts = array(
        "asistencias" => "Asistencias",
        "tareas" => "Tareas de ", 
        "calif" => "Calificaciones");
    } else if($_SESSION['qlen'] == "en"){
        $texts = array(
        "asistencias" => "Attendance",
        "tareas" => "Group's assigments",
        "calif" => "Grades");
    } else if($_SESSION['qlen'] == "fr"){
        $texts = array(
        "asistencias" => "Asistencias",
        "tareas" => "Aller &agrave; l'activit&eacute;",
        "calif" => "Grades", 
        "alumnos" => "T&eacute;l&eacute;charger");
    }

    
    //these array of columns is the order in which they wil appear on the table
    $aColumns = array('qidgrupos','qgruposnombre','qmateriasnombre','qidmaterias','qidmaterias');
    
    //primero obtengo las matarias a las que estoy suscrito
    /*$elsql = "SELECT 
                materias.nombre AS qnommateria, 
                map_materias.idMaterias AS qidmat 
                FROM materias, map_materias 
                WHERE map_materias.idUsers = '".$_SESSION['idUsers']."' 
                AND materias.idMaterias = map_materias.idMaterias 
                ORDER BY materias.nombre ASC";*/

    $elsql = "SELECT 
                idTareas, nombre, descripcion, fecha, fechaEntrega
                FROM tareas 
                WHERE idProfesor = '".$_SESSION['idUsers']."' AND idGrupos = '".$_GET['qgroupid']."'";

    //echo $elsql;
    $sqlt = $con->query($elsql); 
   

if($sqlt->num_rows === 0){
    
    $chido = array();
    echo json_encode( $chido );

} else {       
    while ($aRow = $sqlt->fetch_assoc()) {
        $chido = array();


                $chido[] = $aRow['idTareas'];
                $chido[] = $aRow['nombre'];
                $chido[] = $aRow['descripcion'];  
                $chido[] = $aRow['fecha'];  
                $chido[] = $aRow['fechaEntrega'];  

                $output['aaData'][] = $chido;
            //}

    }
    
    print json_encode($output);
}

?>