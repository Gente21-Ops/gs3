<?php
error_reporting(E_ALL);
include("logon.php");
include('../dict/students.php');

    ob_start();

    //TOP
    $breads = $texts['title'].'^admin_students_a';
    include('top.php');
?>  

<div id="deldialog" style="display:none;"><strong><?php echo $texts['deldialog']; ?></strong></div>
<div id="deltitle" style="display:none;"><?php echo $texts['deltitle']; ?></div>
<div id="qlango" style="display:none;"><?php echo $_SESSION['qlen']; ?></div>
<div id="mailSent" style="display:none;"><?php echo $texts['mailSent']; ?></div>
<div id="mailNotSent" style="display:none;"><?php echo $texts['mailNotSent']; ?></div>
    
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
                        <th><?php echo $texts['col_env_correo']; ?></th>
                        <th><?php echo $texts['col_fam']; ?></th>
                        <th><?php echo $texts['col_datos']; ?></th>
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

</form> 

<div id="mod_email" title="Enviar correo" class="dialog" style="display:none">
            <input type="hidden" name="qEmailRemitente" id="qEmailRemitente" value="<?php echo $_SESSION['e_mail']; ?>" rel="0" />

            <label>Remitente:</label>
            <input type="text" id="qRemitente" name="qRemitente" class="clear" value="Administrador: <?php echo $_SESSION['nombre']; ?>"/>

            <label>Destinatario (alumno):</label>
            <input type="text" id="qNombre" name="qNombre" class="clear" disabled/>

            <label>Email del alumno:</label>
            <input type="text" id="qEmail" name="qEmail" class="clear" disabled/>

            <div class="divider"><span></span></div>

            <label>Asunto del mensaje:</label>
            <input type="text" id="qAsunto" name="qAsunto" class="clear"/>

            <label>Contenido del mensaje:</label>
            <textarea cols="40" rows="5" name="qMensaje" id="qMensaje"></textarea>

            <span class="clear"></span>
</div>