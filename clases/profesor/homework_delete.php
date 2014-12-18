<?php

  require_once('../mysqlcon.php');
	session_start();
  //DeleteData.php
  $id = $_REQUEST['id'] ;


$sql2 = "SELECT code FROM tareas WHERE idTareas = '$id'"; //GET CODE FROM file
$result = mysqli_query($con, $sql2);
$row = mysqli_fetch_assoc($result);
$code = $row['code']; 


$sql3 = "SELECT patho FROM files WHERE code = '".$code."'"; //GET NAME (patho)
$result3 = $con->query($sql3);
while($row3 = $result3->fetch_assoc()) {
    $name = $row3["patho"];

    //BORRAR IMAGEN ORIGINAL
    $filename = "../../files/".$_SESSION['qescuelacode']."/".$name;
	if (is_readable($filename)) {
	    unlink($filename);
	    //echo "chido";
	}
 	//BORRAR IMAGEN 37
	$filename = "../../files/".$_SESSION['qescuelacode']."/37/".$name;
	if (is_readable($filename)) {
	    unlink($filename);
	    //echo "chido";
	}
	//BORRAR IMAGEN 72
	$filename = "../../files/".$_SESSION['qescuelacode']."/72/".$name;
	if (is_readable($filename)) {
	    unlink($filename);
	    //echo "chido";
	}
	//BORRAR IMAGEN 120
	$filename = "../../files/".$_SESSION['qescuelacode']."/120/".$name;
	if (is_readable($filename)) {
	    unlink($filename);
	    //echo "chido";
	}
	//BORRAR IMAGEN 320
	$filename = "../../files/".$_SESSION['qescuelacode']."/320/".$name;
	if (is_readable($filename)) {
	    unlink($filename);
	    //echo "chido";
	}
}

$elsql2 = "DELETE FROM files WHERE code = '".$code."'"; /* Delete a record from FILES by CODE */ 
$sqlt2 = $con->query($elsql2); 


  /* Delete a record by id */ 
  $elsql = "DELETE FROM tareas WHERE idTareas = '$id'";

  //echo $elsql;
  $sqlt = $con->query($elsql); 

  //echo "ok";

?>