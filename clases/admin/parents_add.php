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
  $sql="INSERT INTO users (tipo, nombre, apellidos, pass, direccion, telefono, e_mail, codeEscuelas) VALUES ('4', '".mysql_real_escape_string($_REQUEST['nombre'])."', '".mysql_real_escape_string($_REQUEST['apellidos'])."', '".mysql_real_escape_string($_REQUEST['pass'])."', '".mysql_real_escape_string($_REQUEST['direccion'])."', '".mysql_real_escape_string($_REQUEST['telefono'])."', '".mysql_real_escape_string($_REQUEST['e_mail'])."', '".mysql_real_escape_string($_SESSION['qescuelacode'])."')";

  if (!mysqli_query($con,$sql)){
    die('Error: ' . mysqli_error($con));
  }

  /* Add new record and place id of the new record into the $id variable */ 
  echo mysqli_insert_id($con);


  mysqli_close($con);

?>