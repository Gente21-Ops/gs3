<?php

  include("../logon.php");
  require_once('../mysqlcon.php');

  //UpdateData.php
  $id = $_REQUEST['id'];
  $value = $_REQUEST['value'];
  $column = strtolower($_REQUEST['columnName']);
  $columnPosition = $_REQUEST['columnPosition'] ;
  $columnId = $_REQUEST['columnId'] ;
  $rowId = $_REQUEST['rowId'] ;
  
  $query = "UPDATE tareas SET $column = '$value' WHERE idTareas = '$id'";

  if (!mysqli_query($con,$query)){ //insert new TAREA
    die('Error: ' . mysqli_error($con));
  }

  echo trim($value);
?>