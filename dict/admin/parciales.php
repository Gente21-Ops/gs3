<?php

//echo $_SESSION['qlen'];

//DICCIONARIOS
if($_SESSION['qlen'] == "es"){
    $texts = array(
    "title" => "Parciales", 
	"tabletitle" => "Lista completa de Parciales",
	"tableshow" => "Mostrar",
	"col_nombre" => "Nombre(s)",
	"col_descripcion" => "Descripcion",
	"col_abierto" => "Abierto",
	"col_limite_pago" => "Limite de pago",
	"col_esparcial" => "Esparcial",
	"table_mostrando" => "Inventario",
	"table_de" => "Inventario",
	"table_al" => "Inventario",
	"table_registros" => "Inventario",
	"agregar_nuevo" => "Agregar nuevo parcial",
	"borrar_existente" => "Borrar parcial seleccionado",
	"agregar" => "Agregar nuevo parcial");
} else if($_SESSION['qlen'] == "en"){
	$texts = array(
	"title" => "Partials", 
	"tabletitle" => "Complete partial's list",
	"tableshow" => "Show",
	"col_nombre" => "Name",
	"col_descripcion" => "Description",
	"col_abierto" => "Open",
	"col_limite_pago" => "Payment limit",
	"col_esparcial" => "Esparcial",
	"table_mostrando" => "Showing",
	"table_de" => "of",
	"table_al" => "to",
	"table_registros" => "entries",
	"agregar_nuevo" => "Add new partial",
	"borrar_existente" => "Delete selected",
	"agregar" => "Add new partial");
} else if($_SESSION['qlen'] == "fr"){
	$texts = array(
	"title" => "Accueil", 
	"sec_mensajes" => "Tableau de bord",
	"sec_materias" => "Mis materias",
	"sec_calendario" => "Calendario",
	"sec_inventario" => "Inventario");
}

?>