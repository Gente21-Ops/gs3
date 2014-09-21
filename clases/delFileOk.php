<?php
	include("logon.php");

	require_once('mysqlcon.php');
	if(!unlink("../files/".$_SESSION['qescuelacode']."/".$_REQUEST['id'])){
		echo "0:"."../files/".$_SESSION['qescuelacode']."/".$_REQUEST['id'];
		exit();
	} else {
		$elsql = "DELETE FROM files WHERE patho = '".$_REQUEST['id']."'";
		if (!mysqli_query($con, $elsql)){
			echo "0:".$elsql;
			exit();
		}
		echo "ok";
	}
?>