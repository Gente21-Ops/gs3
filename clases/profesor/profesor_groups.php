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
        "calif" => "Calificaciones",
        "alumnos" => "Lista");
    } else if($_SESSION['qlen'] == "en"){
        $texts = array(
        "asistencias" => "Attendance",
        "tareas" => "Group's assigments",
        "calif" => "Grades", 
        "alumnos" => "Student's list");
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
            $chido = [];
   
            while ($bRow = $sqlt2->fetch_assoc()) {
                
                $chido[] = $bRow['qidgrupo'];
                $chido[] = $aRow['qnommateria'];
                $chido[] = $bRow['qnombre'];  
                $chido[] = '<ul class="tbar">
                                <li>
                                    <a href="#" onclick="assignme(\'professor_takelist.php?qcode='.$bRow['qidgrupo'].'&qmat='.$aRow['qidmat'].'\',\'content\'); return false;" title=""><span class="icos-pencil"></span>'.$texts['asistencias'].' '.$bRow['qnombre'].'</a>
                                </li>
                                <li>
                                    <a href="#" onclick="assignme(\'professor_takelist.php?qcode='.$bRow['qidgrupo'].'&qmat='.$aRow['qidmat'].'\',\'content\'); return false;" title=""><span class="icos-copypaste"></span>'.$texts['tareas'].' '.$bRow['qnombre'].'</a>
                                </li>
                                <li>
                                    <a href="#" onclick="assignme(\'professor_takelist.php?qcode='.$bRow['qidgrupo'].'&qmat='.$aRow['qidmat'].'\',\'content\'); return false;" title=""><span class="icos-users"></span>'.$texts['alumnos'].' '.$bRow['qnombre'].'</a>
                                </li>
                                <li>
                                    <a href="#" onclick="assignme(\'professor_takelist.php?qcode='.$bRow['qidgrupo'].'&qmat='.$aRow['qidmat'].'\',\'content\'); return false;" title=""><span class="icos-stats"></span>'.$texts['calif'].' '.$bRow['qnombre'].'</a>
                                </li>
                            </ul>';

                $output['aaData'][] = $chido;
            }

    }
    
    print json_encode($output);
    

?>