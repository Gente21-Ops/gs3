<?php

//echo $_SESSION['qlen'];

//DICCIONARIOS
if($_SESSION['qlen'] == "es"){
    $texts = array(
    "title" => "Pagos", 
	"sec_pagos" => "Colegiaturas y pagos",
	"sec_form_title" => "Colegiaturas y pagos",
	"sec_form_first" => "Seleccione m&eacute;todo de pago",
	"sec_form_first_select" => "M&eacute;todo de pago",
	"sec_form_first_error" => "Por favor seleccione un m&eacute;todo de pago",
	"sec_form_anterior" => "Anterior",
	"sec_form_cancel" => "Regresar a lista de pagos",
	"sec_form_siguiente" => "Siguiente");
} else if($_SESSION['qlen'] == "en"){
	$texts = array(
	"title" => "Payments", 
	"sec_pagos" => "Tuition and Fees",
	"sec_form_title" => "Tuition and Fees",
	"sec_form_first" => "Please select a payment method",
	"sec_form_first_select" => "Método de pago",
	"sec_form_first_error" => "Please select a payment method",
	"sec_form_anterior" => "Previous",
	"sec_form_cancel" => "Go back to payments' list",
	"sec_form_siguiente" => "Next");
} else if($_SESSION['qlen'] == "fr"){
	$texts = array();
}

?>