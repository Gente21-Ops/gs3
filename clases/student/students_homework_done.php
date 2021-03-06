<?php

include("../logon.php");
require_once('../mysqlcon.php');

    //these array of columns is the order in which they wil appear on the table
    $aColumns = array('idTareas','nombre','fecha','fechaEntrega','qmatname','qgrade');
    
    //este query obtiene el nombre de otra columna (materias) dado el id (JOIN)
    //elegimos las tareas status 1 & 3
    //aquí hay dos variables, el id del grupo (que identifica a la escuela) y
    //el id del alumno

    //VARS
    $qgrupo = $_SESSION['qidgrupo'];
    $qalumno = $_SESSION['idUsers'];

    //DICCIONARIO el diccionario de los botones va aquí (since I can't access the dict from here)
    if($_SESSION['qlen'] == "es"){
    $texts = array(
        "donow" => "Hacer ahora", 
        "edit" => "Editar tarea", 
        "review" => "Se solicit&oacute; revisi&oacute;n",
        "notgraded" => "NO SE HA CALIFICADO");
    } else if($_SESSION['qlen'] == "en"){
        $texts = array(
        "donow" => "Do now !", 
        "edit" => "Edit homework", 
        "review" => "Revision requested",
        "notgraded" => "NOT GRADED YET");
    } else if($_SESSION['qlen'] == "fr"){
        $texts = array(
        "donow" => "Faire maintenant", 
        "edit" => "Modifier la t&acirc;che", 
        "review" => "Faites une revisi&oacute;n S.V.P.",
        "notgraded" => "PAS ENCORE DE NOTE");
    }

    $elsql = "SELECT tareas.idTareas, 
    tareas.nombre, 
    tareas.fecha, 
    tareas.fechaEntrega, 
    tareas.code AS qcode, 
    tareas_status.status AS qstatus, 
    tareas_status.grade AS qgrade, 
    materias.nombre AS qmatname 
FROM tareas 
INNER JOIN materias ON (materias.idMaterias = tareas.idMaterias) 
INNER JOIN tareas_status ON (tareas_status.code = tareas.code) 
WHERE tareas.idGrupos = '".$qgrupo."' AND (tareas_status.status = '1' OR tareas_status.status = '3' OR tareas_status.status = '2') AND tareas_status.idAlumno = '".$qalumno."' 
ORDER BY qmatname ASC, tareas.fechaEntrega ASC";

    //echo $elsql."<br><br>";
    $sqlt = $con->query($elsql); 
   
    $output['aaData'] = array();
    
if($sqlt->num_rows === 0){
    
    //$chido = array();
    echo json_encode( $output );

} else {   
   //$output['aaData'] = [];
    while ($aRow = $sqlt->fetch_assoc()) {
        $row = array();

        for ( $i=0 ; $i<sizeof($aColumns) ; $i++ ) {

            //html para botones
            if ($i == 5){
                $elcode = $aRow['qcode'];


                if($aRow['qstatus'] == '0'){
                    $row[] = $texts["notgraded"];
                } else if($aRow['qstatus'] == '1'){
                    $row[] = '<a href="#" onclick="assignme(\'students_homework_do.php?qcode='.$elcode.'\',\'content\'); return false;" class="buttonM bGold"><span class="icol-pencil"></span><span>'.$texts['edit'].'</span></a>';
                } else if($aRow['qstatus'] == '2'){
                    $row[] = '<a href="#" onclick="assignme(\'students_homework_do.php?qcode='.$elcode.'\',\'content\'); return false;" class="buttonM bRed"><span class="icol-refresh2"></span><span>'.$texts['review'].'</span></a>';
                } else {
                    $row[] = '<strong>'.$aRow[ $aColumns[$i] ].'</strong>';
                }
            }

            $row[] = $aRow[ $aColumns[$i] ];            
        };

        $output['aaData'][] = $row;
    }

    print json_encode($output);
}
    

?>