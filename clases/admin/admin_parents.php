<?php

//include("../logon.php");
require_once('../mysqlcon.php');
//este es un hack relativo a windows:
//require_once('general/number_format.php');


    
    //these array of columns is the order in which they wil appear on the table
    //$aColumns = array('idUsers','apellidos','nombre','telefono','e_mail','direccion');
    
    /*$elsql = "SELECT users.idUsers, users.nombre, users.apellidos, users.direccion, users.telefono, users.e_mail 
    FROM users, map_familiares
    WHERE users.idUsers = map_familiares.idFamiliar 
    AND map_familiares.idEstudiante = '".$_GET['qestudiante']."'";*/

    $elsql = "SELECT users.idUsers, users.nombre, users.apellidos 
    FROM users, map_familiares
    WHERE users.idUsers = map_familiares.idFamiliar 
    AND map_familiares.idEstudiante = '".$_GET['qestudiante']."'";

    //echo $elsql;
    $sqlt = $con->query($elsql); 

    $output['aaData'] = array();
   
    while ($row = $sqlt->fetch_assoc()) {

        $chido = array();

        $chido[] = $row['idUsers'];
        $chido[] = $row['apellidos'];
        $chido[] = $row['nombre'];

        $chido[] = '<a href="#" onclick="" class="buttonM bGreen">
                    <span class="icon-inbox"></span><span>Enviar correo</span></a>';
        $chido[] = '<a href="#" onclick="assignme(\'admin_parent_config.php?qfamiliar='.$row['idUsers'].'\',\'content\'); return false;" class="buttonM bGold">
                    <span class="icon-cog"></span><span>Datos personales</span></a>';
    
        $output['aaData'][] = $chido;
    }

    print json_encode($output);
    

?>