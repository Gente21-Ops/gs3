<?php
error_reporting(E_ALL);
include("logon.php");
include('../dict/admin/admin_config.php');

    ob_start();
    require_once('connection.php');
    mysql_query('SET CHARACTER SET utf8');
    mysql_query('SET NAMES "utf8"');

    //TOP
    $breads = $texts['title'].'^students_config';
    include('top.php');

    //locales para calendario
    if ($_SESSION['qlen'] == 'es'){
        echo '<script src="http://jquery-ui.googlecode.com/svn/tags/latest/ui/i18n/jquery.ui.datepicker-es.js"></script>';
    } else if ($_SESSION['qlen'] == 'fr'){
        echo '<script src="http://jquery-ui.googlecode.com/svn/tags/latest/ui/i18n/jquery.ui.datepicker-fr.js"></script>';
    } else {
        echo '<script src="http://jquery-ui.googlecode.com/svn/tags/latest/ui/i18n/jquery.ui.datepicker-en-GB.js"></script>';
    }


    $query = "SELECT * FROM users WHERE idUsers = '".$_GET['qmaestro']."'";
    $result = mysql_query($query,$con);
    $row = mysql_fetch_assoc($result);

    $nombre = $row['nombre']." ".$row['apellidos'];
?>  

    <div id="qlang" style="display:none;"><?php echo $_SESSION['qlen']; ?></div>
    <div id="qimgchanged" style="display:none;"><?php echo $texts['imgchanged']; ?></div>
    <div id="qerror" style="display:none;"><?php echo $texts['savederror']; ?></div>
    <div style="display:none;" id="quser"><?php echo $_SESSION['code']; ?></div>
    <div style="display:none;" id="qmaestro"><?php echo $_GET['qmaestro']; ?></div>
    
    <!-- Main content -->
    <div class="wrapper">


        <div class="fluid">
        
            <!-- Bars chart -->
            <div class="widget grid12 chartWrapper">
                <div class="whead"><h6><?php echo $texts['img_but_browse']." ".$nombre; ?></h6><div class="clear"></div></div>
                <div class="body">

                    <!--arreglar este estilo en línea!!!! -->
                    <ul class="middleFree" style="margin-top:10px;">
                        <li><img id="elusero320" src="images/users/320/<?php echo $row['code']; ?>.jpg?ran=<?php echo rand(1, 200); ?>" alt="" class="relative" /></li>
                        <li></li>
                    </ul>
                    

                    <ul id="filelist"></ul>
                    <br>
                    
                    <div id="container">
                        <a href="#" class="buttonM bBlue" id="browser"><span class="icon-camera"></span><span><?php echo $texts['img_but_browse']; ?></span></a>
                    </div>

                    <pre id="console"></pre>

                </div>
            </div>
        
        </div>

    
        <!-- 6 + 6 -->
        <form action="" class="main">
        <input type="hidden" name="code" id="code" value="<?php echo $row['code']; ?>" />

            <fieldset>
                <div class="widget fluid">
                    <div class="whead"><h6><?php echo $texts['tabletitle']." ".$nombre; ?></h6><div class="clear"></div></div>
                    <div class="formRow">
                        <div class="grid3"><label><?php echo $texts['col_apellidos']; ?>:</label></div>
                        <div class="grid9">
                            <span class="grid4"><input type="text" id="name" value="<?php echo $row['nombre']; ?>" /></span>
                            <span class="grid8"><input type="text" id="last" value="<?php echo $row['apellidos']; ?>" /></span>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="formRow">
                        <div class="grid3"><label><?php echo $texts['col_apodo']; ?>:</label></div>
                        <div class="grid9"><input type="text" id="nick" value="<?php echo $row['nick']; ?>" /></div>
                        <div class="clear"></div>
                    </div>

                    <div class="formRow">
                        <div class="grid3"><label><?php echo $texts['col_calle']; ?>:</label></div>
                        <div class="grid9"><input type="text" id="calle_num" value="<?php echo $row['calle_num']; ?>" /></div>
                        <div class="clear"></div>
                    </div>
                    <div class="formRow">
                        <div class="grid3"><label><?php echo $texts['col_colonia']; ?>:</label></div>
                        <div class="grid9"><input type="text" id="colonia" value="<?php echo $row['colonia']; ?>" /></div>
                        <div class="clear"></div>
                    </div>
                    <div class="formRow">
                        <div class="grid3"><label><?php echo $texts['col_zip']; ?>:</label></div>
                        <div class="grid9"><input type="text" id="zip_code" value="<?php echo $row['zip_code']; ?>" /></div>
                        <div class="clear"></div>
                    </div>
                    <div class="formRow">
                        <div class="grid3"><label><?php echo $texts['col_municipio']; ?>:</label></div>
                        <div class="grid9"><input type="text" id="municipio" value="<?php echo $row['municipio']; ?>" /></div>
                        <div class="clear"></div>
                    </div>
                    <div class="formRow">
                        <div class="grid3"><label><?php echo $texts['col_edo']; ?>:</label></div>
                        <div class="grid9"><input type="text" id="estado" value="<?php echo $row['estado']; ?>" /></div>
                        <div class="clear"></div>
                    </div>

                    <div class="formRow">
                        <div class="grid3"><label><?php echo $texts['col_telefono']; ?>:</label></div>
                        <div class="grid9"><input type="text" class="maskPhone" id="tel" value="<?php echo $row['telefono']; ?>" /><span class="note">(999) 999-9999</span></div>
                        <div class="clear"></div>
                    </div>
                    <div class="formRow">
                        <div class="grid3"><label><?php echo $texts['col_correo']; ?>:</label></div>
                        <div class="grid9"><input type="text" name="placeholder" id="email" value="<?php echo $row['e_mail']; ?>" /></div>
                        <div class="clear"></div>
                    </div>
                    <div class="formRow">
                        <div class="grid3"><label><?php echo $texts['col_fecha']; ?>:</label></div>
                        <div class="grid9"><input type="text" class="datepicker" id="birth" value="<?php echo $row['nacimiento']; ?>" /></div>
                        <div class="clear"></div>
                    </div>
                    <div class="formRow">
                        <div class="grid12">
                            <input type="submit" id="sendo" class="buttonS bGreen" value="<?php echo $texts['guardar']; ?>" />
                        </div>
                        <div class="clear"></div>
                    </div>  
            </fieldset>
        </form>
        
        
    </div>
    <!-- Main content ends -->

<div style="display:none; font-weight:bold;" id="savedo"><?php echo $texts['saved']; ?></div>

<!-- Content ends


<form id="formAddNewRow" action="#" title="<?php echo $texts['agregar']; ?>">

        <input type="hidden" name="idStudents" id="idStudents" rel="0" />

        <label for="name">Apellidos</label><input type="text" name="apellidos" id="apellidos" class="required" rel="1" />
        <br>
        <label for="name">Nombre</label><input type="text" name="nombre" id="nombre" rel="2" />
        <br>
        <label for="name">Contraseña</label><input type="text" name="pass" id="pass" />
        <br>
        <label for="name">Dirección</label><input type="text" name="direccion" id="direccion" rel="5" />
        <br>
        <label for="name">Teléfono</label><input type="text" name="telefono" id="telefono" rel="3" />
        <br>
        <label for="name">Email</label><input type="text" name="e_mail" id="e_mail" rel="4" />
</form>
 -->