<?php

include("../logon.php");
require_once('../mysqlcon.php');

    //extra security layer!!!
    //we make sure that it's not an student who does the change
    if ($_SESSION['tipo'] != '2'){

        //date_default_timezone_set($_SESSION['qtimezone']);
        //$eltime = $_POST['qdate'].' '.gmdate('H:i:s');
        
        /*if($_POST['qasistio'] == strval('true')){
            $sql = "UPDATE tareas_status SET status = 2 WHERE idTareas_status = ".$_POST['qiduser'];
        } else {
            $sql = "UPDATE tareas_status SET status = 3 WHERE idTareas_status = ".$_POST['qiduser'];
        }*/
        $sql = "UPDATE tareas_status SET grade = '".$_POST['nuevaCalifo']."' WHERE idTareas_status = ".$_POST['qido'];
        
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