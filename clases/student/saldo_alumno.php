<?php
	error_reporting(0);
    $result_saldo = mysql_query("SELECT SUM(cantidad) AS value_sum FROM pagos WHERE pagado = 0 AND idUsers = '".$_SESSION['idUsers']."'"); 
    $row_saldo = mysql_fetch_assoc($result_saldo); 
    $sum_saldo = $row_saldo['value_sum'];

    echo number_format($sum_saldo,2);
?>