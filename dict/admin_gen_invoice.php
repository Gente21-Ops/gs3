<?php

//echo $_SESSION['qlen'];

//DICCIONARIOS
if($_SESSION['qlen'] == "es"){
    $texts = array(
    "title" => "Configuraci&oacute;n de cuenta", 
	"tabletitle" => "Facturaci&oacute;n del mes de ",
	"col_apellidos" => "Apellidos",
	"col_nombre" => "Nombre(s)",
	"col_dir" => "Colegiatura",
	"col_telefono" => "Tel&eacute;fono",
	"col_correo" => "Email",
	"col_fecha" => "Fecha de nacimiento",
	"guardar" => "Guardar cambios",
	"saved" => "Tu información ha sido guardada correctamente",
	"imgchanged" => "Tu imagen se actualiz&oacute; con &eacute;xito",
	"savederror" => "Error al guardar",
	"img_but_browse" => "Cambiar mi foto",
	"img_advice" => "Haz click en 'Buscar foto'");
} else if($_SESSION['qlen'] == "en"){
	$texts = array(
	"title" => "Account settings", 
	"tabletitle" => "Invoicing for the month of ",
	"col_apellidos" => "Last Name",
	"col_nombre" => "Name",
	"col_dir" => "Tuition fee",
	"col_telefono" => "Telephone number",
	"col_correo" => "Email address",
	"col_fecha" => "Date of birth",
	"guardar" => "Save changes",
	"saved" => "Your information has been correctly saved",
	"imgchanged" => "Your picture has been changed successfully",
	"savederror" => "Saving error",
	"img_but_browse" => "Browse picture",
	"img_advice" => "Click on 'Browse picture'");
} else if($_SESSION['qlen'] == "fr"){
	$texts = array(
	"title" => "Accueil", 
	"sec_mensajes" => "Tableau de bord",
	"sec_materias" => "Mis materias",
	"sec_calendario" => "Calendario",
	"sec_inventario" => "Inventario");
}

?>