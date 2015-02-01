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

/*//get tarea_status
$elsql = "SELECT * FROM tareas_status WHERE idTareas_status = ".$_POST['qnewid'];
$sqlt = $con->query($elsql);   

$row = mysqli_fetch_array($sqlt,MYSQLI_ASSOC);

//get alumnos
$elsql2 = "SELECT idUsers, nombre, apellidos FROM users WHERE idUsers = ".$row['qnewid'];
$sqlt2 = $con->query($elsql2);   
$row2 = mysqli_fetch_array($sqlt2,MYSQLI_ASSOC);

//get tarea
$elsql3 = "SELECT * FROM tareas WHERE idTareas_status = ".$_POST['qnewid'];
$sqlt3 = $con->query($elsql);   
$row3 = mysqli_fetch_array($sqlt3,MYSQLI_ASSOC);
*/

$elsql = "SELECT 
    tareas_status.idTareas_status as qidRespuesta, 
    tareas_status.simpleanswer as qRespuesta, 
    tareas_status.grade as qCalif, 
    tareas_status.answered as qCuando, 
    tareas_status.status as qStatus, 
    users.nombre as qnombre,
    users.apellidos as qapellidos, 
    tareas.nombre qTareaNombre, 
    tareas.descripcion qTareaDesc   
    FROM users, tareas, tareas_status 
    WHERE tareas_status.idTareas_status = ".$_POST['qnewid']."
    AND tareas_status.idAlumno = users.idUsers 
    AND tareas_status.code = tareas.code";

$result = mysqli_query($con,$elsql);
$row = mysqli_fetch_array($result,MYSQLI_ASSOC);

     
//while ($aRow = $sqlt->fetch_assoc()) {
    $elnombre = $row['qnombre']." ".$row['qapellidos'];

    //$chido = array();
    $chido = array("qidRespuesta"=>$row['qidRespuesta'], 
        "qRespuesta"=>$row['qRespuesta'], 
        "qCalif"=>$row['qCalif'], 
        "qCuando"=>$row['qCuando'], 
        "qTareaNombre"=>$row['qTareaNombre'], 
        "qNombreAlumno"=>$elnombre, 
        "qTareaDesc"=>$row['qTareaDesc'],
        "qStatus"=>$row['qStatus']);
    /*$chido[] = $row['qidRespuesta'];
    $chido[] = $row['qRespuesta'];
    $chido[] = $row['qCalif'];
    $chido[] = $row['qCuando'];
    $chido[] = $row['qTareaNombre'];
    $chido[] = $elnombre;
    $chido[] = $row['qTareaDesc'];*/

    //$output['aaData'][] = $chido;
//}

echo json_encode($chido);

//echo $output;
//echo "string"; json_encode("hola mundo");

?>