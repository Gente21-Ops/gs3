<?php

//echo $_SESSION['qlen'];

//DICCIONARIOS
if($_SESSION['qlen'] == "es"){
    $texts = array(
    "title" => "Archivos", 
	"tabletitle" => "Lista de grupos",
	"tableshow" => "Mostrar",
	"col_nombre" => "Nombre del grupo",
	"col_tareas" => "Tareas del grupo",
	"col_alumnos" => "Lista de alumnos");
} else if($_SESSION['qlen'] == "en"){
	$texts = array(
	"title" => "Students", 
	"tabletitle" => "Group's list",
	"tableshow" => "Show",
	"col_nombre" => "Group's name",
	"col_tareas" => "Group's assignments",
	"col_alumnos" => "Group's students list");
} else if($_SESSION['qlen'] == "fr"){
	$texts = array(
	"title" => "Accueil", 
	"sec_mensajes" => "Tableau de bord",
	"sec_materias" => "Mis materias",
	"sec_calendario" => "Calendario",
	"sec_inventario" => "Inventario");
}

?>