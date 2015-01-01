<?php

    include("../logon.php");
    require_once('../mysqlcon.php');

    date_default_timezone_set("Mexico/General");
    $now = date('Y-m-d H:i:s');

    $query = mysqli_query($con, "SELECT * 
        FROM tareas_status 
        WHERE code = '".$_POST['qcodetareas']."' 
        AND idAlumno = '".$_SESSION['idUsers']."'");

    if(mysqli_num_rows($query) > 0){ //ya existe registro en tareas_status, HACER UPDATE

        $sql = "UPDATE tareas_status 
            SET simpleanswer = '".mysqli_real_escape_string($con,$_POST['qsimpleanswer'])."',
            answered = '".$now."' 
            WHERE code = '".mysqli_real_escape_string($con,$_POST['qcodetareas'])."' 
            AND idAlumno = '".$_SESSION['idUsers']."'";

        if (mysqli_query($con, $sql)) {
            echo "1";
        } else {
            echo "0".$con->error;
        }

        mysqli_close($con);
        
    }else{ //ya existe registro en tareas_status, HACER INSERT


        $sql = "INSERT INTO tareas_status (code,idAlumno,simpleanswer,answered) 
                    VALUES ('".mysqli_real_escape_string($con,$_POST['qcodetareas'])."',
                        '".$_SESSION['idUsers']."',
                        '".mysqli_real_escape_string($con,$_POST['qsimpleanswer'])."',
                        '".$now."')";

        if (mysqli_query($con, $sql)) {
            echo "1";
        } else {
            echo "0".$con->error;
        }

        mysqli_close($con);

    }

    /*$quer = "UPDATE tareas_status SET 
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
	}*/

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