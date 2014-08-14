<?php
    $result_faltas = mysql_query("SELECT COUNT(1) FROM faltas WHERE idUsers = '".$_SESSION['idUsers']."'");
    $row_faltas = mysql_fetch_array($result_faltas);

    $total_faltas = $row_faltas[0];
    echo $total_faltas;
?>