<?php

//echo $_SESSION['qlen'];

//DICCIONARIOS
if($_SESSION['qlen'] == "es"){
    $texts = array(
    "title" => "Descuentos", 
	"tabletitle" => "Lista completa de descuentos",
	"tableshow" => "Mostrar",
	"col_nombre" => "Nombre(s)",
	"col_porciento" => "Porciento",
	"col_recurrente" => "Recurrente",
	"col_idParciales" => "idParciales",
	"table_mostrando" => "Inventario",
	"table_de" => "Inventario",
	"table_al" => "Inventario",
	"table_registros" => "Inventario",
	"agregar_nuevo" => "Agregar nuevo descuento",
	"borrar_existente" => "Borrar descuento seleccionado",
	"agregar" => "Agregar nuevo descuento");
} else if($_SESSION['qlen'] == "en"){
	$texts = array(
	"title" => "Discountss", 
	"tabletitle" => "Complete discount's list",
	"tableshow" => "Show",
	"col_nombre" => "Name",
	"col_porciento" => "Percent",
	"col_recurrente" => "Recurrent",
	"col_idParciales" => "idParciales",
	"table_mostrando" => "Showing",
	"table_de" => "of",
	"table_al" => "to",
	"table_registros" => "entries",
	"agregar_nuevo" => "Add new discount",
	"borrar_existente" => "Delete selected",
	"agregar" => "Add new discount");
} else if($_SESSION['qlen'] == "fr"){
	$texts = array(
	"title" => "Accueil", 
	"sec_mensajes" => "Tableau de bord",
	"sec_materias" => "Mis materias",
	"sec_calendario" => "Calendario",
	"sec_inventario" => "Inventario");
}

?>