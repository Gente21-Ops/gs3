<?php

//echo $_SESSION['qlen'];

//DICCIONARIOS
if($_SESSION['qlen'] == "es"){
    $texts = array(
    "title" => "Datos del Alumno", 
	"tabletitle_faltas" => "Asistencias del parcial ",
	"tabletitle_grades" => "Calificaciones del parcial ",
	"tabletitle_grades2" => "del alumno ",
	"tabletitle_group" => "Alumnos del grupo ",
	"anotherday" => "Seleccionar otro parcial",
	"anothergroup" => "Seleccionar otro grupo",
	"anotherstudent" => "Seleccionar otro alumno",
	"col_materia" => "Materia",
	"col_calif" => "Calificación",
	"col_nombre" => "Nombre",
	"col_apelLido" => "Apellido",
	"col_faltas" => "Faltas",
	"col_asisok" => "tiene calificación de ",
	"col_asisno" => "no est&aacute; presente el d&iacute;a");
} else if($_SESSION['qlen'] == "en"){
	$texts = array(
	"title" => "Student Data", 
	"tabletitle_faltas" => "Attendance of mid-term number ",
	"tabletitle_grades" => "Students of group ",
	"tabletitle_grades2" => "of student ",
	"tabletitle_group" => "Alumnos del grupo ",
	"anotherday" => "Pick a different mid-term",
	"anothergroup" => "Pick a different group",
	"col_materia" => "Subject",
	"col_calif" => "Grade",
	"col_nombre" => "Name",
	"col_apelLido" => "Last name",
	"col_faltas" => "Faltas",
	"col_asisok" => "has attended on",
	"col_asisno" => "has not attended on");
} else if($_SESSION['qlen'] == "fr"){
	$texts = array(
	"title" => "Student Data", 
	"tabletitle_faltas" => "Attendance of mid-term number ",
	"tabletitle_grades" => "Grades of mid-term number ",
	"tabletitle_grades2" => "of student ",
	"tabletitle_group" => "Students of group ",
	"anotherday" => "Select a different day",
	"anothergroup" => "Pick a different group",
	"anotherstudent" => "Seleccionar otro alumno",
	"col_materia" => "Subject",
	"col_calif" => "Grade",
	"col_nombre" => "Name",
	"col_apelLido" => "Last name",
	"col_faltas" => "Faltas",
	"col_asisok" => "si est&aacute; presente",
	"col_asisno" => "no est&aacute; presente");
}

?>