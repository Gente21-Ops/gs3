<?php

//echo $_SESSION['qlen'];

//DICCIONARIOS
if($_SESSION['qlen'] == "es"){
    $texts = array(
    "title" => "Configuraci&oacute;n de cuenta", 
	"tabletitle" => "Datos de cuenta",
	"col_apellidos" => "Nombre(s) y apellidos",
	"col_apodo" => "Apodo",
	"col_dir" => "Direcci&oacute;n",
	"col_calle" => "Calle y n&uacute;mero",
	"col_colonia" => "Colonia",
	"col_zip" => "Código Postal",
	"col_municipio" => "Municipio",
	"col_edo" => "Estado",
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
	"tabletitle" => "Account data",
	"col_apellidos" => "Name(s) and Last Name",
	"col_apodo" => "Nickname",
	"col_dir" => "Address Line 1",
	"col_calle" => "Address Line 2",
	"col_colonia" => "Colonia",
	"col_zip" => "Zip Code",
	"col_municipio" => "Province",
	"col_edo" => "State",
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