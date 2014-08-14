<?php
error_reporting(E_ALL);
include("logon.php");
include('../dict/profesor_grupos.php');

    ob_start();

    //TOP
    $breads = $texts['title'].'^profesor_grupos';
    include('top.php');
?>  

<div id="deldialog" style="display:none;"><strong><?php echo $texts['deldialog']; ?></strong></div>
<div id="deltitle" style="display:none;"><?php echo $texts['deltitle']; ?></div>
<div id="qlango" style="display:none;"><?php echo $_SESSION['qlen']; ?></div>
    
    <!-- Main content -->
    <div class="wrapper">
    
        <!-- 6 + 6 -->
        <div class="fluid">        
            
            <!-- Table with opened toolbar -->
            <div class="widget">
                <div class="whead"><h6><?php echo $texts['tabletitle']; ?></h6><div class="clear"></div></div>                

                <div id="dyn2" class="shownpars">

                    <a class="tOptions act" title="Options"><img src="images/icons/options" alt="" /></a>
                    <table cellpadding="0" cellspacing="0" border="0" class="dTable" id="dTable">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th><?php echo $texts['col_matnom']; ?></th>
                        <th><?php echo $texts['col_nombre']; ?></th>
                        <th><?php echo $texts['col_actions']; ?></th>
                        <!--
                        <th><?php echo $texts['col_tareas']; ?></th>
                        <th><?php echo $texts['col_lista']; ?></th>
                        <th><?php echo $texts['col_alumnos']; ?></th>
                        -->
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    </table> 
                </div>
                <div class="clear"></div> 
            </div> 


        </div>
        
        
    </div>
    <!-- Main content ends -->

<!-- Content ends -->

