<?php
//echo "SE<br>";
include("../logon.php");
require_once('../mysqlcon.php');

error_reporting(E_ALL);
ini_set('display_errors', '1');
   
    //print_r(expression);
        $JsonArray = array();
        /*$elsql7 = "SELECT DISTINCT idMaterias AS qmaterias, COUNT(DISTINCT idMaterias) as total FROM faltas WHERE idCiclos = '".$_SESSION['qciclo']."'
            AND idUsers = '".$_SESSION['idUsers']."' AND idParciales = '1'";
        $result7 = $con->query($elsql7);*/

        $elsql7 = "SELECT DISTINCT idMaterias AS qmaterias FROM calificaciones WHERE idCiclos = '".$_SESSION['qciclo']."'
            AND idUsers = '".$_SESSION['idUsers']."' AND idParciales = '1'";
        $result7 = $con->query($elsql7);
        
        /*echo "<br><br>";
        print_r($elsql7);
        echo "<br><br>";*/

        if (!$result7) {
            throw new Exception("Database Error [{$this->database->errno}] {$this->database->error}");
        }

        
        
            
        while ($aRow7 = $result7->fetch_assoc()) { 
            $elsql8 = "SELECT calificacion as qcalif FROM calificaciones WHERE idCiclos = '".$_SESSION['qciclo']."'
            AND idUsers = '".$_SESSION['idUsers']."' AND idParciales = '1' AND idMaterias = '".$aRow7['qmaterias']."'";
            $result8 = $con->query($elsql8);

            //print_r($elsql8);
            //echo "<br><br>";
            $query9 = "SELECT idMaterias, nombre FROM materias WHERE idMaterias = '".$aRow7['qmaterias']."'";
            $result9 = mysqli_query($con, $query9);
            $row9 = mysqli_fetch_assoc($result9);

            while ($aRow8 = $result8->fetch_assoc()) { 
                //$JsonArray[] = array( $aRow7['qmaterias'] => $aRow8['total'] );
                //$data1[] = array ($aRow7['qmaterias'], $aRow8['total']);
                $JsonArray[] = array( $row9['nombre'], $aRow8['qcalif'] );
            }
        }
/*
        $arr[] = array(
            'label' => "Label 1", 
            'data' => array(array("Label 1", 1))
        );
*/
        /*echo "<br><br>";
        print_r( $JsonArray );
        echo "<br><br>";
        print json_encode($JsonArray);*/
/*
        $WithLabels = array( 
            "label" => "Sales by Years",
            "data" => $JsonArray
        );
*/
        //print json_encode( $WithLabels );
        echo json_encode( $JsonArray );

?>