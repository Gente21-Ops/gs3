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
  //$elcode = md5($_REQUEST['nombre'].$_REQUEST['apellidos']);
   
  //$stmt = $mysqli->stmt_init();

  $date = date('Y-m-d');
  $sql="INSERT INTO 
        tareas (/*code, */nombre, idGrupos, idMaterias, descripcion, fecha, fechaEntrega, idProfesor) 
        VALUES (
          /*'".mysql_real_escape_string($_REQUEST['nombre'])."', */
          '".mysql_real_escape_string($_REQUEST['nombre'])."', 
          '".mysql_real_escape_string($_REQUEST['idGrupos'])."', 
          '".mysql_real_escape_string($_REQUEST['idMateria'])."', 
          '".mysql_real_escape_string($_REQUEST['desc'])."', 
          '".$date."', 
          '".mysql_real_escape_string($_REQUEST['fechaEntrega'])."', 
          '".mysql_real_escape_string($_SESSION['idUsers'])."')";

  if (!mysqli_query($con,$sql)){
    die('Error: ' . mysqli_error($con));
  }

  /* Add new record and place id of the new record into the $id variable */ 
  echo mysqli_insert_id($con);




  mysqli_close($con);

?>
