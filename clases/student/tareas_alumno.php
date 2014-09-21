<?php

include("../logon.php");
require_once('../mysqlcon.php');
	//error_reporting(0);
	$qgrupo = $_SESSION['qidgrupo'];
    $qalumno = $_SESSION['idUsers'];

    $sql="SELECT tareas.idTareas, COUNT(tareas.idTareas) as cuantas, tareas.code AS qcode, tareas.nombre, tareas.fecha, tareas.fechaEntrega, 
    tareas_status.status AS qstatus, materias.nombre AS qmatname 
FROM tareas 
INNER JOIN materias ON (materias.idMaterias = tareas.idMaterias) 
INNER JOIN tareas_status ON (tareas_status.code = tareas.code) 
WHERE tareas.idGrupos = '".$qgrupo."' AND (tareas_status.status = '0' OR tareas_status.status = '2') AND tareas_status.idAlumno = '".$qalumno."' 
ORDER BY qmatname ASC, tareas.fechaEntrega ASC";
 
	$rs=$con->query($sql);
	$tareas = 0;
	if($rs === false) {
	  $tareas = 0;
	} else {
	  $aRow = $rs->fetch_assoc();
	  $tareas = $aRow['cuantas'];
	}

    echo $tareas;
?>