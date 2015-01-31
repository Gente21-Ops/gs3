<?php
//echo "SE<br>";
include("../logon.php");
require_once('../mysqlcon.php');

error_reporting(E_ALL);
ini_set('display_errors', '1');

//DICCIONARIO
if($_SESSION['qlen'] == "es"){
$texts = array(
    "view" => "Ver tarea"
    );
} else if($_SESSION['qlen'] == "en"){
    $texts = array(
    "view" => "Review homework"
    );
}

//lista de alumnos de este grupo
$elsql = "SELECT 
            users.idUsers AS qiduser, 
            users.nombre AS qnombre, 
            users.apellidos AS qapellidos, 
            map_grupos.idMap_grupos AS qidgrupos,
            tareas_status.idTareas_status AS qidRespuesta, 
            tareas_status.status AS qstatus, 
            tareas_status.grade AS qgrade, 
            tareas_status.answered AS qfecha 
            FROM users, map_grupos, tareas_status 
            WHERE map_grupos.idUsers = users.idUsers 
            AND users.tipo = '2' 
            AND map_grupos.idGrupos = ".$_GET['qGroupId']." 
            AND tareas_status.idAlumno = users.idUsers 
            AND tareas_status.code = '".$_GET['qcodetareas']."'
            ORDER BY users.apellidos ASC";


//echo $elsql;
$sqlt = $con->query($elsql);   

if($sqlt->num_rows === 0){
    
    $chido = array();
    echo json_encode( $chido );

} else {       
    while ($aRow = $sqlt->fetch_assoc()) {
        $elnombre = $aRow['qnombre']." ".$aRow['qapellidos'];

        $chido = array();
        $chido[] = $aRow['qidRespuesta'];
        $chido[] = $elnombre;
        $chido[] = $aRow['qfecha'];
        $chido[] = $aRow['qgrade'];
        //botón VER TAREA
        $chido[] = '<a href="#" id="newpad" onclick="openPoptareas('.$aRow['qidRespuesta'].')" return false;" class="buttonM bRed"><span class="icol-refresh2"></span><span>'.$texts['view'].'</span></a>';  

        $output['aaData'][] = $chido;
    }
    
    print json_encode($output);
}

?>