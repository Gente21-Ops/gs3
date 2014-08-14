<?php
    $calif_sum = mysql_query("SELECT SUM(calificacion) AS calif FROM calificaciones WHERE idUsers = '".$_SESSION['idUsers']."'"); 
    $row_sum = mysql_fetch_assoc($calif_sum); 

    $calif_count = mysql_query("SELECT COUNT(*) AS cuantos FROM calificaciones WHERE idUsers = '".$_SESSION['idUsers']."'"); 
    $row_count = mysql_fetch_assoc($calif_count); 

    //echo $row_sum['calif']."<br>";
    //echo $row_count['cuantos'];
    
    if ($row_sum['calif'] != 0 && $row_count['cuantos'] != 0){
    	$prom_gral = $row_sum['calif'] / $row_count['cuantos'];
    	echo $prom_gral;
	} else {
		echo 0;
	}

    
?>