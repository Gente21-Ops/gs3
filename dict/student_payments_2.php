<?php

//echo $_SESSION['qlen'];

//DICCIONARIOS
if($_SESSION['qlen'] == "es"){
    $texts = array(
    "title" => "Pago por depósito referenciado a través de BANCOMER", 
	"sec_pagos" => "Detalles del depósito",
	"sec_pagos_banco" => "Banco:",
	"sec_pagos_referencia" => "N&uacute;mero de referencia:",
	"sec_pagos_cuenta" => "Cuenta concentradora:",
	"sec_pagos_pasar" => "Para realizar su pago en efectivo, sirvase pasar a la caja del colegio",
	"sec_pagos_imprimir" => "Imprimir datos del pago",
	"sec_pagos_texto" => "Agradecemos que realice su pago con los siguientes datos:",
	"sec_pagos_nota" => "Esta es una impresión de los datos de depósito, no es un comprobante de pago",
	"sec_pagos_desc" => "Descripci&oacute;n: ",
	"sec_pagos_name" => " a nombre de ",
	"sec_pagos_regresar" => "Regresar a lista de pagos",
	"sec_pagos_subir" => "Subir recibo de pago",
	"sec_pagos_subir_texto" => "Una vez realizado su pago, sírvase subir una copia de este al hacer click en SUBIR RECIBO o jale la foto al s&iacute;mbolo de m&aacute;s (+)",
	"sec_pagos_subir_but" => "SUBIR RECIBO",
	"sec_pagos_thanks_title" => "CONFIRMACI&Oacute;N DE PAGO",
	"sec_pagos_thanks" => "Gracias, su pago se ha completado exitosamente");
} else if($_SESSION['qlen'] == "en"){
	$texts = array(
	"title" => "Payment by bank code (referenced)", 
	"sec_pagos" => "Bank payment details",
	"sec_pagos_banco" => "Bank:",
	"sec_pagos_referencia" => "reference number:",
	"sec_pagos_cuenta" => "Account:",
	"sec_pagos_pasar" => "In order to make your payment in cash, please go to the school's cash desk",
	"sec_pagos_imprimir" => "Print payment data",
	"sec_pagos_texto" => "We appreciate your payment to the following bank account:",
	"sec_pagos_nota" => "This is only a printing of the bank account data, it is not a receipt",
	"sec_pagos_desc" => "Descripction: ",
	"sec_pagos_name" => " for ",
	"sec_pagos_regresar" => "Regresar a lista de pagos",
	"sec_pagos_subir" => "Upload your payment receipt",
	"sec_pagos_subir_texto" => "Once you have made your payment, please upload your receipt by clicking on UPLOAD RECEIPT or drop your picture on the plus simbol (+)",
	"sec_pagos_subir_but" => "UPLOAD RECEIPT",
	"sec_pagos_thanks_title" => "PAYMENT CONFIRMATION",
	"sec_pagos_thanks" => "Thank you, your payment has been correctly processed");
} else if($_SESSION['qlen'] == "fr"){
	$texts = array();
}

?>