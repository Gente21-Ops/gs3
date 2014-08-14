<?php

//echo $_SESSION['qlen'];

//DICCIONARIOS
if($_SESSION['qlen'] == "es"){
    $texts = array(
    "title" => "Alumnos", 
	"tabletitle" => "Lista completa de alumnos",
	"tableshow" => "Mostrar",
	"col_apellidos" => "Apellidos",
	"col_nombre" => "Nombre(s)",
	"col_direccion" => "Dirección",
	"col_tel" => "Teléfono",
	"col_email" => "Email",
	"col_fechanac" => "Fecha de nacimiento",
	"col_factura" => "Factura",
	"table_mostrando" => "Inventario",
	"table_de" => "Inventario",
	"table_al" => "Inventario",
	"table_registros" => "Inventario",
	"agregar_nuevo" => "Agregar nuevo alumno",
	"borrar_existente" => "Borrar alumno seleccionado",
	"agregar" => "Agregar nuevo alumno");
} else if($_SESSION['qlen'] == "en"){
	$texts = array(
	"title" => "groups", 
	"tabletitle" => "Complete students's list",
	"tableshow" => "Show",
	"col_apellidos" => "Last Name",
	"col_nombre" => "Name(s)",
	"col_direccion" => "Address",
	"col_tel" => "Phone",
	"col_email" => "Email",
	"col_fechanac" => "Date of birth",
	"col_factura" => "Invoice",
	"table_mostrando" => "Showing",
	"table_de" => "of",
	"table_al" => "to",
	"table_registros" => "entries",
	"agregar_nuevo" => "Add new student",
	"borrar_existente" => "Delete selected",
	"agregar" => "Add new student");
} else if($_SESSION['qlen'] == "fr"){
	$texts = array(
	"title" => "Accueil", 
	"sec_mensajes" => "Tableau de bord",
	"sec_materias" => "Mis materias",
	"sec_calendario" => "Calendario",
	"sec_inventario" => "Inventario");
}

?>