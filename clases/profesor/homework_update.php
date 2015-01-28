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
  
  $query = "UPDATE tareas_status SET $column = '$value' WHERE idTareas_status = '$id'";

  if (!mysqli_query($con,$query)){ //insert new TAREA
    die('Error: ' . mysqli_error($con));
  }
  //echo $id;
  echo trim($value);
?>