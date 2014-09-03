<?php

//echo $_SESSION['qlen'];

//DICCIONARIOS
if($_SESSION['qlen'] == "es"){
    $texts = array(
    "title" => "Calificaciones", 
	"tabletitle" => "Asistencias del parcial ",
	"anotherday" => "Seleccionar otro parcial",
	"col_materia" => "Materia",
	"col_calif" => "Calificación",
	"col_asisok" => "tiene calificación de ",
	"col_asisno" => "no est&aacute; presente el d&iacute;a");
} else if($_SESSION['qlen'] == "en"){
	$texts = array(
	"title" => "Grades", 
	"tabletitle" => "Attendance of mid-term number ",
	"anotherday" => "Pick a different mid-term",
	"col_materia" => "Subject",
	"col_calif" => "Grade",
	"col_asisok" => "has attended on",
	"col_asisno" => "has not attended on");
} else if($_SESSION['qlen'] == "fr"){
	$texts = array(
	"title" => "Assistance", 
	"tabletitle" => "Assistance for the day ",
	"anotherday" => "Select a different day",
	"col_materia" => "Subject",
	"col_calif" => "Grade",
	"col_asisok" => "si est&aacute; presente",
	"col_asisno" => "no est&aacute; presente");
}

?>