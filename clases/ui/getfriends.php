<?php
	include("../logon.php");
    require_once('../connection.php');
    session_start();
    echo json_decode($_SESSION['qfriends'], true);
?>