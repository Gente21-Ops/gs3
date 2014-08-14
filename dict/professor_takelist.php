<?php

//echo $_SESSION['qlen'];

//DICCIONARIOS
if($_SESSION['qlen'] == "es"){
    $texts = array(
    "title" => "Asistencias", 
	"tabletitle" => "Toma de lista para el d&iacute;a ",
	"anotherday" => "Seleccionar otro d&iacute;a",
	"col_apellidos" => "Apellidos",
	"col_nombre" => "Nombre (s)",
	"col_asistio" => "Presente");
} else if($_SESSION['qlen'] == "en"){
	$texts = array(
	"title" => "Assistance", 
	"tabletitle" => "Assistance for the day ",
	"anotherday" => "Select a different day",
	"col_apellidos" => "Last Name",
	"col_nombre" => "Name",
	"col_asistio" => "Present");
} else if($_SESSION['qlen'] == "fr"){
	$texts = array(
	"title" => "Assistance", 
	"tabletitle" => "Assistance for the day ",
	"anotherday" => "Select a different day",
	"col_apellidos" => "Last Name",
	"col_nombre" => "Name",
	"col_asistio" => "Present");
}

?>