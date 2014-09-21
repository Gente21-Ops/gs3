<?php

//echo $_SESSION['qlen'];

//DICCIONARIOS
if($_SESSION['qlen'] == "es"){
    $texts = array(
    "title" => "Pagos", 
	"sec_pagos" => "Colegiaturas y pagos",
	"sec_pagos_pasar" => "Para realizar su pago en efectivo, sirvase pasar a la caja del colegio",
	"sec_pagos_regresar" => "Regresar a lista de pagos");
} else if($_SESSION['qlen'] == "en"){
	$texts = array(
	"title" => "Payments", 
	"sec_pagos" => "Tuition and Fees",
	"sec_pagos_pasar" => "In order to make your payment in cash, please go to the school's cash desk",
	"sec_pagos_regresar" => "Regresar a lista de pagos");
} else if($_SESSION['qlen'] == "fr"){
	$texts = array();
}

?>