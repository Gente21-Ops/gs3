<?php
error_reporting(E_ALL);
include("logon.php");
include('../dict/profesor_homework.php');
include('general/passgen.php');

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
                <li id="btnAddNewRow"><a href="#" title=""><span class="icos-archive"></span><?php echo $texts['but_agregar']; ?></a></li>
                <li id="btnDeleteRow"><a href="#" title=""><span class="icos-cross"></span><?php echo $texts['but_borrar']; ?></a></li>
            </ul>

            <div id="dyn2" class="shownpars">

                <table cellpadding="0" cellspacing="0" border="0" class="dTable">
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

    <input type="hidden" name="idGrupos" id="idGrupos" value="<?php echo $_GET['qcode']; ?>" />
    <input type="hidden" name="idMateria" id="idMateria" value="<?php echo $_GET['qmat']; ?>" />

    <input type="hidden" name="edito" id="edito" value="--edito--" rel="5" />
    <input type="hidden" name="reviso" id="reviso" value="--reviso--" rel="6" />
    
    <input type="hidden" name="code" id="code" value="<?php echo generatePassword(16); ?>" rel="1" />

    <input type="hidden" name="allfiles" id="allfiles" value="" rel="1" />
    <input type="hidden" name="allnames" id="allnames" value="" rel="1" />

    <label for="name"><?php echo $texts['dia_title']; ?></label>
    <input type="text" name="nombre" id="nombre" rel="2" />
    
    <label for="entrega"><?php echo $texts['dia_entrega']; ?></label>
    <input type="text" class="datepicker1" name="fechaEntrega" id="fechaEntrega" rel="4" value="<?php echo date('Y-m-d'); ?>" />
    
    <label for="desc"><?php echo $texts['dia_desc']; ?></label>
    <textarea rows="7" name="descripcion" id="descripcion" rel="3"></textarea>

    <label for="desc"><?php echo $texts['dia_files']; ?></label>
    <div>
        <div id="container" style="margin-top:35px;">
        	<!-- This is disabled until I get the dialog in two columns -->
            <!-- <div class="dropFiles<?php if ($_SESSION['qlen'] == 'es'){ echo "_es"; } else if ($_SESSION['qlen'] == 'fr'){ echo "_fr"; } ?>" id="jalo" class="margin-bottom:10px;"></div> -->
            <!-- FILE UPLOADING STUFF -->
            <ul id="filelist" class="filesDown">
                <?php 
                    /*
                    //already uploaded files                    
                    $fid = 0;
                    $html1 = '';                        
                    while($rowf = mysqli_fetch_array($resultf)){
                        $newname = str_replace('_', ' ', $rowf['name']);

                        $html1 .= '<li class="currentFile" id="'.$fid.'">';
                        $html1 .='<span class="fileSuccess"></span>'.$newname.' <span class="righto">';
                        $html1 .='<a href="files/'.$_SESSION['qescuelacode'].'/'.$rowf['patho'].'" data-namo="'.$rowf['name'].'" id="prev_'.$fid.'" target="_blank"><span class="icos-inbox" style="padding:0; margin-right:10px;"></span></a> ';
                        $html1 .='<a href="#" id="delo_'.$fid.'"><span class="icos-trash" style="padding:0; margin-right:0px;"></span></a></span>';
                        $html1 .='</li>';
                        $fid += 1;
                    }
                    echo $html1;
                    while($rowf = mysqli_fetch_array($resultf)){
                        echo $rowf['name']."<br>";
                    } 
                    */
                ?>
            </ul>
            <div id="container" style="margin-top:10px;">
                <a href="#" class="buttonM bGreyish" id="browse"><span class="icon-download" style="color:#FFF;"></span><span style="color:#FFF;"><?php echo $texts['dia_filesup']; ?></span></a>
            </div>
            <pre id="console"></pre>

        </div>
    </div>
</form>



<!-- FILE DELETING -->
<div id="mod_del" title="Borrar archivo">
    <div class="formRow" id="deltexto" style="padding-top:0px;">
        &nbsp;
    </div>
</div>  