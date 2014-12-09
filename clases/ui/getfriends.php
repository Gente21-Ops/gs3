<?php
	include("../logon.php");
    require_once('../connection.php');
    session_start();
    //json_decode doesn't work well when we set a user as invisible or blocked (chat_deleteu.php)
    //So in this instance we are using trim instead
	$se = trim(stripslashes($_SESSION['qfriends']), '"');
	echo $se;

?>