<?php
//echo "SE<br>";
include("logon.php");
require_once('mysqlcon.php');

error_reporting(E_ALL);
ini_set('display_errors', '1');

/*
//DICCIONARIO
if($_SESSION['qlen'] == "es"){
$texts = array(
    "view" => "Ver tarea"
    );
} else if($_SESSION['qlen'] == "en"){
    $texts = array(
    "view" => "Review homework"
    );
}*/

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
    idUsers as qidUser, 
    nombre as qNombre, 
    apellidos as qApellidos, 
    nick as qNick, 
    calle_num as qCalle, 
    colonia as qColonia, 
    zip_code as qZip, 
    municipio as qMunicipio, 
    estado as qEstado, 
    e_mail as qEmail, 
    telefono as qTel,
    nacimiento as qFechNac 
    FROM users
    WHERE idUsers = ".$_POST['qnewid']."";

$result = mysqli_query($con,$elsql);
$row = mysqli_fetch_array($result,MYSQLI_ASSOC);

     
//while ($aRow = $sqlt->fetch_assoc()) {
    $elnombre = $row['qNombre']." ".$row['qApellidos'];

    //$chido = array();
    $chido = array("qidUser"=>$row['qidUser'], 
        "qNombre"=>$elnombre, 
        "qNick"=>$row['qNick'], 
        "qCalle"=>$row['qCalle'], 
        "qColonia"=>$row['qColonia'], 
        "qZip"=>$row['qZip'], 
        "qMunicipio"=>$row['qMunicipio'], 
        "qEstado"=>$row['qEstado'], 
        "qEmail"=>$row['qEmail'], 
        "qTel"=>$row['qTel'], 
        "qFechNac"=>$row['qFechNac']);
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