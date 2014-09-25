<?php

//echo $_SESSION['qlen'];

//DICCIONARIOS
if($_SESSION['qlen'] == "es"){
    $texts = array(
    "title" => "Materias", 
    "materia" => "Materia",
	"tabletitle" => "Lista completa de materias",
	"tableshow" => "Mostrar",
	"col_apellidos" => "Apellidos",
	"col_nombre" => "Nombre(s)",
	"table_mostrando" => "Inventario",
	"table_de" => "Inventario",
	"table_al" => "Inventario",
	"table_registros" => "Inventario",
	"agregar_nuevo" => "Agregar nueva materia",
	"borrar_existente" => "Borrar materia seleccionada",
	"agregar" => "Agregar nueva materia",
	"tabletitlePar" => "Lista completa de Parciales",
	"tableshow" => "Mostrar",
	"col_nombre" => "Nombre(s)",
	"col_nivel" => "Nivel",
	"col_descripcion" => "Descripcion",
	"col_abierto" => "Abierto",
	"col_limite_pago" => "Limite de pago",
	"col_esparcial" => "Esparcial",
	"table_mostrando" => "Inventario",
	"table_de" => "Inventario",
	"table_al" => "Inventario",
	"table_registros" => "Inventario",
	"agregar_nuevoPar" => "Agregar nuevo parcial",
	"borrar_existentePar" => "Borrar parcial seleccionado",
	"agregarPar" => "Agregar nuevo parcial");
} else if($_SESSION['qlen'] == "en"){
	$texts = array(
	"title" => "subjects", 
	"materia" => "Subject",
	"tabletitle" => "Complete subjects list",
	"tableshow" => "Show",
	"col_apellidos" => "Last Name",
	"col_nombre" => "Name(s)",
	"col_nivel" => "Level",
	"table_mostrando" => "Showing",
	"table_de" => "of",
	"table_al" => "to",
	"table_registros" => "entries",
	"agregar_nuevo" => "Add new subject",
	"borrar_existente" => "Delete subject",
	"agregar" => "Add new subject");
} else if($_SESSION['qlen'] == "fr"){
	$texts = array(
	"title" => "Accueil", 
	"sec_mensajes" => "Tableau de bord",
	"sec_materias" => "Mis materias",
	"sec_calendario" => "Calendario",
	"sec_inventario" => "Inventario");
}

?>