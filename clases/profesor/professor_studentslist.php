<?php
//echo "SE<br>";
include("../logon.php");
require_once('../mysqlcon.php');
//este es un hack relativo a windows:
//require_once('general/number_format.php');
//$code = '36e96b9d7e22904131f30d9857a9a6c1';

//DICCIONARIO el diccionario de los botones va aquí (since I can't access the dict from here)
    if($_SESSION['qlen'] == "es"){
    $texts = array(
        "tareas" => "Tareas del grupo", 
        "alumnos" => "Lista de alumnos");
    } else if($_SESSION['qlen'] == "en"){
        $texts = array(
        "tareas" => "Group's assigments", 
        "alumnos" => "Student's list");
    } else if($_SESSION['qlen'] == "fr"){
        $texts = array(
        "tareas" => "Aller &agrave; l'activit&eacute;", 
        "alumnos" => "T&eacute;l&eacute;charger");
    }

    
    //these array of columns is the order in which they wil appear on the table
    $aColumns = array('qidgrupo','qgruponame','qidgrupo','qidgrupo');
    
    $elsql = "SELECT users.nombre AS qnombre, users.apellidos AS qapellidos, users.codeEscuelas AS qcodeescuelas, grupos.idGrupos AS qidgrupos, grupos_mapeo_materias.idGrupos 
        WHERE qcodeescuelas = '".$_SESSION['qescuelacode']."' 
        AND grupos_mapeo_materias.idGrupos = '".$_GET['qgroupid']."'";

    //echo $elsql;
    $sqlt = $con->query($elsql); 
   
    while ($aRow = $sqlt->fetch_assoc()) {
        $row = array();
        $elid = '0';
        $elpatho = '';
        for ( $i=0 ; $i<sizeof($aColumns) ; $i++ ) {   
            
            //get the id
            if ($i == 0){ $elid = $aRow[ $aColumns[$i] ]; }

            if ($i == 1){
                $row[] = $aRow[ $aColumns[$i] ];
            } else if ($i == 2){
                $row[] = '<a href="#" onclick="assignme(\'profesor_assignments.php?qcode='.$aRow[$aColumns[$i]].'\',\'content\'); return false;" class="buttonM bGreen"><span class="icol-add"></span><span>'.$texts['tareas'].'</span></a>';
            } else if ($i == 3){
                $row[] = '<a href="#" onclick="assignme(\'professor_studentslist.php?qcode='.$aRow[$aColumns[$i]].'\',\'content\'); target="_blank" class="buttonM bGreyish"><span class="icol-add"></span><span>'.$texts['alumnos'].'</span></a>';
            } else {
                $row[] = $aRow[ $aColumns[$i] ];
            }

                        
        };

        $output['aaData'][] = $row;
    }

    print json_encode($output);
    

?>