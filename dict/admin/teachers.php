<?php

//echo $_SESSION['qlen'];

//DICCIONARIOS
if($_SESSION['qlen'] == "es"){
    $texts = array(
    "title" => "Maestros", 
	"tabletitle" => "Lista completa de maestros",
	"tabletitle_subjects" => "Lista de materias que imparte el(la) profesor(a): ",
	"tableshow" => "Mostrar",
	"col_apellidos" => "Apellidos",
	"col_nombre" => "Nombre(s)",
	"col_telefono" => "Tel&eacute;fono",
	"col_correo" => "Email",
	"col_dir" => "Direcci&oacute;n",
	"col_materias" => "Materias",
	"col_datos" => "Ver datos del profesor",
	"col_env_correo" => "Enviar correo",
	"materia" => "Materia",
	"materias" => "Materias",
	"col_but" => "Ver materias",
	"table_mostrando" => "Inventario",
	"table_de" => "Inventario",
	"table_al" => "Inventario",
	"table_registros" => "Inventario",
	"agregar_nuevo" => "Agregar nuevo maestro",
	"borrar_existente" => "Borrar maestro seleccionado",
	"agregar_nuevo_subject" => "Agregar nuevo materia",
	"borrar_existente_subject" => "Borrar materia seleccionado",
	"agregar" => "Agregar nuevo maestro",
	"agregar_subject" => "Agregar nueva materia");
} else if($_SESSION['qlen'] == "en"){
	$texts = array(
	"title" => "Teachers", 
	"tabletitle" => "Complete teacher's list",
	"tabletitle_subjects" => "Subject's list from teacher: ",
	"tableshow" => "Show",
	"col_apellidos" => "Last Name",
	"col_nombre" => "Name(s)",
	"col_telefono" => "Telephone number",
	"col_correo" => "Email",
	"col_dir" => "Address",
	"col_materias" => "Subjects",
	"materia" => "Subject",
	"col_but" => "View subjects",
	"table_mostrando" => "Showing",
	"table_de" => "of",
	"table_al" => "to",
	"table_registros" => "entries",
	"agregar_nuevo" => "Add new teacher",
	"borrar_existente" => "Delete selected",
	"agregar_nuevo_subject" => "Add new subject",
	"borrar_existente_subject" => "Delete selected",
	"agregar" => "Add new teacher",
	"agregar_subject" => "Agregar nueva materia");
} else if($_SESSION['qlen'] == "fr"){
	$texts = array(
	"title" => "Accueil", 
	"sec_mensajes" => "Tableau de bord",
	"sec_materias" => "Mis materias",
	"sec_calendario" => "Calendario",
	"sec_inventario" => "Inventario");
}

?>