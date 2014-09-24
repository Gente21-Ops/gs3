<?php

  require_once('../mysqlcon.php');

  //DeleteData.php
  $id = $_REQUEST['id'] ;

  /* Delete a record by id */ 
  $elsql = "DELETE FROM profesores_mapeo_materias WHERE idProfesores_mapeo_materias = '$id'";

  //echo $elsql;
  $sqlt = $con->query($elsql); 

  //echo "ok";

?>