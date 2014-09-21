<?php
//DICCIONARIOS
if($_SESSION['qlen'] == "es"){
    $texts = array(
    "title" => "Calendario");
} else if($_SESSION['qlen'] == "en"){
	$texts = array(
	"title" => "Calendar");
} else if($_SESSION['qlen'] == "fr"){
	$texts = array(
	"title" => "Calendrier");
}
?>