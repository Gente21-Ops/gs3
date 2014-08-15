<?php

include("../logon.php");
require_once('../mysqlcon.php');

    //extra security layer!!!
    //we make sure that it's not an student who does the change
    if ($_SESSION['tipo'] != '2'){

        date_default_timezone_set($_SESSION['qtimezone']);
        $eltime = $_POST['qdate'].' '.gmdate('H:i:s');
        
        if($_POST['qasistio'] == strval('true')){
            $sql = "DELETE FROM faltas WHERE 
                idUsers = '".$_POST['qiduser']."' 
                AND idMaterias = '".$_POST['qidmateria']."' 
                AND idGrupos = '".$_POST['qidgrupo']."' 
                AND fecha LIKE '".$_POST['qdate']."%'";
        } else {
            $sql = "INSERT INTO faltas (idUsers, idMaterias, idGrupos, fecha) 
                VALUES ('".$_POST['qiduser']."', '".$_POST['qidmateria']."', '".$_POST['qidgrupo']."', '".$eltime."')";
        }
        
        //echo $sql;

        if(!$con->query($sql)){
            echo "0";
        } else {
            echo "1";
        }

    } else {
        //if a student just fails silently
        echo "0";
    }    

?>