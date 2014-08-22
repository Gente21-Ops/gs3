<?php

include("../logon.php");
require_once('../mysqlcon.php');

    //extra security layer!!!
    //we make sure that it's not an student who does the change
    if ($_SESSION['tipo'] != '2'){


        /*
        $sql = "INSERT INTO calificaciones (idUsers, idGrupos, idMaterias, idParciales, ) VALUES         
                ('".$_POST['qiduser']."',
                '".$_POST['qidgrupo']."',
                '".$_POST['qidmateria']."',
                '".$_POST['qparcial']."',
                '".$_POST['qcalif']."')
        ON DUPLICATE KEY UPDATE
        idUsers='".$_POST['qiduser']."', idGrupos='".$_POST['qidgrupo']."', idMaterias='".$_POST['qidmateria']."', 
        idParciales='".$_POST['qparcial']."', calificacion='".$_POST['qcalif']."'";
        */

        /*$sql = "INSERT IGNORE INTO calificaciones
        SET idUsers = '".$_POST['qiduser']."',
        idGrupos = '".$_POST['qidgrupo']."',
        idMaterias = '".$_POST['qidmateria']."',
        idParciales = '".$_POST['qparcial']."',
        calificacion = '".$_POST['qcalif']."'";
*/
        $result = mysqli_query($con,"SELECT * FROM calificaciones WHERE 
            idUsers = '".$_POST['qiduser']."' AND
            idGrupos = '".$_POST['qidgrupo']."' AND
            idMaterias = '".$_POST['qidmateria']."' AND
            idParciales = '".$_POST['qparcial']."'
             ") or die(mysqli_error($con));

        $row_cnt = mysqli_num_rows($result);

        if($row_cnt > 0) {
            mysqli_query($con,"UPDATE calificaciones SET
                idUsers = '".$_POST['qiduser']."', 
                idGrupos = '".$_POST['qidgrupo']."', 
                idMaterias = '".$_POST['qidmateria']."', 
                idParciales = '".$_POST['qparcial']."', 
                calificacion = '".$_POST['qcalif']."'
                WHERE idUsers = '".$_POST['qiduser']."' AND
                idGrupos = '".$_POST['qidgrupo']."' AND
                idMaterias = '".$_POST['qidmateria']."' AND
                idParciales = '".$_POST['qparcial']."'"
            );

            echo $_POST['qcalif'];
        } else {
            mysqli_query($con,"INSERT INTO calificaciones (idUsers, idGrupos, idMaterias, idParciales, calificacion) VALUES         
                ('".$_POST['qiduser']."',
                '".$_POST['qidgrupo']."',
                '".$_POST['qidmateria']."',
                '".$_POST['qparcial']."',
                '".$_POST['qcalif']."')");
            echo $_POST['qcalif'];
        }




        //echo $sql;
/*
        if(!$con->query($sql)){
            echo "0";
        } else {
            echo "1";
        }
*/
    } else {
        //if a student just fails silently
        echo "0";
    }    

?>