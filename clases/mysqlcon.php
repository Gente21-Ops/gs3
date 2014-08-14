<?php

$con = new mysqli('localhost', 'root', '', 'gs3');
if (!$con){
	die('Could not connect: ' . mysql_error());
}

if (mysqli_connect_errno()) {
    printf("0ˆ", mysqli_connect_error());
    exit();
}

mysqli_set_charset($con,"utf8");

?>