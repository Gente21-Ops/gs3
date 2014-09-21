<?php

    include("../logon.php");
    require_once('../mysqlcon.php');

    date_default_timezone_set("Mexico/General");
    $now = date('Y-m-d H:i:s');

    $quer = "UPDATE tareas_status SET 
    simpleanswer = ?,
    answered = ? 
    WHERE code = ? 
    AND idAlumno = ?";

    //prepare nos cuida de inyecciones de código
    if ($stmt = $con->prepare($quer)) {
    	//hay que poner tantas 's' como parámetros haya
		$stmt->bind_param("ssss", 
			$_POST['qsimpleanswer'],
			$now,
			$_POST['qcodetareas'],
			$_SESSION['idUsers']);
		if($stmt->execute()){
			echo "1";
		}
	} else {
		echo "0".$con->error;
	}

/*
    $sqlt = "UPDATE tareas_status set simpleanswer = '".$_POST['qsimpleanswer']."' 
    WHERE idTareas = '".$_POST['qidtareas']."' AND idAlumno = '".$_SESSION['idUsers']."'"; 
    
    if (!$con->query($sqlt)){
        echo "0:".$sqlt;
    } else {
        echo "1";
    }
*/

?>