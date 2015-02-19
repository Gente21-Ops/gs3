<?php
error_reporting(E_ALL);
include("logon.php");
include('../dict/profesor_homework_review.php');
include('general/passgen.php');

//cache killers
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache"); // HTTP/1.0
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past

    ob_start();
    require_once('connection.php');
    mysql_query('SET CHARACTER SET utf8');
    mysql_query('SET NAMES "utf8"');

    //TOP
    $breads = $texts['title'].'^admin_grupos';
    include('top.php');

    //locales para calendario
    if ($_SESSION['qlen'] == 'es'){
        echo '<script src="http://jquery-ui.googlecode.com/svn/tags/latest/ui/i18n/jquery.ui.datepicker-es.js"></script>';
    } else if ($_SESSION['qlen'] == 'fr'){
        echo '<script src="http://jquery-ui.googlecode.com/svn/tags/latest/ui/i18n/jquery.ui.datepicker-fr.js"></script>';
    } else {
        echo '<script src="http://jquery-ui.googlecode.com/svn/tags/latest/ui/i18n/jquery.ui.datepicker-en-GB.js"></script>';
    }

    $qcodetareas = '0';
    if(isset($_GET['qTareaCode'])) { 
        $qcodetareas = $_GET['qTareaCode'];
    }
?> 

<div id="qGroupId" style="display:none;"><?php echo $_GET['qGroupId']; ?></div>
<div id="qlang" style="display:none;"><?php echo $_SESSION['qlen']; ?></div>
<div id="qusercode" style="display:none;"><?php echo $_SESSION['code']; ?></div>
<div id="qcodeschool" style="display:none;"><?php echo $_SESSION['qescuelacode']; ?></div>
<div id="qcodetareas" style="display:none;"><?php echo $qcodetareas; ?></div>
<div id="qdel1" style="display:none;"><?php echo $texts['dia_filedel1']; ?></div>
<div id="qdel2" style="display:none;"><?php echo $texts['dia_filedel2']; ?></div>
<div id="ask_review" style="display:none;"><?php echo $texts['askReview']; ?></div>
<div id="dont_ask_review" style="display:none;"><?php echo $texts['dontAskReview']; ?></div>
<div id="grade_updated" style="display:none;"><?php echo $texts['grade_updated']; ?></div>
<div id="grade_not_updated" style="display:none;"><?php echo $texts['grade_updated']; ?></div>

<!-- Main content -->
<div class="wrapper">


    <!-- 6 + 6 -->
    <div class="fluid">
    
        
        <!-- Table with opened toolbar -->
        <div class="widget">
            <div class="whead"><h6><?php echo $texts['tabletitle']; ?></h6><div class="clear"></div></div>

            <!--<ul class="tToolbar">
                <li id="btnAddNewRow"><a href="#" title=""><span class="icos-archive"></span><?php echo $texts['but_agregar']; ?></a></li>
                <li id="btnDeleteRow"><a href="#" title=""><span class="icos-cross"></span><?php echo $texts['but_borrar']; ?></a></li>
            </ul>-->

            <div id="dyn2" class="shownpars">

                <table cellpadding="0" cellspacing="0" border="0" class="dTable">
                <thead>
                <tr>
                    <th>ID</th>
                    <th><?php echo $texts['col_nombre']; ?></th>
                    <th><?php echo $texts['col_fentrega']; ?></th>
                    <th><?php echo $texts['col_calif']; ?></th>
                    <th><?php echo $texts['but_revisar']; ?></th>                    
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


<!-- PAD -->
<div id="mod_respuesta" title="Tarea" class="dialog">
            <label>Nombre del alumno:</label>
            <input type="text" id="qNombreAlumno" name="qNombreAlumno" class="clear" disabled/>

            <label>Nombre de la tarea:</label>
            <input type="text" id="qTareaNombre" name="qTareaNombre" class="clear" disabled/>

            <div class="divider"><span></span></div>

            <label>Contenido de la tarea:</label>
            <span name="qRespuesta" id="qRespuesta"></span>

            <div class="divider"><span></span></div>
            <div>       
                <label>Calificación</label><input type="text" id="qCalif" name="qCalif" class="clear" />
            </div>
            <div class="divider"><span></span></div>
            <input type="checkbox" id="checkReview" onchange="askReview(this)" name="chbox" /><label>Solicitar Revisión</label>
            <span class="clear"></span>
</div>