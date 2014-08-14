<?php

  require_once('../mysqlcon.php');

  //UpdateData.php
  $id = $_REQUEST['id'];
  $value = $_REQUEST['value'];
  $column = strtolower($_REQUEST['columnName']);
  $columnPosition = $_REQUEST['columnPosition'] ;
  $columnId = $_REQUEST['columnId'] ;
  $rowId = $_REQUEST['rowId'] ;

  /* Update a record using information about id, columnName (property
     of the object or column in the table) and value that should be
     set */
  
  $query = "UPDATE descuentos SET $column = '$value' WHERE idDescuentos = '$id'";
  mysqli_query($con,$query);
  //echo $query;

  echo $value;

?>