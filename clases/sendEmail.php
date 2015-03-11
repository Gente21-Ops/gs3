<?php

include("logon.php");
require_once('mysqlcon.php');

    //extra security layer!!!
    //we make sure that it's not an student who does the change
    //if ($_SESSION['tipo'] != '2'){

        //date_default_timezone_set($_SESSION['qtimezone']);
        //$eltime = $_POST['qdate'].' '.gmdate('H:i:s');
        
        /*if($_POST['qasistio'] == strval('true')){
            $sql = "UPDATE tareas_status SET status = 2 WHERE idTareas_status = ".$_POST['qiduser'];
        } else {
            $sql = "UPDATE tareas_status SET status = 3 WHERE idTareas_status = ".$_POST['qiduser'];
        }*/
    if (strlen($_POST['nombre']) > 3){

        $message = "Mensaje de: ".$_POST['remitente']."\r\n";
        $message = "Asunto: ".$_POST['asunto']."\r\n\r\n";
        $message .= "Comentarios: ".$_POST['mensaje']."\r\n";


        if(!mail($_POST['emailRemitente'],"Copia del mensaje: ".$_POST['asunto'], $message, "MIME-Version: 1.0\r\nContent-Type: text/plain; charset=utf-8\r\nContent-Transfer-Encoding: quoted-printable\r\nContent-Disposition: inline\r\nReply-To: ".$_POST['emailRemitente']."\r\nBcc:".$_POST['emailRemitente']."")){
            echo "error26";
        }
        if(!mail($_POST['email'],$_POST['asunto'], "\r\nGracias por contactarnos. En breve nos comunicaremos\r\n\r\n".$message."\r\n\r\n\r\nGOSCHOOL.MX ", "From: \"".$_POST['emailRemitente']." \" <".$_POST['emailRemitente']."> \r\nMIME-Version: 1.0\r\nContent-Type: text/plain; charset=utf-8\r\nContent-Transfer-Encoding: quoted-printable\r\nContent-Disposition: inline\r\n\r\n")){
            echo "error29";
        }

        echo "1";

        
    } else {
        //if a student just fails silently
        echo "0";
    }    





?>