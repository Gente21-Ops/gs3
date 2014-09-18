<?php
//echo "SE<br>";
include("../logon.php");
require_once('../mysqlcon.php');

error_reporting(E_ALL);
ini_set('display_errors', '1');

$sql = "SELECT users.nombre, users.apellidos, map_grupos.idUsers 
FROM users, map_grupos 
WHERE map_grupos.idGrupos = '".$_GET['qgrupo']."' 
AND users.idUsers = map_grupos.idUsers 
AND users.codeEscuelas = '".$_SESSION['qescuelacode']."' 
AND users.tipo = '2' 
GROUP BY users.nombre";

//echo $sql;

$result = $con->query($sql);

$output['aaData'] = [];
    
while ($row = $result->fetch_assoc()) { 

    $chido = [];

    $chido[] = $row['idUsers'];
    $chido[] = $row['nombre'];
    $chido[] = $row['apellidos'];
    $chido[] = '<a href="#" class="buttonM bGreen"><span class="icon-thumbs-up-2"></span><span>Calificaciones</span></a>
    		<a href="#" class="buttonM bGreen"><span class="icon-thumbs-up-2"></span><span>Calificaciones</span></a>';
    		
    $output['aaData'][] = $chido;
}

echo json_encode( $output );
    

?>