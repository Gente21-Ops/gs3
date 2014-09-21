<?php

    include("../logon.php");

    require_once('../../clases/mysqlcon.php');

    $sqlt = "UPDATE files SET public = '".$_POST['yesno']."' WHERE patho = '".$_POST['qpatho']."'"; 

    //echo $sqlt;
    
    if (!$con->query($sqlt)){
        echo "0:".$sqlt;
    } else {
        echo "1";
    }

?>