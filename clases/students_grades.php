<?php
error_reporting(E_ALL);
include("logon.php");
include('../dict/students_grades.php');

    ob_start();

    //TOP
    $breads = $texts['title'].'^students_grades';
    include('top.php');
?>




<div id="deldialog" style="display:none;"><strong><?php echo $texts['deldialog']; ?></strong></div>
<div id="deltitle" style="display:none;"><?php echo $texts['deltitle']; ?></div>
<div id="qlango" style="display:none;"><?php echo $_SESSION['qlen']; ?></div>
    
    <!-- Main content -->
    <div class="wrapper">
    
        <!-- 6 + 6 -->
        <div class="fluid">        
            
            <!-- Bars chart -->
            <div class="widget grid12 chartWrapper">
                <div class="whead"><h6><?php echo $texts['table_grades']; ?></h6><div class="clear"></div></div>
                <div class="body"><div class="bars" id="placeholder"></div></div>
            </div>

        </div>
        
        
    </div>
    <!-- Main content ends -->

<!-- Content ends -->

