<?php

//echo $_SESSION['qlen'];

//DICCIONARIOS
if($_SESSION['qlen'] == "es"){
    $texts = array(
    "title" => "Alumnos", 
	"tabletitle" => "Lista completa de alumnos",
	"tableshow" => "Mostrar",
	"col_apellidos" => "Apellidos",
	"col_nombre" => "Nombre(s)",
	"col_telefono" => "Tel&eacute;fono",
	"col_correo" => "Email",
	"col_dir" => "Direcci&oacute;n",
	"col_fam" => "Ver familiares",
	"col_datos" => "Ver datos del alumno",
	"col_env_correo" => "Enviar correo",
	"table_mostrando" => "Inventario",
	"table_de" => "Inventario",
	"table_al" => "Inventario",
	"table_registros" => "Inventario",
	"agregar_nuevo" => "Agregar nuevo alumno",
	"borrar_existente" => "Borrar alumno seleccionado",
	"agregar" => "Agregar nuevo alumno",
	"deldialog" => "Se borrar&aacute; el registro, esta acci&oacute;n no se puede deshacer",
	"deltitle" => "CONFIRME EL BORRADO",
	"f_nombre" => "Nombre(s)",
	"f_apellidos" => "Apellidos",
	"f_contrasena" => "Contrase&ntilde;a",
	"f_direccion" => "Direcci&oacute;n",
	"f_telefono" => "Tel&eacute;fono",
	"f_email" => "Email",
	"table_attendance" => "Asistencias por materia",
	"mailSent" => "Su mensaje fue enviado correctamente.",
	"mailNotSent" => "Su mensaje no fue enviado. Por favor, inténtelo más tarde."
	);
} else if($_SESSION['qlen'] == "en"){
	$texts = array(
	"title" => "Students", 
	"tabletitle" => "Complete student's list",
	"tableshow" => "Show",
	"col_apellidos" => "Last Name",
	"col_nombre" => "Name(s)",
	"col_telefono" => "Telephone number",
	"col_correo" => "Email",
	"col_dir" => "Address",
	"col_fam" => "See relatives",
	"col_datos" => "View student's data",
	"col_env_correo" => "Send email",
	"table_mostrando" => "Showing",
	"table_de" => "of",
	"table_al" => "to",
	"table_registros" => "entries",
	"agregar_nuevo" => "Add new student",
	"borrar_existente" => "Delete selected",
	"agregar" => "Add new student",
	"deldialog" => "The record will be erased, this action cannot be undone",
	"deltitle" => "CONFIRM DELETE",
	"f_nombre" => "Name",
	"f_apellidos" => "Last Name",
	"f_contrasena" => "Password",
	"f_direccion" => "Address",
	"f_telefono" => "Telephone number",
	"f_email" => "Email",
	"table_attendance" => "Attendance by subject",
	"mailSent" => "Your message was sent successfully.",
	"mailNotSent" => "Your message was not sent. Please try again later."
	);
} else if($_SESSION['qlen'] == "fr"){
	$texts = array(
	"title" => "Accueil", 
	"sec_mensajes" => "Tableau de bord",
	"sec_materias" => "Mis materias",
	"sec_calendario" => "Calendario",
	"sec_inventario" => "Inventario");
}

?>