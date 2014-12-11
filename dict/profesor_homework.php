<?php

//echo $_SESSION['qlen'];

//DICCIONARIOS
if($_SESSION['qlen'] == "es"){
    $texts = array(
    "title" => "Tareas", 
	"tabletitle" => "Lista de tareas",
	"tableshow" => "Mostrar",
	"col_titulo" => "T&iacute;tulo",
	"col_desc" => "Descripci&oacute;n",
	"col_fentrega" => "Entrega",
	"but_agregar" => "Agregar nueva tarea",
	"but_borrar" => "Borrar",
	"but_editar" => "Editar",
	"but_revisar" => "Revisar",
	"dia_diatitle" => "Agregar nueva tarea",
	"dia_title" => "T&iacute;tulo",
	"dia_entrega" => "Fecha de entrega",
	"dia_desc" => "Descripci&oacuten",
	"dia_files" => "Aquí puede adjuntar archivos a la tarea",
	"dia_filesup" => "Subir archivos",
	);
} else if($_SESSION['qlen'] == "en"){
	$texts = array(
	"title" => "groups", 
	"tabletitle" => "Complete group's list",
	"tableshow" => "Show",
	"col_titulo" => "T&iacute;tulo de tarea",
	"col_desc" => "Descripci&oacute;n",
	"col_fentrega" => "Delivery",
	"but_agregar" => "Add new homework",
	"but_borrar" => "Delete",
	"but_editar" => "Edit",
	"but_revisar" => "Review",
	"dia_diatitle" => "Agregar nueva tarea",
	"dia_title" => "T&iacute;tulo",
	"dia_entrega" => "Fecha de entrega",
	"dia_desc" => "Descripci&oacuten",
	"dia_files" => "Aquí puede adjuntar archivos a la tarea",
	"dia_filesup" => "Upload files",
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