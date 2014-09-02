<?php
error_reporting(E_ALL);
include("logon.php");
include('../dict/students_config.php');

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
?>  

    <div id="qlang" style="display:none;"><?php echo $_SESSION['qlen']; ?></div>
    <div id="qimgchanged" style="display:none;"><?php echo $texts['imgchanged']; ?></div>
    <div id="qerror" style="display:none;"><?php echo $texts['savederror']; ?></div>
    <div style="display:none;" id="quser"><?php echo $_SESSION['code']; ?></div>
    
    <!-- Main content -->
    <div class="wrapper">


        <div class="fluid">
        
            <!-- Bars chart -->
            <div class="widget grid6 chartWrapper">
                <div class="whead"><h6><?php echo $texts['img_but_browse']; ?></h6><div class="clear"></div></div>
                <div class="body">

                    <!--arreglar este estilo en línea!!!! -->
                    <ul class="middleFree" style="margin-top:10px;">
                        <li><img id="elusero320" src="images/users/320/<?php echo $_SESSION['code']; ?>.jpg?ran=<?php echo rand(1, 200); ?>" alt="" class="relative" /></li>
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
            
            <!-- Bars chart -->
            <div class="widget grid6 chartWrapper">
                <div class="whead"><h6>Estadísticas generales</h6><div class="clear"></div></div>
                <div class="formRow">
                    <div class="grid3"><label>Rendimiento:</label></div>
                    <div class="grid9">
                        <div id="progress"></div>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="formRow">
                    <div class="grid3"><label>Faltas:</label></div>
                    <div class="grid9">
                        <div id="progress1"></div>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
        
        </div>

    
        <!-- 6 + 6 -->
        <form action="" class="main">
            <fieldset>
                <div class="widget fluid">
                    <div class="whead"><h6><?php echo $texts['tabletitle']; ?></h6><div class="clear"></div></div>
                    <div class="formRow">
                        <div class="grid3"><label><?php echo $texts['col_apellidos']; ?>:</label></div>
                        <div class="grid9">
                            <span class="grid4"><input type="text" id="name" value="<?php echo $_SESSION['nombre']; ?>" /></span>
                            <span class="grid8"><input type="text" id="last" value="<?php echo $_SESSION['apellidos']; ?>" /></span>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="formRow">
                        <div class="grid3"><label><?php echo $texts['col_apodo']; ?>:</label></div>
                        <div class="grid9"><input type="text" id="nick" value="<?php echo $_SESSION['qnick']; ?>" /></div>
                        <div class="clear"></div>
                    </div>
                    <div class="formRow">
                        <div class="grid3"><label><?php echo $texts['col_dir']; ?>:</label></div>
                        <div class="grid9"><input type="text" id="address" value="<?php echo $_SESSION['direccion']; ?>" /></div>
                        <div class="clear"></div>
                    </div>
                    <div class="formRow">
                        <div class="grid3"><label><?php echo $texts['col_telefono']; ?>:</label></div>
                        <div class="grid9"><input type="text" class="maskPhone" id="tel" value="<?php echo $_SESSION['telefono']; ?>" /><span class="note">(999) 999-9999</span></div>
                        <div class="clear"></div>
                    </div>
                    <div class="formRow">
                        <div class="grid3"><label><?php echo $texts['col_correo']; ?>:</label></div>
                        <div class="grid9"><input type="text" name="placeholder" id="email" value="<?php echo $_SESSION['e_mail']; ?>" /></div>
                        <div class="clear"></div>
                    </div>
                    <div class="formRow">
                        <div class="grid3"><label><?php echo $texts['col_fecha']; ?>:</label></div>
                        <div class="grid9"><input type="text" class="datepicker" id="birth" value="<?php echo $_SESSION['qnac']; ?>" /></div>
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