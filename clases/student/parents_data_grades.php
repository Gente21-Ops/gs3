<?php
//echo "SE<br>";
include("../logon.php");
require_once('../mysqlcon.php');

error_reporting(E_ALL);
ini_set('display_errors', '1');


$elsql7 = "SELECT DISTINCT idMaterias AS qmaterias FROM calificaciones WHERE idCiclos = '".$_SESSION['qciclo']."'
    AND idUsers = '2' AND idParciales = '".$_GET['qparcial']."'";
$result7 = $con->query($elsql7);

if($result7->num_rows === 0){

} else {    
    
    while ($aRow7 = $result7->fetch_assoc()) { 

        $elsql8 = "SELECT calificacion as qcalif FROM calificaciones WHERE idCiclos = '".$_SESSION['qciclo']."'
        AND idUsers = '2' AND idParciales = '".$_GET['qparcial']."' AND idMaterias = '".$aRow7['qmaterias']."'";
        $result8 = $con->query($elsql8);

        $query9 = "SELECT idMaterias, nombre FROM materias WHERE idMaterias = '".$aRow7['qmaterias']."'";
        $result9 = mysqli_query($con, $query9);
        $row9 = mysqli_fetch_assoc($result9);

        while ($aRow8 = $result8->fetch_assoc()) { 

            $chido = [];

            $chido[] = $row9['idMaterias'];
            $chido[] = $row9['nombre'];
            $chido[] = $aRow8['qcalif'];  
           
            $output['aaData'][] = $chido;
        }
    }
    echo json_encode( $output );

}
    

?>