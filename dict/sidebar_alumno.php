<?php

//echo $_SESSION['qlen'];

//DICCIONARIOS
if($_SESSION['qlen'] == "es"){
    $texts = array(
    "mensajes" => "Mensajes", 
	"tareas" => "Tareas",
	"calendario" => "Calendario",
	"documentos" => "Documentos",
	"estadisticas" => "Alumno",
	"calificaciones" => "Estadísticas",
	"configuracion" => "Configuraci&oacute;n");
} else if($_SESSION['qlen'] == "en"){
	$texts = array(
	"mensajes" => "Messages", 
	"tareas" => "Homeworks",
	"calendario" => "Calendar",
	"documentos" => "Documents",
	"estadisticas" => "Student",
	"calificaciones" => "Statistics",
	"configuracion" => "Settings");
} else if($_SESSION['qlen'] == "fr"){
	$texts = array();
}

?>