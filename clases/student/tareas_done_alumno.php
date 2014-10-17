<?php
/*include("logon.php");
require_once('mysqlcon.php');
error_reporting(0);*/

$cuantasTareasHechas = 0;
$qgrupo = 0;
$qalumno = 0;

	$qgrupo = $_SESSION['qidgrupo'];
    $qalumno = $_SESSION['idUsers'];

    $sql="SELECT tareas.idTareas, COUNT(tareas.idTareas) as cuantas, tareas.nombre, tareas.fecha, tareas.fechaEntrega, 
    tareas_status.status AS qstatus, tareas_status.grade AS qgrade, materias.nombre AS qmatname 
FROM tareas 
INNER JOIN materias ON (materias.idMaterias = tareas.idMaterias) 
INNER JOIN tareas_status ON (tareas_status.code = tareas.code) 
WHERE tareas.idGrupos = '".$qgrupo."' AND (tareas_status.status = '1' OR tareas_status.status = '3') AND tareas_status.idAlumno = '".$qalumno."' 
ORDER BY qmatname ASC, tareas.fechaEntrega ASC";
 
	$rs=$con->query($sql);
	$tareas_done = 0;
	if($rs === false) {
	  $tareas_done = 0;
	} else {
	  $aRow = $rs->fetch_assoc();
	  $tareas_done = $aRow['cuantas'];
	}

    $cuantasTareasHechas = $tareas_done;
?>