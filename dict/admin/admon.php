<?php

//echo $_SESSION['qlen'];

//DICCIONARIOS
if($_SESSION['qlen'] == "es"){
    $texts = array(
    "title" => "Administrativos", 
	"tabletitle" => "Lista completa de administrativos",
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
	"agregar_nuevo" => "Agregar nuevo administrativo",
	"borrar_existente" => "Borrar administrativo seleccionado",
	"agregar" => "Agregar nuevo administrativo");
} else if($_SESSION['qlen'] == "en"){
	$texts = array(
	"title" => "Admons", 
	"tabletitle" => "Complete admon's list",
	"tableshow" => "Show",
	"col_apellidos" => "Last Name",
	"col_nombre" => "Name(s)",
	"col_telefono" => "Telephone number",
	"col_correo" => "Email",
	"col_dir" => "Address",
	"dir_calle" => "Street Address 1",
	"dir_colonia" => "Street Address 2",
	"dir_zip" => "Zip Code",
	"dir_municipio" => "Province",
	"dir_estado" => "State",
	"col_env_correo" => "Send email",
	"col_datos" => "View data",
	"col_pass" => "Password",
	"table_mostrando" => "Showing",
	"table_de" => "of",
	"table_al" => "to",
	"table_registros" => "entries",
	"agregar_nuevo" => "Add new admon",
	"borrar_existente" => "Delete selected",
	"agregar" => "Add new admon");
} else if($_SESSION['qlen'] == "fr"){
	$texts = array(
	"title" => "Accueil", 
	"sec_mensajes" => "Tableau de bord",
	"sec_materias" => "Mis materias",
	"sec_calendario" => "Calendario",
	"sec_inventario" => "Inventario");
}

?>