<?php

//echo $_SESSION['qlen'];

//DICCIONARIOS
if($_SESSION['qlen'] == "es"){
    $texts = array(
    "title" => "Familiares", 
	"tabletitle" => "Lista completa de familiares",
	"tableshow" => "Mostrar",
	"col_apellidos" => "Apellidos",
	"col_nombre" => "Nombre(s)",
	"col_telefono" => "Tel&eacute;fono",
	"col_correo" => "Email",
	"col_dir" => "Direcci&oacute;n",
	"col_user" => "Usuario/Nick",
	"dir_calle" => "Calle y número",
	"dir_colonia" => "Colonia",
	"dir_zip" => "Código postal",
	"dir_municipio" => "Municipio",
	"dir_estado" => "Estado",
	"col_env_correo" => "Enviar correo",
	"col_datos" => "Ver datos",
	"col_pass" => "Contraseña",
	"table_mostrando" => "Inventario",
	"table_de" => "Inventario",
	"table_al" => "Inventario",
	"table_registros" => "Inventario",
	"agregar_nuevo" => "Agregar nuevo familiar",
	"borrar_existente" => "Borrar familiar seleccionado",
	"agregar" => "Agregar nuevo familiar",
	"mailSent" => "Su mensaje fue enviado correctamente.",
	"mailNotSent" => "Su mensaje no fue enviado. Por favor, inténtelo más tarde."
	);
} else if($_SESSION['qlen'] == "en"){
	$texts = array(
	"title" => "parents", 
	"tabletitle" => "Complete parent's list",
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
	"agregar_nuevo" => "Add new parent",
	"borrar_existente" => "Delete selected",
	"agregar" => "Add new parent",
	"mailSent" => "Your message was sent successfully.",
	"mailNotSent" => "Your message was not sent. Please try again later."
	);
} else if($_SESSION['qlen'] == "fr"){
	$texts = array(
	"title" => "Accueil", 
	"sec_mensajes" => "Tableau de bord",
	"sec_materias" => "Mis materias",
	"sec_calendario" => "Calendario",
	"sec_inventario" => "Inventario");
}

?>