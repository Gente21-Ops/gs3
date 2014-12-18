<?php
//echo "SE<br>";
include("../logon.php");
require_once('../mysqlcon.php');


error_reporting(E_ALL);
ini_set('display_errors', '1');

//DICCIONARIO el diccionario de los botones va aquí (since I can't access the dict from here)
    if($_SESSION['qlen'] == "es"){
    $texts = array(
        "asistencias" => "Asistencias",
        "tareas" => "Tareas de ", 
        "calif" => "Calificaciones");
    } else if($_SESSION['qlen'] == "en"){
        $texts = array(
        "asistencias" => "Attendance",
        "tareas" => "Group's assigments",
        "calif" => "Grades");
    } else if($_SESSION['qlen'] == "fr"){
        $texts = array(
        "asistencias" => "Asistencias",
        "tareas" => "Aller &agrave; l'activit&eacute;",
        "calif" => "Grades", 
        "alumnos" => "T&eacute;l&eacute;charger");
    }

    
    //these array of columns is the order in which they wil appear on the table
    $aColumns = array('qidgrupos','qgruposnombre','qmateriasnombre','qidmaterias','qidmaterias');
    
    //primero obtengo las matarias a las que estoy suscrito
    $elsql = "SELECT 
                materias.nombre AS qnommateria, 
                map_materias.idMaterias AS qidmat 
                FROM materias, map_materias 
                WHERE map_materias.idUsers = '".$_SESSION['idUsers']."' 
                AND materias.idMaterias = map_materias.idMaterias 
                ORDER BY materias.nombre ASC";

    //echo $elsql;
    $sqlt = $con->query($elsql); 
   
    while ($aRow = $sqlt->fetch_assoc()) {
        //now let's the goddamded group name and id
        $sql2 = "SELECT grupos.idGrupos AS qidgrupo, grupos.nombre AS qnombre, grupos_mapeo_materias.idGrupos_mapeo_materias 
            FROM grupos, grupos_mapeo_materias 
            WHERE grupos_mapeo_materias.idGrupos = grupos.idGrupos
            AND grupos_mapeo_materias.idMaterias = '".$aRow['qidmat']."'";
            //echo $sql2."<br>";
            $sqlt2 = $con->query($sql2); 
            $chido = array();
   
            while ($bRow = $sqlt2->fetch_assoc()) {
                

                $chido[] = $bRow['qidgrupo'];
                $chido[] = $aRow['qnommateria'];
                $chido[] = $bRow['qnombre'];  
                $chido[] = '<a href="#" onclick="assignme(\'professor_takelist.php?qcode='.$bRow['qidgrupo'].'&qmat='.$aRow['qidmat'].'\',\'content\'); return false;" class="buttonM bGreyish">
                            <span class="icon-thumbs-up-2"></span><span>'.$texts['asistencias'].' '.$bRow['qnombre'].'</span></a>
                                
                            <a href="#" onclick="assignme(\'professor_homework.php?qcode='.$bRow['qidgrupo'].'&qmat='.$aRow['qidmat'].'\',\'content\'); return false;" class="buttonM bGreyish">
                            <span class="icon-cog"></span><span>'.$texts['tareas'].' '.$bRow['qnombre'].'</span></a>
                                
                            <a href="#" onclick="assignme(\'professor_takegrades.php?qcode='.$bRow['qidgrupo'].'&qmat='.$aRow['qidmat'].'\',\'content\'); return false;" class="buttonM bGreyish">
                            <span class="icon-user"></span><span>'.$texts['calif'].' '.$bRow['qnombre'].'</span></a>
                            ';

                $output['aaData'][] = $chido;
            }

    }
    
    print json_encode($output);
    

?>