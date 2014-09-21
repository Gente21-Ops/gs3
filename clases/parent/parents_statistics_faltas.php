<?php
include("../logon.php");
require_once('../mysqlcon.php');

error_reporting(E_ALL);
ini_set('display_errors', '1');
   
$JsonArray = array();

$sql2 = "SELECT COUNT(faltas.idMaterias) as total,  materias.nombre, materias.idMaterias 
FROM materias, faltas 
WHERE faltas.idCiclos = '".$_SESSION['qciclo']."' 
AND faltas.idUsers = '".$_GET['qestudiante']."'  
AND faltas.idParciales = '".$_GET['qparcial']."'  
AND materias.idMaterias = faltas.idMaterias 
GROUP BY materias.nombre 
ORDER BY faltas.fecha DESC";

$result2 = $con->query($sql2);

while ($row2 = $result2->fetch_assoc()) { 
    $JsonArray[] = array( $row2['nombre'], $row2['total'] );
}

echo json_encode( $JsonArray );

?>