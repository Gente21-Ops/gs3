<?php
error_reporting(E_ALL);
include("logon.php");
include('../dict/admin_gen_invoice.php');

    ob_start();
    require_once('connection.php');
    mysql_query('SET CHARACTER SET utf8');
    mysql_query('SET NAMES "utf8"');

    //TOP
    $breads = $texts['title'].'^students_config';
    include('top.php');

    //locales para calendario
    if ($_SESSION['qlen'] == 'es'){
        setlocale(LC_ALL,"es_ES");
        echo '<script src="http://jquery-ui.googlecode.com/svn/tags/latest/ui/i18n/jquery.ui.datepicker-es.js"></script>';
        
    } else if ($_SESSION['qlen'] == 'fr'){
        setlocale(LC_ALL, 'fr_FR');
        echo '<script src="http://jquery-ui.googlecode.com/svn/tags/latest/ui/i18n/jquery.ui.datepicker-fr.js"></script>';
    } else {
        setlocale(LC_ALL,'US');
        echo '<script src="http://jquery-ui.googlecode.com/svn/tags/latest/ui/i18n/jquery.ui.datepicker-en-GB.js"></script>';
    }

    //month
    $qm = "";
    if (!isset($_GET['m'])){
        $qm = date('m');
    } else {
        $qm = $_GET['m'];
    }

    function mtom($num){
        //HAY PROBLEMAS CON LAS LOCALES PARA TRADUCIR 24/03/2014
        setlocale(LC_ALL,"es_ES");
        $monthName = date("F", mktime(0, 0, 0, $num, 10));
        return $monthName;
    }

?>  

<div id="deldialog" style="display:none;"><strong><?php echo $texts['deldialog']; ?></strong></div>
<div id="deltitle" style="display:none;"><?php echo $texts['deltitle']; ?></div>
<div id="qlango" style="display:none;"><?php echo $_SESSION['qlen']; ?></div>


<!-- CURRENT MONTH AND YEAR -->
<div id="qmonth" style="display:none;"><?php echo date('m'); ?></div>
<div id="qyear" style="display:none;"><?php echo date('Y'); ?></div>

    
    <!-- Main content -->
    <div class="wrapper">
    
        <!-- 6 + 6 -->
        <div class="fluid">        
            
            <!-- Table with opened toolbar -->
            <div class="widget">
                <div class="whead"><h6><?php echo $texts['tabletitle']." ".mtom($qm); ?>  </h6><div class="clear"></div></div>

                <div id="dyn2" class="shownpars">

                    <a class="tOptions act" title="Options"><img src="images/icons/options" alt="" /></a>
                    <table cellpadding="0" cellspacing="0" border="0" class="dTable" id="dTable">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th><?php echo $texts['col_apellidos']; ?></th>
                        <th><?php echo $texts['col_nombre']; ?></th>
                        <th><?php echo $texts['col_telefono']; ?></th>
                        <th><?php echo $texts['col_correo']; ?></th>
                        <th><?php echo $texts['col_dir']; ?></th>
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