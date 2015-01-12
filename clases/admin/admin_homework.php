<?php

include("../logon.php");
require_once('../mysqlcon.php');

    //these array of columns is the order in which they wil appear on the table
    //$aColumns = array('idTareas','nombre','fecha','fechaEntrega','qmatname','qstatus','qcode');
    $aColumns = array('idTareas','nombre','fecha','fechaEntrega','qmatname','qcode');

    
    //este query obtiene el nombre de otra columna (materias) dado el id (JOIN)
    //elegimos las tareas abiertas y con errores (status 0 & 2)
    //aquí hay dos variables, el id del grupo (que identifica a la escuela) y
    //el id del alumno

    //VARS
    /*$qgrupo = $_SESSION['qidgrupo'];    */
    $qalumno = $_GET['qestudiante'];

    $elsql = "SELECT idGrupos FROM map_grupos WHERE idUsers = '".$qalumno."'";

    $sqlt = $con->query($elsql);
    $row2 = $sqlt->fetch_assoc();

    $qgrupo = $row2['idGrupos'];
    //sql5 = "SELECT idEstudiante";

    //DICCIONARIO el diccionario de los botones va aquí (since I can't access the dict from here)
    if($_SESSION['qlen'] == "es"){
    $texts = array(
        "donow" => "Hacer ahora", 
        "review" => "Se solicit&oacute; revisi&oacute;n");
    } else if($_SESSION['qlen'] == "en"){
        $texts = array(
        "donow" => "Do now !", 
        "review" => "Revision requested");
    } else if($_SESSION['qlen'] == "fr"){
        $texts = array(
        "donow" => "Faire maintenant", 
        "review" => "Faites une revisi&oacute;n S.V.P.");
    }

    /*$elsql = "SELECT tareas.idTareas, tareas.code AS qcode, tareas.nombre, tareas.fecha, tareas.fechaEntrega, 
    tareas_status.status AS qstatus, materias.nombre AS qmatname 
FROM tareas 
INNER JOIN materias ON (materias.idMaterias = tareas.idMaterias) 
INNER JOIN tareas_status ON (tareas_status.code = tareas.code) 
WHERE tareas.idGrupos = '".$qgrupo."' AND (tareas_status.status = '0' OR tareas_status.status = '2') AND tareas_status.idAlumno = '".$qalumno."' 
ORDER BY qmatname ASC, tareas.fechaEntrega ASC";*/

$elsql = "SELECT 
    tareas.idTareas, 
    tareas.code AS qcode, 
    tareas.nombre, 
    tareas.fecha, 
    tareas.fechaEntrega, 
    materias.nombre AS qmatname 
    FROM tareas, tareas_status, materias 
    /*INNER JOIN materias ON (materias.idMaterias = tareas.idMaterias) 
    INNER JOIN tareas_status ON (tareas_status.code = tareas.code) */
    WHERE materias.idMaterias = tareas.idMaterias 
    AND tareas.idGrupos = '".$qgrupo."' 
    AND tareas_status.idAlumno = '".$qalumno."' 
    GROUP BY tareas.idTareas 
    ORDER BY qmatname ASC, tareas.fechaEntrega ASC";
    
    //echo $_SESSION['qidgrupo']."<br><br>";
    //echo $elsql;
    $sqlt = $con->query($elsql);

    //var para agarra el id
    $elid = 0;
    $elcode = '0';

$output['aaData'] = array();
    
if($sqlt->num_rows === 0){
    
    //$chido = array();
    echo json_encode( $output );

} else {

    //$output['aaData'] = [];
    while ($aRow = $sqlt->fetch_assoc()) {
        $query = mysqli_query($con, "SELECT code FROM tareas_status WHERE code = '".$aRow['qcode']."'");

        if(mysqli_num_rows($query) < 1){

            $row = array();
            for ( $i=0 ; $i<sizeof($aColumns) ; $i++ ) {

                //html para botones
                if ($i == 5){

                    //calculo el code
                    //$elcode = $aRow[$aColumns[$i + 1]];
                    $elcode = $aRow[$aColumns[$i]];

                    //if($aRow[$aColumns[$i]] == '0'){
                        $row[] = '<a href="#" onclick="assignme(\'students_homework_do.php?qcode='.$elcode.'\',\'content\'); return false;" class="buttonM bGreen"><span class="icon-thumbs-up-2"></span><span>'.$texts['donow'].'</span></a>';
                    /*} else if($aRow[$aColumns[$i]] == '2'){
                        $row[] = '<a href="#" onclick="assignme(\'students_homework_do.php?qcode='.$elcode.'\',\'content\'); return false;" class="buttonM bRed"><span class="icol-refresh2"></span><span>'.$texts['review'].'</span></a>';
                    }*/
                } else {
                    //seteamos el id
                    if ($i == 0){
                        $elid = $aRow[$aColumns[$i]];
                    }
                    //si no pus solo el valor        
                    $row[] = $aRow[ $aColumns[$i] ];
                }
                            
            }
            
            $output['aaData'][] = $row;
        }


        
    }
    print json_encode($output);

}

?>