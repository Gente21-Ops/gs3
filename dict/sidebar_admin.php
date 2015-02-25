<?php

//echo $_SESSION['qlen'];

//DICCIONARIOS
if($_SESSION['qlen'] == "es"){
    $texts = array(
    "mensajes" => "Mensajes", 
	"tareas" => "Tareas",
	"calendario" => "Calendario",
	"documentos" => "Documentos",
	"lista" => "Alumnos",
	"calificaciones" => "Calificaciones",
	"statistics" => "Rendimiento de Estudiantes",
	"faltas" => "Asistencias",
	"configuracion" => "Configuraci&oacute;n");
} else if($_SESSION['qlen'] == "en"){
	$texts = array(
	"mensajes" => "Messages", 
	"tareas" => "Homeworks",
	"calendario" => "Calendar",
	"documentos" => "Documents",
	"lista" => "Students",
	"calificaciones" => "Grades",
	"statistics" => "Students Performance",
	"faltas" => "Attendance",
	"configuracion" => "Settings");
} else if($_SESSION['qlen'] == "fr"){
	$texts = array();
}

?>