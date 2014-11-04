<?php

//echo $_SESSION['qlen'];

//DICCIONARIOS
if($_SESSION['qlen'] == "es"){
    $texts = array(
    "rem_title" => "ELIMINAR USUARIO",
    "rem_descone" => "El usuario ", 
	"rem_desctwo" => " ser&aacute; eliminado de tu lista de contactos (puedes agregarlo de nuevo después).",
	"rem_sure" => "¿Estás seguro de que quieres eliminarlo?",
	"col_apodo" => "Apodo",
	"col_dir" => "Direcci&oacute;n",
	"col_calle" => "Calle y n&uacute;mero",
	"col_colonia" => "Colonia",
	"col_zip" => "Código Postal",
	"col_municipio" => "Municipio");
} else if($_SESSION['qlen'] == "en"){
	$texts = array(
	"rem_title" => "REMOVE USER",
	"rem_descone" => "User ", 
	"rem_desctwo" => " will be removed from your contacts list, you can add him/her back later.",
	"rem_sure" => "Are you sure you want to remove him/her?",
	"col_apodo" => "Nickname",
	"col_dir" => "Address Line 1",
	"col_calle" => "Address Line 2",
	"col_colonia" => "Colonia",
	"col_zip" => "Zip Code",
	"col_municipio" => "Province");
} else if($_SESSION['qlen'] == "fr"){
	$texts = array(
	"title" => "Accueil", 
	"sec_mensajes" => "Tableau de bord",
	"sec_materias" => "Mis materias",
	"sec_calendario" => "Calendario",
	"sec_inventario" => "Inventario");
}

?>