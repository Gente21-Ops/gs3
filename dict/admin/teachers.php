<?php

//echo $_SESSION['qlen'];

//DICCIONARIOS
if($_SESSION['qlen'] == "es"){
    $texts = array(
    "title" => "Maestros", 
	"tabletitle" => "Lista completa de maestros",
	"tableshow" => "Mostrar",
	"col_apellidos" => "Apellidos",
	"col_nombre" => "Nombre(s)",
	"col_telefono" => "Tel&eacute;fono",
	"col_correo" => "Email",
	"col_dir" => "Direcci&oacute;n",
	"table_mostrando" => "Inventario",
	"table_de" => "Inventario",
	"table_al" => "Inventario",
	"table_registros" => "Inventario",
	"agregar_nuevo" => "Agregar nuevo maestro",
	"borrar_existente" => "Borrar maestro seleccionado",
	"agregar" => "Agregar nuevo maestro");
} else if($_SESSION['qlen'] == "en"){
	$texts = array(
	"title" => "Teachers", 
	"tabletitle" => "Complete teacher's list",
	"tableshow" => "Show",
	"col_apellidos" => "Last Name",
	"col_nombre" => "Name(s)",
	"col_telefono" => "Telephone number",
	"col_correo" => "Email",
	"col_dir" => "Address",
	"table_mostrando" => "Showing",
	"table_de" => "of",
	"table_al" => "to",
	"table_registros" => "entries",
	"agregar_nuevo" => "Add new teacher",
	"borrar_existente" => "Delete selected",
	"agregar" => "Add new teacher");
} else if($_SESSION['qlen'] == "fr"){
	$texts = array(
	"title" => "Accueil", 
	"sec_mensajes" => "Tableau de bord",
	"sec_materias" => "Mis materias",
	"sec_calendario" => "Calendario",
	"sec_inventario" => "Inventario");
}

?>