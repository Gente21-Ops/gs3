<?php
	ob_start();
    require_once('../connection.php');
    session_start();
	//$sth = mysql_query("SELECT DISTINCT(nombre) FROM inventario WHERE codeEscuelas = '".$_SESSION['qescuelacode']."'");
    
    $sth = mysql_query("SELECT DISTINCT(nombre) FROM inventario WHERE codeEscuelas = '".$_SESSION['qescuelacode']."'");
    while ($row = mysql_fetch_array($sth)){ 
		$values[] = $row['nombre'];
    }

    echo '[';
    echo '"' . implode('", "', $values) . '"';
    echo ']';



?>