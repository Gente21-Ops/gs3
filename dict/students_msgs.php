<?php
//DICCIONARIOS
if($_SESSION['qlen'] == "es"){
    $texts = array(
    "title" => "Muro de mensajes"); 
} else if($_SESSION['qlen'] == "en"){
	$texts = array(
	"title" => "Message wall");
} else if($_SESSION['qlen'] == "fr"){
	$texts = array(
	"title" => "Mur de messages");
}
?>