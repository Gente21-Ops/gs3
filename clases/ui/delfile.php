<?php

	error_reporting(E_ALL); 
	ini_set( 'display_errors','1');

	include("../logon.php");
    require_once('../connection.php');
    
    $file = $_SESSION['qescuelacode'].'/'.$_POST['qfile'];
    /*echo $file;*/
    
    if ( !unlink($file) ){
		echo 'Coulndt delete: '.$file);
    } else {
    	echo '1';
    } 


?>