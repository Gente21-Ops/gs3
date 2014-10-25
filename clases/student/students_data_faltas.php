<?php
session_start();
//echo "SE<br>";
//include("../logon.php");
require_once('../mysqlcon.php');


error_reporting(E_ALL);
ini_set('display_errors', '1');



$elsql7 = "SELECT DISTINCT idMaterias AS qmaterias FROM faltas WHERE idCiclos = '".$_SESSION['qciclo']."'
    AND idUsers = '".$_SESSION['idUsers']."' AND idParciales = '".$_GET['qparcial']."'";
$result7 = $con->query($elsql7);



if($result7->num_rows === 0){
    
    $chido = array();
    echo json_encode( $chido );

} else {    
    
    while ($aRow7 = $result7->fetch_assoc()) { 
        $elsql8 = "SELECT COUNT(idMaterias) as total FROM faltas WHERE idCiclos = '".$_SESSION['qciclo']."'
        AND idUsers = '".$_SESSION['idUsers']."' AND idParciales = '".$_GET['qparcial']."' AND idMaterias = '".$aRow7['qmaterias']."'";
        $result8 = $con->query($elsql8);

        
        
        $query9 = "SELECT idMaterias, nombre FROM materias WHERE idMaterias = '".$aRow7['qmaterias']."'";
        $result9 = mysqli_query($con, $query9);
        $row9 = mysqli_fetch_assoc($result9);
        

        while ($aRow8 = $result8->fetch_assoc()) { 
            
            //$chido = [];
            /*echo "si";
            exit();*/
            $chido[] = $row9['idMaterias'];
            $chido[] = $row9['nombre'];
            $chido[] = $aRow8['total'];  

        
            
            $output['aaData'][] = $chido;
            
        }
    }
    echo json_encode( $output );

}

    

?>