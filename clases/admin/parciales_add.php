<?php

require_once('../mysqlcon.php');
session_start();
  //AddData.php
  //extract($_REQUEST);
  /*
  echo $_REQUEST['nombre'];
  echo $_REQUEST['apellidos'];
  echo $_REQUEST['pass'];
  echo $_REQUEST['direccion'];
  echo $_REQUEST['telefono'];
  echo $_REQUEST['e_mail']."<br><br>";
  */
 
  //calculate user's code
  $elcode = md5($_REQUEST['nombre'].$_REQUEST['apellidos']);
   
  //$stmt = $mysqli->stmt_init();
  $sql="INSERT INTO parciales (nombre, descripcion, abierto, limite_pago, esparcial) VALUES ('".mysql_real_escape_string($_REQUEST['nombre'])."', '".mysql_real_escape_string($_REQUEST['descripcion'])."', '".mysql_real_escape_string($_REQUEST['abierto'])."', '".mysql_real_escape_string($_REQUEST['limite_pago'])."', '".mysql_real_escape_string($_REQUEST['esparcial'])."')";

  if (!mysqli_query($con,$sql)){
    die('Error: ' . mysqli_error($con));
  }

  /* Add new record and place id of the new record into the $id variable */ 
  echo mysqli_insert_id($con);


  mysqli_close($con);

?>