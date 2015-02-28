<?php
error_reporting(E_ALL);
include("logon.php");
include('../dict/profesor_homework.php');
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
    if(isset($_GET['qcodetareas'])) { 
        $qcodetareas = $_GET['qcodetareas'];
    }
?> 

<div id="groupid" style="display:none;"><?php echo $_GET['qcode']; ?></div>
<div id="qlang" style="display:none;"><?php echo $_SESSION['qlen']; ?></div>
<div id="qusercode" style="display:none;"><?php echo $_SESSION['code']; ?></div>
<div id="qcodeschool" style="display:none;"><?php echo $_SESSION['qescuelacode']; ?></div>
<div id="qcodetareas" style="display:none;"><?php echo $qcodetareas; ?></div>
<div id="qdel1" style="display:none;"><?php echo $texts['dia_filedel1']; ?></div>
<div id="qdel2" style="display:none;"><?php echo $texts['dia_filedel2']; ?></div>

<!-- Main content -->
<div class="wrapper">


    <!-- 6 + 6 -->
    <div class="fluid">
    
        
        <!-- Table with opened toolbar -->
        <div class="widget">
            <div class="whead"><h6><?php echo $texts['tabletitle']; ?></h6><div class="clear"></div></div>

            <ul class="tToolbar">
                <li id="btnAddNewRow"><a title=""><span class="icos-archive"></span><?php echo $texts['but_agregar']; ?></a></li>
                <li id="btnDeleteRow"><a title=""><span class="icos-cross"></span><?php echo $texts['but_borrar']; ?></a></li>
            </ul>

            <div id="dyn2" class="shownpars">

                <table cellpadding="0" cellspacing="0" border="0" id="addHomeTable">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>code</th>
                    <th><?php echo $texts['col_titulo']; ?></th>
                    <th><?php echo $texts['col_desc']; ?></th>
                    <th><?php echo $texts['col_fentrega']; ?></th>
                    <th><?php echo $texts['but_editar']; ?></th>
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

<form id="formAddNewRow" action="#" title="<?php echo $texts['dia_diatitle']; ?>">
    &nbsp;
</form>

<!-- FILE DELETING -->
<div id="mod_del" title="Borrar archivo">
    <div class="formRow" id="deltexto" style="padding-top:0px;">
    </div>
</div>

<!-- TEMP CONTAINER -->
<div id="plcont_tmp" title="View attached files">
    <!-- FORM CONTAINER -->
    <div id="plconto" style="display:none">

        <input type="hidden" name="idGrupos" id="idGrupos" value="<?php echo $_GET['qcode']; ?>" />
        <input type="hidden" name="idMateria" id="idMateria" value="<?php echo $_GET['qmat']; ?>" />

        <input type="hidden" name="edito" id="edito" value="--edito--" rel="5" />
        <input type="hidden" name="reviso" id="reviso" value="--reviso--" rel="6" />
        
        <input type="hidden" name="idtareas" class="changecode" value="" rel="0" />
        <input type="hidden" name="code" class="changecode" value="<?php echo generatePassword(16); ?>" rel="1" />

        <input type="hidden" name="allfiles" id="allfiles" value="" />
        <input type="hidden" name="allnames" id="allnames" value="" />

        <label for="name"><?php echo $texts['dia_title']; ?></label>
        <input type="text" name="nombre" id="nombre" rel="2" />
        
        <label for="entrega"><?php echo $texts['dia_entrega']; ?></label>
        <input type="text" class="datepicker1" name="fechaEntrega" id="fechaEntrega" rel="4" value="<?php echo date('Y-m-d'); ?>" />
        
        <label for="desc"><?php echo $texts['dia_desc']; ?></label>
        <textarea rows="7" name="descripcion" id="descripcion" rel="3"></textarea>

        <label for="desc"><?php echo $texts['dia_files']; ?></label>
        
        
        <div>
            <div id="container" style="margin-top:35px;">
                <ul id="filelist" class="filesDown">
                    <small>Attached files</small>
                </ul>
                
                <a class="buttonM bGreyish" id="browse"><span class="icon-download" style="color:#FFF;"></span><span style="color:#FFF;"><?php echo $texts['dia_filesup']; ?></span></a>
                
                <pre id="console"></pre>

            </div>
        </div>

    </div>
</div>

<!-- FILE LIST -->
<div id="mod_files" title="Modify homework">
    <div class="formRow" id="plcont_list" style="padding-top:0px;">        
    </div>
</div>  