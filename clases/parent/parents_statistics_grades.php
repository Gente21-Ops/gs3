<?php
include("../logon.php");
require_once('../mysqlcon.php');

error_reporting(E_ALL);
ini_set('display_errors', '1');
   
$JsonArray = array();

$sql = "SELECT materias.idMaterias, materias.nombre, calificaciones.calificacion 
FROM materias, calificaciones 
WHERE calificaciones.idCiclos = '".$_SESSION['qciclo']."' 
AND calificaciones.idUsers = '".$_GET['qestudiante']."'  
AND calificaciones.idParciales = '".$_GET['qparcial']."'  
AND materias.idMaterias = calificaciones.idMaterias
GROUP BY materias.nombre
ORDER BY calificaciones.calificacion DESC";

$result = $con->query($sql);
    
while ($row = $result->fetch_assoc()) { 
    $JsonArray[] = array( $row['nombre'], $row['calificacion'] );
}

echo json_encode( $JsonArray );

?>