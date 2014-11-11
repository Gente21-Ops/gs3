<?php

//echo $_SESSION['qlen'];

//DICCIONARIOS
if($_SESSION['qlen'] == "es"){
    $texts = array(
    "rem_title" => "OPCIONES PARA ",
    "rem_descone" => "Opciones del usuario: ", 
	"rem_desctwo" => "<strong>Visible en tu lista de contactos</strong><br><small>(puedes agregarlo de nuevo después)</small>.",
	"rem_descthree" => "<strong>Bloqueado</strong><br><small>(esto impedir&aacute; que el usuario te contacte)</small>.",
	"rem_visible" => "Visible",
	"rem_invisible" => "Invisible",
	"rem_blocked" => "Bloqueado",
	"rem_unblocked" => "Desbloqueado",
	"rem_saved" => "Se guard&oacute; la configuraci&oacute;n",
	"rem_error" => "Error, no se guard&oacute;",
	"rem_cerrar" => "CERRAR",
	"add_title" => "Agregar amigos",
	"table_nick" => "Nick",
	"table_name" => "Nombre",
	"table_tipo" => "Tipo",
	"table_agregar" => "Agregar a lista de amigos",
	"add_col_pic" => "Foto",
	"add_col_nick" => "Nick",
	"add_col_name" => "Nombre",
	"add_col_type" => "Tipo",
	"add_col_add" => "Agregar a la lista"
	);
} else if($_SESSION['qlen'] == "en"){
	$texts = array(
	"rem_title" => "USER OPTIONS",
	"rem_descone" => "Ooptions for user: ", 
	"rem_desctwo" => "<strong>Visible in your contacts list</strong><br><small>(you can add him/her back later)</small>.",
	"rem_descthree" => "<strong>Blocked</strong><br><small>(the user will not not be able to contact you)</small>.",
	"rem_visible" => "Visible",
	"rem_invisible" => "Invisible",
	"rem_blocked" => "Blocked",
	"rem_unblocked" => "Unblocked",
	"rem_saved" => "Configuration saved",
	"rem_error" => "Error, couldn't save",
	"rem_cerrar" => "CLOSE",
	"add_title" => "Add friends",
	"table_nick" => "Nick",
	"table_name" => "Name",
	"table_tipo" => "Type",
	"table_agregar" => "Add to friend's list",
	"add_col_pic" => "Picture",
	"add_col_nick" => "Nick",
	"add_col_name" => "Name",
	"add_col_type" => "Type",
	"add_col_add" => "Add to friend's list"
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