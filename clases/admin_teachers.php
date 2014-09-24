<?php
error_reporting(E_ALL);
include("logon.php");
include('../dict/admin/teachers.php');

    ob_start();

    //TOP
    $breads = $texts['title'].'^admin_teachers';
    include('top.php');
?>  
    
<!-- Main content -->
<div class="wrapper">


    <!-- 6 + 6 -->
    <div class="fluid">
    
        
        <!-- Table with opened toolbar -->
        <div class="widget">
            <div class="whead"><h6><?php echo $texts['tabletitle']; ?></h6><div class="clear"></div></div>

            <ul class="tToolbar">
                <li id="btnAddNewRow"><a href="#" title=""><span class="icos-archive"></span><?php echo $texts['agregar_nuevo']; ?></a></li>
                <li id="btnDeleteRow"><a href="#" title=""><span class="icos-cross"></span><?php echo $texts['borrar_existente']; ?></a></li>
            </ul>

            <div id="dyn2" class="shownpars">

                <a class="tOptions act" title="Options"><img src="images/icons/options" alt="" /></a>
                <table cellpadding="0" cellspacing="0" border="0" class="dTable" id="dTable">
                <thead>
                <tr>
                    <th>ID</th>
                    <th><?php echo $texts['col_apellidos']; ?></th>
                    <th><?php echo $texts['col_nombre']; ?></th>
                    <th><?php echo $texts['col_dir']; ?></th>
                    <th><?php echo $texts['col_telefono']; ?></th>
                    <th><?php echo $texts['col_correo']; ?></th>
                    <th><?php echo $texts['col_but']; ?></th>
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
    

<form id="formAddNewRow" action="#" title="<?php echo $texts['agregar']; ?>">

        <input type="hidden" name="idStudents" id="idStudents" rel="0" />

        <label for="name"><?php echo $texts['col_apellidos']; ?></label><input type="text" name="apellidos" id="apellidos" class="required" rel="1" />
        <br>
        <label for="name"><?php echo $texts['col_nombre']; ?></label><input type="text" name="nombre" id="nombre" rel="2" />
        <br>
        <label for="name">Contraseña</label><input type="text" name="pass" id="pass" />
        <br>
        <label for="name"><?php echo $texts['col_dir']; ?></label><input type="text" name="direccion" id="direccion" rel="5" />
        <br>
        <label for="name"><?php echo $texts['col_telefono']; ?></label><input type="text" name="telefono" id="telefono" rel="3" />
        <br>
        <label for="name"><?php echo $texts['col_correo']; ?></label><input type="text" name="e_mail" id="e_mail" rel="4" />
</form>
