<?php

//echo $_SESSION['qlen'];

//DICCIONARIOS
if($_SESSION['qlen'] == "es"){
    $texts = array(
    "title" => "Grupos", 
	"tabletitle" => "Lista completa de grupos",
	"tableshow" => "Mostrar",
	"col_apellidos" => "Apellidos",
	"col_nombre" => "Nombre(s)",
	"table_mostrando" => "Inventario",
	"table_de" => "Inventario",
	"table_al" => "Inventario",
	"table_registros" => "Inventario",
	"agregar_nuevo" => "Agregar nuevo grupo",
	"borrar_existente" => "Borrar grupo seleccionado",
	"agregar" => "Agregar nuevo grupo");
} else if($_SESSION['qlen'] == "en"){
	$texts = array(
	"title" => "groups", 
	"tabletitle" => "Complete group's list",
	"tableshow" => "Show",
	"col_apellidos" => "Last Name",
	"col_nombre" => "Name(s)",
	"table_mostrando" => "Showing",
	"table_de" => "of",
	"table_al" => "to",
	"table_registros" => "entries",
	"agregar_nuevo" => "Add new group",
	"borrar_existente" => "Delete selected",
	"agregar" => "Add new group");
} else if($_SESSION['qlen'] == "fr"){
	$texts = array(
	"title" => "Accueil", 
	"sec_mensajes" => "Tableau de bord",
	"sec_materias" => "Mis materias",
	"sec_calendario" => "Calendario",
	"sec_inventario" => "Inventario");
}

?>