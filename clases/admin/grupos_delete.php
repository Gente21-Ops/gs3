<?php

  require_once('../mysqlcon.php');

  //DeleteData.php
  $id = $_REQUEST['id'] ;

  /* Delete a record by id */ 
  $elsql = "DELETE FROM grupos WHERE idGrupos = '$id'";

  //echo $elsql;
  $sqlt = $con->query($elsql); 

  echo "ok";

?>