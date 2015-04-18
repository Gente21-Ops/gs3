<?php
error_reporting(E_ALL);
include("logon.php");
include('../dict/admin/parents.php');

    //TOP
    $breads = $texts['title'].'^admin_parents';
    include('top.php');
?>  

<div id="qestudiante" style="display:none;"><?php echo $_GET['qestudiante']; ?></div> 
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


<form id="formAddNewRow" action="#" title="<?php echo $texts['agregar']; ?>">

    <input type="hidden" name="idUsers" id="idUsers" rel="0" />

    <label for="name"><?php echo $texts['col_apellidos']; ?></label><input type="text" name="apellidos" id="apellidos" class="required" rel="1" />
    <br>
    <label for="name"><?php echo $texts['col_user']; ?></label><input type="text" name="nick" id="nick" />
    <br>
    <label for="name"><?php echo $texts['col_pass']; ?></label><input type="text" name="pass" id="pass" />
    <br>
    
    <label for="name"><?php echo $texts['dir_calle']; ?></label><input type="text" name="calle_num" id="calle_num" rel="5" />
    <br>
    <label for="name"><?php echo $texts['dir_colonia']; ?></label><input type="text" name="colonia" id="colonia" rel="5" />
    <br>
    <label for="name"><?php echo $texts['dir_zip']; ?></label><input type="text" name="zip_code" id="zip_code" rel="5" />
    <br>
    <label for="name"><?php echo $texts['dir_municipio']; ?></label><input type="text" name="municipio" id="municipio" rel="5" />
    <br>
    <label for="name"><?php echo $texts['dir_estado']; ?></label><input type="text" name="estado" id="estado" rel="5" />
    <br>

    <label for="name"><?php echo $texts['col_telefono']; ?></label><input type="text" name="telefono" id="telefono" rel="3" />
    <br>
    <label for="name"><?php echo $texts['col_correo']; ?></label><input type="text" name="e_mail" id="e_mail" rel="4" />
</form>

<div id="mod_email" title="Enviar correo" class="dialog" style="display:none">
            <input type="hidden" name="qEmailRemitente" id="qEmailRemitente" value="<?php echo $_SESSION['e_mail']; ?>" rel="0" />

            <label>Remitente:</label>
            <input type="text" id="qRemitente" name="qRemitente" class="clear" value="Administrador: <?php echo $_SESSION['nombre']; ?>"/>

            <label>Destinatario (padre de familia):</label>
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