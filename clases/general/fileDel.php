<?php
include("../logon.php");

//vamos a ver que este nombre de documento y este usario existan
$sql="SELECT code FROM pads WHERE name = '".$_POST['qpadname']."' AND usercode = '".$_SESSION['code']."'";
    
    //echo $sql."<br><br>";

    $result=mysql_query($sql);

    // Mysql_num_row is counting table row
    $count=mysql_num_rows($result);
    $row = mysql_fetch_row($result);

    // If result matched $myusername and $mypassword, table row must be 1 row
    if($count==1){
    	echo $row[0];
    } else {
    	echo '0';
    }
?>