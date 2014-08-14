<?php

//echo $_SESSION['qlen'];

//DICCIONARIOS
if($_SESSION['qlen'] == "es"){
    $texts = array(
    "title" => "Principal", 
	"sec_mensajes" => "Tablero de mensajes",
	"sec_materias" => "Mis materias",
	"sec_materias_ID" => "ID",
	"sec_materias_materia" => "Nombre de la materia",
	"sec_materias_detalle" => "Detalle",
	"sec_calendario" => "Calendario",
	"sec_inventario" => "Inventario");
} else if($_SESSION['qlen'] == "en"){
	$texts = array(
	"title" => "Dashboard", 
	"sec_mensajes" => "Message board",
	"sec_materias" => "My subjects",
	"sec_calendario" => "Calendar",
	"sec_inventario" => "Inventory");
} else if($_SESSION['qlen'] == "fr"){
	$texts = array(
	"title" => "Accueil", 
	"sec_mensajes" => "Tableau de bord",
	"sec_materias" => "Mis materias",
	"sec_calendario" => "Calendario",
	"sec_inventario" => "Inventario");
}

?>