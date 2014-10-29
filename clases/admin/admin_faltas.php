<?php
//echo "SE<br>";
include("../logon.php");
require_once('../mysqlcon.php');

error_reporting(E_ALL);
ini_set('display_errors', '1');

$sql = "SELECT COUNT(faltas.idMaterias) as total,  materias.nombre, materias.idMaterias 
FROM materias, faltas 
WHERE faltas.idCiclos = '".$_SESSION['qciclo']."' 
AND faltas.idUsers = '".$_GET['qestudiante']."'  
AND faltas.idParciales = '".$_GET['qparcial']."'  
AND materias.idMaterias = faltas.idMaterias 
GROUP BY materias.nombre 
ORDER BY faltas.fecha DESC";

$result = $con->query($sql);

$output['aaData'] = array();
    
while ($row = $result->fetch_assoc()) { 

    $chido = array();

    $chido[] = $row['idMaterias'];
    $chido[] = $row['nombre'];
    $chido[] = $row['total'];  
   
    $output['aaData'][] = $chido;
}

echo json_encode( $output );
    

?>