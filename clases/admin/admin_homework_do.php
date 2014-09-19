<?php
require_once('../clases/mysqlcon.php');

    $elsql = "SELECT tareas.nombre AS qnombre, tareas.descripcion, tareas.fecha, tareas.fechaentrega, grupos.nombre AS qgruponombre, materias.nombre AS qmaterianombre, tareas_status.simpleanswer AS qanswer, tareas_status.answered AS qanswered, tareas_status.doc AS qdoc FROM tareas, grupos, materias, tareas_status WHERE tareas.code = '".$_GET['qcode']."' AND grupos.idGrupos = tareas.idGrupos AND materias.idMaterias = tareas.idMaterias AND tareas_status.code = '".$_GET['qcode']."' AND tareas_status.idAlumno = '".$_GET['qalumno']."'";

    //echo $elsql."<br><br>";
    $result = mysqli_query($con, $elsql);
    $row = mysqli_fetch_assoc($result);


    //get files
    $elsqlf = "SELECT idFiles, name, patho FROM files WHERE code = '".$_GET['qcode']."' AND  codeUser = '".$_SESSION['code']."'";

    //echo $elsqlf."<br><br>";
    $resultf = mysqli_query($con, $elsqlf);
    //$rowf = mysqli_fetch_assoc($resultf);

    //print_r($rowf);

?>