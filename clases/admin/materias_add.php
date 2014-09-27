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
  $sql="INSERT INTO materias (nombre, idNiveles) VALUES ('".mysql_real_escape_string($_REQUEST['nombre'])."','".mysql_real_escape_string($_REQUEST['nivel'])."')";
  $con->query($sql);
  $newrecord = $con->insert_id;

  $sql2="INSERT INTO profesores_mapeo_materias (idUsers, idMaterias) VALUES ('".mysql_real_escape_string($_REQUEST['teacher'])."','".mysql_real_escape_string($newrecord)."')";

  $con->query($sql2);

  /* Add new record and place id of the new record into the $id variable */ 
  echo mysqli_insert_id($con);


  mysqli_close($con);

?>