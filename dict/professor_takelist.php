<?php

//echo $_SESSION['qlen'];

//DICCIONARIOS
if($_SESSION['qlen'] == "es"){
    $texts = array(
    "title" => "Asistencias", 
	"tabletitle" => "Toma de lista para el d&iacute;a ",
	"anotherday" => "Seleccionar otra fecha",
	"col_apellidos" => "Apellidos",
	"col_nombre" => "Nombre (s)",
	"col_asistio" => "Presente",
	"col_asisok" => "si est&aacute; presente el d&iacute;a",
	"col_asisno" => "no est&aacute; presente el d&iacute;a");
} else if($_SESSION['qlen'] == "en"){
	$texts = array(
	"title" => "Attendance", 
	"tabletitle" => "Attendance for the day ",
	"anotherday" => "Pick a different day",
	"col_apellidos" => "Last Name",
	"col_nombre" => "Name",
	"col_asistio" => "Present",
	"col_asisok" => "has attended on",
	"col_asisno" => "has not attended on");
} else if($_SESSION['qlen'] == "fr"){
	$texts = array(
	"title" => "Assistance", 
	"tabletitle" => "Assistance for the day ",
	"anotherday" => "Select a different day",
	"col_apellidos" => "Last Name",
	"col_nombre" => "Name",
	"col_asistio" => "Present",
	"col_asisok" => "si est&aacute; presente",
	"col_asisno" => "no est&aacute; presente");
}

?>