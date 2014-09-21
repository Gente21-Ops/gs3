<?php

require_once('connection.php');

$sqlx = "SELECT colegiatura_costo, colegiatura_desc_prontopago, colegiatura_dia_limite, colegiatura_recargo, f_moneda, f_lugarexp, f_em_nombre, f_em_rfc, f_em_calle, f_em_noext, f_em_col, f_em_loc, f_em_referencia, f_em_municipio, f_em_estado, f_em_pais, f_em_cp, f_em_regimen FROM settings WHERE codeEscuelas = '".$_SESSION["qescuelacode"]."' LIMIT 1";

//echo $sqlx."<br>";
$rx = mysql_query($sqlx) or die(mysql_error());
$rowx = mysql_fetch_assoc($rx);
//print_r($rowx);

?>