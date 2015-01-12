<?php
//echo "SE<br>";
include("../logon.php");
require_once('../mysqlcon.php');

error_reporting(E_ALL);
ini_set('display_errors', '1');

//DICCIONARIO el diccionario de los botones va aquí (since I can't access the dict from here)
    if($_SESSION['qlen'] == "es"){
    $texts = array(
        "but_tareas" => "Tareas", 
        "but_calif" => "Calificaciones", 
        "but_faltas" => "Asistencias");
    } else if($_SESSION['qlen'] == "en"){
        $texts = array(
        "but_tareas" => "Homeworks", 
        "but_calif" => "Grades", 
        "but_faltas" => "Assistances");
    } else if($_SESSION['qlen'] == "fr"){
        $texts = array(
        "but_tareas" => "Homeworks", 
        "but_calif" => "Grades", 
        "but_faltas" => "Assistances");
    }

$sql = "SELECT users.nombre, users.apellidos, map_grupos.idUsers 
FROM users, map_grupos 
WHERE map_grupos.idGrupos = '".$_GET['qgrupo']."' 
AND users.idUsers = map_grupos.idUsers 
AND users.codeEscuelas = '".$_SESSION['qescuelacode']."' 
AND users.tipo = '2' 
GROUP BY users.nombre";

//echo $sql;

$result = $con->query($sql);

$output['aaData'] = array();
    
while ($row = $result->fetch_assoc()) { 

    $chido = array();

    $chido[] = $row['idUsers'];
    $chido[] = $row['nombre'];
    $chido[] = $row['apellidos'];
    $chido[] = '<a href="#" onclick="assignme(\'admin_homework.php?qestudiante='.$row['idUsers'].'\',\'content\'); return false;" class="buttonM bGreen"><span class="icon-bars"></span><span>'.$texts['but_tareas'].'</span></a>
    			<a href="#" onclick="assignme(\'admin_grades.php?qestudiante='.$row['idUsers'].'\',\'content\'); return false;" class="buttonM bGreen"><span class="icon-thumbs-up-2"></span><span>'.$texts['but_calif'].'</span></a>
    			<a href="#" onclick="assignme(\'admin_faltas.php?qestudiante='.$row['idUsers'].'\',\'content\'); return false;" class="buttonM bGreen"><span class="icon-cog"></span><span>'.$texts['but_faltas'].'</span></a>';
    $output['aaData'][] = $chido;
}

echo json_encode( $output );
    

?>