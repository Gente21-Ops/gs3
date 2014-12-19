<?php

require_once('../mysqlcon.php');

session_start();

	//var_dump($_REQUEST);
  
	$date = date('Y-m-d');
	$sql="INSERT INTO 
	    tareas (code, nombre, idGrupos, idMaterias, descripcion, fechaEntrega, idProfesor) 
	    VALUES (
	      '".mysqli_real_escape_string($con,$_REQUEST['code'])."', 
	      '".mysqli_real_escape_string($con,$_REQUEST['nombre'])."', 
	      '".mysqli_real_escape_string($con,$_REQUEST['idGrupos'])."', 
	      '".mysqli_real_escape_string($con,$_REQUEST['idMateria'])."', 
	      '".mysqli_real_escape_string($con,$_REQUEST['descripcion'])."', 
	      '".mysqli_real_escape_string($con,$_REQUEST['fechaEntrega'])."', 
	      '".mysqli_real_escape_string($con,$_SESSION['idUsers'])."')";

	if (!mysqli_query($con,$sql)){ //insert new TAREA
		die('Error: ' . mysqli_error($con));
	}

	$inserted = mysqli_insert_id($con);
	
	$lastcode = $_REQUEST['code'];

	//esto evita que se guarden records vacios
	if ( strlen($_REQUEST['allfiles']) > 2 && strlen($_REQUEST['allnames']) > 2 ){
		$arrayFotos = explode(",", $_REQUEST['allfiles']); //get file new name array 
		$arrayNames = explode(",", $_REQUEST['allnames']); //get file old name array
		$length = count($arrayFotos);

		for ($i=0; $i<$length; $i++) { //insert file

			$sqlt = "INSERT INTO 
			files (name, patho, code, codeUser) 
			VALUES ('".mysqli_real_escape_string($con,$arrayNames[$i])."', 
				'".mysqli_real_escape_string($con,$arrayFotos[$i])."', 
			  	'".$lastcode."', 
			  	'".$_SESSION['code']."')";

			if (!mysqli_query($con,$sqlt)){
				die('Error: ' . mysqli_error($con));
			}
		}
	}	

	echo $inserted;

	mysqli_close($con);

?>
