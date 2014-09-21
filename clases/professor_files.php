<?php
error_reporting(E_ALL);
include("logon.php");
include('../dict/students_files.php');

    ob_start();

    //TOP
    $breads = $texts['title'].'^admin_students_a';
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

                
                <ul class="tToolbar">
                    <!-- POR AHORA NO HAY CAPACIDAD PARA AGREGAR ARCHIVO DESDE AQUI
                    <li id="btnAddNewRow"><a href="#" title=""><span class="icos-archive"></span><?php echo $texts['agregar_nuevo']; ?></a></li>-->
                    <li id="btnDeleteRow"><a href="#" title=""><span class="icos-cross"></span><?php echo $texts['borrar_existente']; ?></a></li>
                </ul>
                

                <div id="dyn2" class="shownpars">

                    <a class="tOptions act" title="Options"><img src="images/icons/options" alt="" /></a>
                    <table cellpadding="0" cellspacing="0" border="0" class="dTable" id="dTable">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th><?php echo $texts['col_nombre']; ?></th>                        
                        <th><?php echo $texts['col_actividad']; ?></th>
                        <th><?php echo $texts['col_ira']; ?></th>
                        <th><?php echo $texts['col_ver']; ?></th>
                        <th><?php echo $texts['col_publico']; ?></th>
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

