<?php

//include("../logon.php");
require_once('../mysqlcon.php');
//este es un hack relativo a windows:
//require_once('general/number_format.php');


    
    //these array of columns is the order in which they wil appear on the table
    $aColumns = array('idUsers','apellidos','nombre','telefono','e_mail','direccion');
    
    $elsql = "SELECT idUsers, nombre, apellidos FROM users WHERE tipo = '3'";

    //echo $elsql;
    $sqlt = $con->query($elsql); 

    $output['aaData'] = array();
   
    while ($row = $sqlt->fetch_assoc()) {


        $chido = array();

        $chido[] = $row['idUsers'];
        $chido[] = $row['apellidos'];
        $chido[] = $row['nombre'];

        $chido[] = '<a href="#" onclick="assignme(\'admin_parents?qmaestro='.$row['idUsers'].'\',\'content\'); return false;" class="buttonM bGreen">
                    <span class="icon-inbox"></span><span>Enviar correo</span></a>';
        $chido[] = '<a href="#" onclick="assignme(\'admin_admin_config?qmaestro='.$row['idUsers'].'\',\'content\'); return false;" class="buttonM bGold">
                    <span class="icon-cog"></span><span>Datos personales</span></a>';
    
        $output['aaData'][] = $chido;
    }

    print json_encode($output);
    

?>