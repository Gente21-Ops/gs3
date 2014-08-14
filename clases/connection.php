<?php
$con = mysql_connect("localhost","root","");
if (!$con){
	die('Could not connect: ' . mysql_error());
}
mysql_select_db("gs3", $con);
mysql_set_charset('utf8',$con);
?>