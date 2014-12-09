<?php
error_reporting(E_ALL);
include("logon.php");
include('../dict/profesor_homework.php');

    ob_start();

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
?>  
<script type="text/javascript" src="js/plugins/ui/jquery.jgrowl.js"></script>
<script src="http://jquery-ui.googlecode.com/svn/tags/latest/ui/i18n/jquery.ui.datepicker-es.js"></script>

<div id="groupid" style="display:none;"><?php echo $_GET['qcode']; ?></div>

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



<form id="formAddNewRow" action="#" title="<?php echo $texts['agregar']; ?>">

        <input type="hidden" name="idGrupos" id="idGrupos" value="<?php echo $_GET['qcode']; ?>" />
        <input type="hidden" name="idMateria" id="idMateria" value="<?php echo $_GET['qmat']; ?>" />

        <label for="name">Título de la tarea</label><input type="text" name="nombre" id="nombre" rel="1" />
        <label for="entrega">Fecha de entrega</label><input type="text" class="datepicker" name="entrega" id="entrega" rel="1" />
        <label for="desc">Descripción</label><input type="text" name="desc" id="desc" rel="1" />
        
</form>


