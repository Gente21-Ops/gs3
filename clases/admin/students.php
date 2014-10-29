<?php

//include("../logon.php");
require_once('../mysqlcon.php');
//este es un hack relativo a windows:
//require_once('general/number_format.php');

    $elsql = "SELECT idUsers, nombre, apellidos FROM users WHERE tipo = '2'";

    //echo $elsql;
    $sqlt = $con->query($elsql); 


    $output['aaData'] = array();

    while ($row = mysqli_fetch_assoc($sqlt)) {

        $chido = array();

        $chido[] = $row['idUsers'];
        $chido[] = $row['apellidos'];
        $chido[] = $row['nombre'];

        $chido[] = '<a href="#" onclick="assignme(\'admin_parents?qestudiante='.$row['idUsers'].'\',\'content\'); return false;" class="buttonM bGreen">
                    <span class="icon-inbox"></span><span>Enviar correo</span></a>';
        $chido[] = '<a href="#" onclick="assignme(\'admin_parents?qestudiante='.$row['idUsers'].'\',\'content\'); return false;" class="buttonM bLightBlue">
                    <span class="icon-user"></span><span>Familiares</span></a>';
        $chido[] = '<a href="#" onclick="assignme(\'admin_students_config?qestudiante='.$row['idUsers'].'\',\'content\'); return false;" class="buttonM bGold">
                    <span class="icon-cog"></span><span>Datos personales</span></a>';
        
        $output['aaData'][] = $chido;
        
    }

    $sqlt->free();

    print json_encode($output);

    $con->close();
    

?>