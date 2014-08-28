<?php
//echo "SE<br>";
include("../logon.php");
require_once('../mysqlcon.php');

error_reporting(E_ALL);
ini_set('display_errors', '1');
   

    //print_r(expression);
     $JsonArray[] = [];

        $elsql7 = "SELECT DISTINCT idMaterias, COUNT(idMaterias) as total FROM faltas WHERE idCiclos = '".$_SESSION['qciclo']."'
            AND idUsers = '".$_SESSION['idUsers']."' AND idParciales = '1'";
        $result7 = $con->query($elsql7);

        if (!$result7) {
            throw new Exception("Database Error [{$this->database->errno}] {$this->database->error}");
        }

        while ($aRow7 = $result7->fetch_assoc()) { 
        //while($row7 = $result7->fetch_assoc())
        //{
            $rows7[] = $aRow7;
        }

        foreach($rows7 as $row7)
        {
            $JsonArray[] = array( $row7['idMaterias'] => $row7['total'] );
        }

        print_r( $JsonArray );
    
    print json_encode($JsonArray);
    

?>