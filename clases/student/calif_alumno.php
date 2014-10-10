<?php
    $qcalif = 0;

    $sum = mysql_query("SELECT SUM(calificacion) AS calif FROM calificaciones
        WHERE idUsers = '".$_SESSION['idUsers']."' AND idCiclos = '".$_SESSION['qciclo']."'"); 
    $row_sum = mysql_fetch_assoc($sum); 

    $calif = mysql_query("SELECT COUNT(*) AS cuantasCalif FROM calificaciones
        WHERE idUsers = '".$_SESSION['idUsers']."' AND idCiclos = '".$_SESSION['qciclo']."'"); 
    $row_count = mysql_fetch_assoc($calif); 
    
    if ($row_sum['calif'] != 0 && $row_count['cuantasCalif'] != 0){
    	$promedio = $row_sum['calif'] / $row_count['cuantasCalif'];
    	//echo $promedio;
        $qcalif = $promedio;
	}/* else {
        $qcalif;
		//echo 0;
	}*/

    
?>