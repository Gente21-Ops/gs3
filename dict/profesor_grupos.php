<?php

//echo $_SESSION['qlen'];

//DICCIONARIOS
if($_SESSION['qlen'] == "es"){
    $texts = array(
    "title" => "Archivos", 
	"tabletitle" => "Lista de materias",
	"tableshow" => "Mostrar",
	"col_matnom" => "Materia",
	"col_actions" => "Acciones",
	"col_nombre" => "Grupo",
	"col_tareas" => "Tareas",
	"col_lista" => "Lista",
	"col_alumnos" => "Lista de alumnos");
} else if($_SESSION['qlen'] == "en"){
	$texts = array(
	"title" => "Students", 
	"tabletitle" => "Subject's list",
	"tableshow" => "Show",
	"col_matnom" => "Subject",
	"col_actions" => "Actions",
	"col_nombre" => "Group",
	"col_tareas" => "Assignments",
	"col_lista" => "List",
	"col_alumnos" => "Group's students list");
} else if($_SESSION['qlen'] == "fr"){
	$texts = array(
	"title" => "Students", 
	"tabletitle" => "Group's list",
	"tableshow" => "Show",
	"col_matnom" => "Subject",
	"col_actions" => "Attendance",
	"col_nombre" => "Group",
	"col_tareas" => "Tareas",
	"col_lista" => "Group's assignments",
	"col_alumnos" => "Group's students list");
}

?>