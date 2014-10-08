<?php

//include("../logon.php");
require_once('../mysqlcon.php');
//este es un hack relativo a windows:
//require_once('general/number_format.php');

    $elsql = "SELECT idUsers, nombre, apellidos, direccion, telefono, e_mail, nacimiento, code FROM users WHERE tipo = '2'";

    //echo $elsql;
    $sqlt = $con->query($elsql); 

    //var para agarra el id
    $elid = 0;
    $elcode = '0';
    
    while ($row = $sqlt->fetch_assoc()) {


        $chido = [];

        $chido[] = $row['idUsers'];
        $chido[] = $row['apellidos'];
        $chido[] = $row['nombre'];

        $chido[] = '<a href="#" onclick="assignme(\'admin_parents?qestudiante='.$row['idUsers'].'\',\'content\'); return false;" class="buttonM bGreen">
                    <span class="icon-inbox"></span><span>Enviar correo</span></a>';
        $chido[] = '<a href="#" onclick="assignme(\'admin_parents?qestudiante='.$row['idUsers'].'\',\'content\'); return false;" class="buttonM bLightBlue">
                    <span class="icon-user"></span><span>Familiares</span></a>';
        $chido[] = '<a href="#" onclick="assignme(\'admin_students_config?qestudiante='.$row['idUsers'].'\',\'content\'); return false;" class="buttonM bGold">
                    <span class="icon-bars"></span><span>Datos</span></a>';
        
        $output['aaData'][] = $chido;
    }

    print json_encode($output);
    

?>