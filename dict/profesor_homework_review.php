<?php

//echo $_SESSION['qlen'];

//DICCIONARIOS
if($_SESSION['qlen'] == "es"){
    $texts = array(
    "title" => "Tareas", 
	"tabletitle" => "Lista de tareas",
	"tableshow" => "Mostrar",
	"col_nombre" => "Nombre",
	"col_desc" => "Descripci&oacute;n",
	"col_fentrega" => "Entrega",
	"col_calif" => "Calificación",
	"but_agregar" => "Agregar nueva tarea",
	"but_borrar" => "Borrar",
	"but_editar" => "Editar",
	"but_revisar" => "Revisar",
	"dia_diatitle" => "Agregar nueva tarea",
	"dia_title" => "T&iacute;tulo",
	"dia_entrega" => "Fecha de entrega",
	"dia_desc" => "Descripci&oacuten",
	"dia_files" => "Aquí puede adjuntar archivos a la tarea",
	"dia_filesup" => "Buscar archivos",
	"dia_filedel1" => "Archivo",
	"dia_filedel2" => "borrado correctamente"
	);
} else if($_SESSION['qlen'] == "en"){
	$texts = array(
	"title" => "groups", 
	"tabletitle" => "Complete group's list",
	"tableshow" => "Show",
	"col_nombre" => "Nombre",
	"col_desc" => "Descripci&oacute;n",
	"col_fentrega" => "Delivery",
	"col_calif" => "Grade",
	"but_agregar" => "Add new homework",
	"but_borrar" => "Delete",
	"but_editar" => "Edit",
	"but_revisar" => "Review",
	"dia_diatitle" => "Agregar nueva tarea",
	"dia_title" => "T&iacute;tulo",
	"dia_entrega" => "Fecha de entrega",
	"dia_desc" => "Descripci&oacuten",
	"dia_files" => "Aquí puede adjuntar archivos a la tarea",
	"dia_filesup" => "Look for files",
	"dia_filedel1" => "File",
	"dia_filedel2" => "has been deleted"
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