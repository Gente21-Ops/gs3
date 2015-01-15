<?php

	error_reporting(E_ALL); 
	ini_set( 'display_errors','1');

	include("../logon.php");
    require_once('../connection.php');
    
    $file = '../../files/'.$_SESSION['qescuelacode'].'/'.$_POST['qfile'];

    if( !unlink($file) ){
	    echo '0';
	} else { 
	    echo '1';
	} 


?>