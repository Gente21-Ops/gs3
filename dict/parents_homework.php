<?php

//echo $_SESSION['qlen'];

//DICCIONARIOS
if($_SESSION['qlen'] == "es"){
    $texts = array(
    "title" => "Tareas", 
	"tabletitle" => "Tareas por realizar del alumno: ",
	"tabletitle_done" => "Tareas realizadas",
	"col_titulo" => "T&iacute;tulo de la tarea",
	"col_fecha" => "Creado",
	"col_fechaentrega" => "Fecha de entrega",
	"col_materia" => "Materia",
	"col_correo" => "Acciones",
	"col_grade" => "Calificaci&oacute;n",
	"mod_tarea" => "RESPONDER O MODIFICAR ESTA TAREA",
	"generar_doc_compartido" => "GENERAR O EDITAR DOCUMENTO COMPARTIDO",
	"detalles_tarea" => "Detalles de la tarea",
	"detalle_tarea" => "Detalle de la tarea",
	"archivos_apoyo" => "Archivos de apoyo (proporcionados por el profesor)",
	"subir_archivos" => "Subir archivos",
	"browse_files" => "Buscar archivos");
} else if($_SESSION['qlen'] == "en"){
	$texts = array(
	"title" => "Homework", 
	"tabletitle" => "Homework to be made of student: ",
	"tabletitle_done" => "Homework completed",
	"col_titulo" => "Title",
	"col_fecha" => "Created",
	"col_fechaentrega" => "Due date",
	"col_materia" => "Subject",
	"col_correo" => "Actions",
	"col_grade" => "Grade",
	"mod_tarea" => "Answer or modify this homework",
	"generar_doc_compartido" => "Generate or edit shared document",
	"detalles_tarea" => "Homework details",
	"detalle_tarea" => "Homework detail",
	"archivos_apoyo" => "Support files (given by the teacher)",
	"subir_archivos" => "Upload files",
	"browse_files" => "Browse files");
} else if($_SESSION['qlen'] == "fr"){
	$texts = array(
	"title" => "Accueil", 
	"sec_mensajes" => "Tableau de bord",
	"sec_materias" => "Mis materias",
	"sec_calendario" => "Calendario",
	"sec_inventario" => "Inventario");
}
//echo $texts['mod_tarea'];
?>