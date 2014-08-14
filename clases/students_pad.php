<?php
error_reporting(E_ALL);
include("logon.php");
include('../dict/students_homework.php');

    ob_start();
    require_once('connection.php');
    mysql_query('SET CHARACTER SET utf8');
    mysql_query('SET NAMES "utf8"');

    //TOP
    $breads = $texts['title'].'^students_pad';
    include('top.php'); 
?>  

<!--<div id="deldialog" style="display:none;"><strong><?php echo $texts['deldialog']; ?></strong></div>-->

    
    <!-- Main content -->
    <div class="wrapper" style="margin:0; height:1000px;">
        <iframe id="iframe" style="height: 100%; width: 100%; display: block; overflow:hidden;" src="http://107.22.250.130:9001/p/<?php echo $_GET['qcode']; ?>">
        
    </div>
    <!-- Main content ends -->



