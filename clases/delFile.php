<?php
	include("logon.php");

	require_once('mysqlcon.php');
	if(!unlink("../files/".$_SESSION['qescuelacode']."/".$_POST['qdelfile'])){
		echo "0:"."../files/".$_SESSION['qescuelacode']."/".$_POST['qdelfile'];
		exit();
	} else {
		$elsql = "DELETE FROM files WHERE patho = '".$_POST['qdelfile']."'";
		if (!mysqli_query($con, $elsql)){
			echo "0:".$elsql;
			exit();
		}
		echo "1";
	}
?>