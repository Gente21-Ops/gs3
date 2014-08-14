<?php
include("logon.php");
include('../dict/general_calendar.php');

    ob_start();
    require_once('connection.php');
    mysql_query('SET CHARACTER SET utf8');
    mysql_query('SET NAMES "utf8"');
    
    //TOP (Nombre^URL^|Nombre^URL)
    $breads = $texts['title'].'^general_calendar^general/general_calendar';
    include('top.php');
?>  
    
    <!-- Main content -->
    <div class="wrapper">

    
        <!-- 6 + 6 -->
        <div class="fluid">
        
            <!-- Calendar -->
            <div class="widget grid12">
                <div class="whead"><h6><?php echo $texts['title']; ?></h6><div class="clear"></div></div>
                <div id="calendar"></div>
            </div>
            <div class="clear"></div>

        </div>
        
        
    </div>
    <!-- Main content ends -->