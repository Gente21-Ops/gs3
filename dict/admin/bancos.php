<?php

//echo $_SESSION['qlen'];

//DICCIONARIOS
if($_SESSION['qlen'] == "es"){
    $texts = array(
    "title" => "Bancos", 
	"tabletitle" => "Lista completa de bancos",
	"tabletitleDcto" => "Lista completa de descuentos",
	"tableshow" => "Mostrar",
	"col_apellidos" => "Apellidos",
	"col_nombre" => "Nombre(s)",
	"col_proveedor" => "Proveedor",
	"table_mostrando" => "Inventario",
	"table_de" => "Inventario",
	"table_al" => "Inventario",
	"table_registros" => "Inventario",
	"agregar_nuevo" => "Agregar nuevo banco",
	"borrar_existente" => "Borrar banco seleccionado",
	"agregar" => "Agregar nuevo banco",
	"col_porciento" => "Porciento",
	"col_recurrente" => "Recurrente",
	"col_idParciales" => "idParciales",


	"agregar_nuevoDcto" => "Agregar nuevo descuento",
	"borrar_existenteDcto" => "Borrar descuento seleccionado",
	"agregarDcto" => "Agregar nuevo descuento");
} else if($_SESSION['qlen'] == "en"){
	$texts = array(
	"title" => "Banks", 
	"tabletitle" => "Complete provider's list",
	"tableshow" => "Show",
	"col_apellidos" => "Last Name",
	"col_nombre" => "Name(s)",
	"col_proveedor" => "Provider",
	"table_mostrando" => "Showing",
	"table_de" => "of",
	"table_al" => "to",
	"table_registros" => "entries",
	"agregar_nuevo" => "Add new bank",
	"borrar_existente" => "Delete selected",
	"agregar" => "Add new bank");
} else if($_SESSION['qlen'] == "fr"){
	$texts = array(
	"title" => "Accueil", 
	"sec_mensajes" => "Tableau de bord",
	"sec_materias" => "Mis materias",
	"sec_calendario" => "Calendario",
	"sec_inventario" => "Inventario");
}

?>