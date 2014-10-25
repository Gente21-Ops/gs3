<?php
error_reporting(E_ALL); 
ini_set( 'display_errors','1');

include("logon.php");
include('../dict/students_homework.php');



    ob_start();
    require_once('connection.php');
    mysql_query('SET CHARACTER SET utf8');
    mysql_query('SET NAMES "utf8"');


    //TOP
    $breads = $texts['title'].'^students_homework';
    include('top.php');
?>  

<div id="deldialog" style="display:none;"><strong><?php echo $texts['deldialog']; ?></strong></div>
<div id="deltitle" style="display:none;"><?php echo $texts['deltitle']; ?></div>
<div id="qlango" style="display:none;"><?php echo $_SESSION['qlen']; ?></div>
<div id="qlango" style="display:none;"><?php echo $_SESSION['qlen']; ?></div>
    
    <!-- Main content -->
    <div class="wrapper">
    
        <!-- 6 + 6 -->
        <div class="fluid">        
            
            <!-- Table with opened toolbar -->
            <div class="widget">
                <div class="whead"><h6><?php echo $texts['tabletitle']; ?></h6><div class="clear"></div></div>

                <div id="dyn2" class="shownpars">

                    <table cellpadding="0" cellspacing="0" border="0" class="dTable" id="dTable">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th><?php echo $texts['col_titulo']; ?></th>
                        <th><?php echo $texts['col_fecha']; ?></th>
                        <th><?php echo $texts['col_fechaentrega']; ?></th>
                        <th><?php echo $texts['col_materia']; ?></th>
                        <th><?php echo $texts['col_correo']; ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    </table> 
                </div>
                <div class="clear"></div> 
            </div> 



            <!-- Table with opened toolbar -->
            <div class="widget">
                <div class="whead"><h6><?php echo $texts['tabletitle_done']; ?></h6><div class="clear"></div></div>

                <div id="dyn2" class="shownpars">

                    <table cellpadding="0" cellspacing="0" border="0" class="dTable" id="dTable_done">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th><?php echo $texts['col_titulo']; ?></th>
                        <th><?php echo $texts['col_fecha']; ?></th>
                        <th><?php echo $texts['col_fechaentrega']; ?></th>
                        <th><?php echo $texts['col_materia']; ?></th>
                        <th><?php echo $texts['col_grade']; ?></th>
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

<!-- Content ends


<form id="formAddNewRow" action="#" title="<?php echo $texts['agregar']; ?>">

    <input type="hidden" name="idStudents" id="idStudents" rel="0" />

    <div class="formRow fluid">
        <div class="grid7"><input type="text"  name="apellidos" id="apellidos" class="required" rel="1" placeholder="<?php echo $texts['f_apellidos']; ?>" /></div>
        <div class="grid5"><input type="text" name="nombre" id="nombre" class="required" rel="2" placeholder="<?php echo $texts['f_nombre']; ?>" /></div>
    </div>

    <div class="formRow fluid">        
        <div class="grid12"><input type="text" name="pass" id="pass" class="required" placeholder="<?php echo $texts['f_contrasena']; ?>" /></div>
    </div>

    <div class="formRow fluid">        
        <div class="grid12"><input type="text" name="direccion" class="required" id="direccion" rel="5" placeholder="<?php echo $texts['f_direccion']; ?>" /></div>
    </div>

    <div class="formRow fluid">
        <div class="grid5"><input type="text" name="telefono" id="telefono" rel="3" placeholder="<?php echo $texts['f_telefono']; ?>"  class="maskPhone required" /></div>
        <div class="grid7"><input type="text" name="e_mail" id="e_mail" rel="4" class="required" placeholder="<?php echo $texts['f_email']; ?>" /></div>
    </div>

</form>  -->