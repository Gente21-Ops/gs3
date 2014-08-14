<?php

//echo $_SESSION['qlen'];

//DICCIONARIOS
if($_SESSION['qlen'] == "es"){
    $texts = array(
    "title" => "Generación de factura electr&oacute;nica", 
	"tabletitle" => "Datos fiscales",
	"tableitemos" => "Conceptos",
	"dom_apellidos" => "Nombre(s) y apellidos",
	"dom_rfc" => "RFC",
	"dom_calle" => "Calle",
	"dom_ext" => "N&uacute;mero exterior",
	"dom_col" => "Colonia",
	"dom_loc" => "Localidad",
	"dom_mun" => "Municipio o delegaci&oacute;n",
	"dom_ref" => "Referencia",
	"dom_estado" => "Estado",
	"dom_pais" => "País",
	"dom_cp" => "C&oacute;digo postal",
	"beca" => "Porcentaje de beca",
	"guardar" => "Guardar o modificar datos fiscales",
	"guardar_notice" => "* Solo es necesario guardar los datos fiscales si es un alumno nuevo o existen cambios en los datos",
	"saved" => "La información fiscal del usuario ha sido guardada correctamente",
	"newnotice" => "Este es un usuario nuevo, por favor guarde los datos fiscales antes de continuar",
	"i_desc" => "Descripci&oacute;n",
	"i_cant" => "Cantidad", 
	"i_uni" => "P. Unitario",
	"i_late" => "Recargos",
	"i_disc" => "Descuento",
	"i_prix" => "P. Unitario",
	"i_kill" => "Eliminar concepto",

	"w_title" => "Generando factura...",

	"def_desc" => "Colegiatura mes de ",
	"def_cant" => "1",

	"guardarf" => "Generar factura");
} else if($_SESSION['qlen'] == "en"){
	$texts = array(
	"title" => "Account settings", 
	"tabletitle" => "Account data",
	"col_apellidos" => "Name(s) and Last Name",
	"col_apodo" => "Nickname",
	"col_dir" => "Address",
	"col_telefono" => "Telephone number",
	"col_correo" => "Email address",
	"col_fecha" => "Date of birth",
	"guardar" => "Save changes",
	"saved" => "Your information has been correctly saved",
	"imgchanged" => "Your picture has been changed successfully",
	"savederror" => "Saving error",
	"img_but_browse" => "Browse picture",
	"img_advice" => "Click on 'Browse picture'");
} else if($_SESSION['qlen'] == "fr"){
	$texts = array(
	"title" => "Accueil", 
	"sec_mensajes" => "Tableau de bord",
	"sec_materias" => "Mis materias",
	"sec_calendario" => "Calendario",
	"sec_inventario" => "Inventario");
}

?>