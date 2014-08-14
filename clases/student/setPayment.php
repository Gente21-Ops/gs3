<?php

    include("../logon.php");

    require_once('../../clases/mysqlcon.php');
    $sqlt = "UPDATE pagos set pagado = '1', receipt = '".$_POST['image']."' WHERE token = '".$_POST['token']."' AND code = '".$_SESSION['code']."'"; 
    
    if (!$con->query($sqlt)){
        echo "0:".$sqlt;
    } else {
        echo "1";
    }

?>