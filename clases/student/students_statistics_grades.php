<?php
//echo "SE<br>";
include("../logon.php");
require_once('../mysqlcon.php');

error_reporting(E_ALL);
ini_set('display_errors', '1');
   
$JsonArray = array();

$elsql7 = "SELECT DISTINCT idMaterias AS qmaterias FROM calificaciones WHERE idCiclos = '".$_SESSION['qciclo']."'
    AND idUsers = '".$_SESSION['idUsers']."' AND idParciales = '1'";
$result7 = $con->query($elsql7);

if (!$result7) {
    throw new Exception("Database Error [{$this->database->errno}] {$this->database->error}");
}        
    
while ($aRow7 = $result7->fetch_assoc()) { 
    $elsql8 = "SELECT calificacion as qcalif FROM calificaciones WHERE idCiclos = '".$_SESSION['qciclo']."'
    AND idUsers = '".$_SESSION['idUsers']."' AND idParciales = '1' AND idMaterias = '".$aRow7['qmaterias']."'";
    $result8 = $con->query($elsql8);

    $query9 = "SELECT idMaterias, nombre FROM materias WHERE idMaterias = '".$aRow7['qmaterias']."'";
    $result9 = mysqli_query($con, $query9);
    $row9 = mysqli_fetch_assoc($result9);

    while ($aRow8 = $result8->fetch_assoc()) { 
        $JsonArray[] = array( $row9['nombre'], $aRow8['qcalif'] );
    }
}

echo json_encode( $JsonArray );

?>