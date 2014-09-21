<?php

//echo $_SESSION['qlen'];

//DICCIONARIOS
if($_SESSION['qlen'] == "es"){
    $texts = array(
    "title" => "Pagos", 
	"sec_pagos" => "Colegiaturas y pagos",
	"sec_nombre" => "Nombre",
	"sec_descripcion" => "Descripción",
	"sec_cantidad" => "Cantidad",
	"sec_acciones" => "Acciones",
	"sec_realizar" => "Pagar",
	"sec_recibo" => "Ver recibo",
	"sec_imprimir" => "Imprimir recibo",
	"sec_status" => "Estatus",
	"sec_status_pagar" => "Pagar ahora",
	"sec_status_pagado" => "Pagado",
	"sec_err1_pagado" => "PAGO YA REALIZADO",
	"sec_err2_pagado" => "PAGO NO ENCONTRADO",
	"sec_err1_vertodos" => "VER TODOS LOS PAGOS",
	"sec_err1" => "Pago no encontrado");
} else if($_SESSION['qlen'] == "en"){
	$texts = array(
	"title" => "Payments", 
	"sec_pagos" => "Tuition and fees",
	"sec_nombre" => "Name",
	"sec_descripcion" => "Description",
	"sec_cantidad" => "Quantity",
	"sec_acciones" => "Actions",
	"sec_realizar" => "Make payment",
	"sec_recibo" => "View receipt",
	"sec_imprimir" => "Print",
	"sec_status" => "Status",
	"sec_status_pagar" => "Pay now",
	"sec_status_pagado" => "Payed",
	"sec_err1_pagado" => "ALREADY PAYED",
	"sec_err2_pagado" => "PAYMENT NOT FOUND",
	"sec_err1_vertodos" => "VIEW LIST OF PAYMENTS",
	"sec_err1" => "Payment not found");
} else if($_SESSION['qlen'] == "fr"){
	$texts = array();
}

?>