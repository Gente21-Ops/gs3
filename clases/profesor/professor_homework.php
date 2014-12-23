<?php
//echo "SE<br>";
include("../logon.php");
require_once('../mysqlcon.php');

error_reporting(E_ALL);
ini_set('display_errors', '1');

//DICCIONARIO
if($_SESSION['qlen'] == "es"){
$texts = array(
    "edit" => "Editar",
    "view" => "Revisar"
    );
} else if($_SESSION['qlen'] == "en"){
    $texts = array(
    "edit" => "Edit",
    "view" => "Review"
    );
}

$elsql = "SELECT idTareas, code, nombre, descripcion, fecha, fechaEntrega
            FROM tareas 
            WHERE idProfesor = '".$_SESSION['idUsers']."' AND idGrupos = '".$_GET['qgroupid']."'";

//echo $elsql;
$sqlt = $con->query($elsql);   

if($sqlt->num_rows === 0){
    
    $chido = array();
    echo json_encode( $chido );

} else {       
    while ($aRow = $sqlt->fetch_assoc()) {
        $chido = array();
        $chido[] = $aRow['idTareas'];
        $chido[] = $aRow['code'];
        $chido[] = $aRow['nombre'];
        $chido[] = $aRow['descripcion'];
        $chido[] = $aRow['fechaEntrega'];
        $chido[] = '<a href="#" onclick="assignme(\'profesor_homework_do?qid='.$aRow['idTareas'].'\',\'content\'); return false;" class="buttonM bBlue"><span>'.$texts['edit'].'</span></a>';  
        $chido[] = '<a href="#" onclick="assignme(\'profesor_homework_review.php?qid='.$aRow['idTareas'].'\',\'content\'); return false;" class="buttonM bGreen"></span><span>'.$texts['view'].'</span></a>';   
        $output['aaData'][] = $chido;
    }
    
    print json_encode($output);
}

?>