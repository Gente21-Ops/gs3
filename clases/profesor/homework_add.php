<?php

require_once('../mysqlcon.php');

session_start();

	//var_dump($_REQUEST);
  
	$date = date('Y-m-d');
	$sql="INSERT INTO 
	    tareas (code, nombre, idGrupos, idMaterias, descripcion, fechaEntrega, idProfesor) 
	    VALUES (
	      '".mysql_real_escape_string($_REQUEST['code'])."', 
	      '".mysql_real_escape_string($_REQUEST['nombre'])."', 
	      '".mysql_real_escape_string($_REQUEST['idGrupos'])."', 
	      '".mysql_real_escape_string($_REQUEST['idMateria'])."', 
	      '".mysql_real_escape_string($_REQUEST['descripcion'])."', 
	      '".mysql_real_escape_string($_REQUEST['fechaEntrega'])."', 
	      '".mysql_real_escape_string($_SESSION['idUsers'])."')";

	if (!mysqli_query($con,$sql)){
		die('Error: ' . mysqli_error($con));
	}

	echo mysqli_insert_id($con);

	mysqli_close($con);

?>
