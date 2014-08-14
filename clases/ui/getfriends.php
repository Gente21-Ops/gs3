<?php
    require_once('../connection.php');
    session_start();

    $namelen = 17;

    $sal = $_SESSION['code']."^";
    foreach ($_SESSION['qfriends'] as $key => $value){
    	if (strlen($value['name']) > $namelen){
    		$name = substr($value['name'], 0, $namelen)."...";
    	} else {
    		$name = $value['name'];
    	};
    	$sal .= $value['id']."|".$name."~";
    }
    $sal = substr($sal, 0, -1);
    $sal .= "^".$_SESSION['qescuelacode'];
    $sal .= "^".$_SESSION['nombre'];
    $sal .= "^".$_SESSION['tipo'];
    echo $sal;
?>