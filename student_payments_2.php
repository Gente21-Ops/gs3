<?php
include("clases/logon.php");
include('dict/student_payments_2.php');
require_once('clases/mysqlcon.php');
$qidbank = $_POST['qidbank'];
//cambiar aquí el identificador del banco
include('clases/student/student_payments_2.php');



//let's check if this payment exists
if (!isset($_POST['selectt'])){
    //print_r($_POST);
    header('Location: student_payments');
} else {
    //print_r($_POST);
    $sqlexists = "SELECT idPagos, pagado FROM pagos WHERE token = '".rawurldecode($_POST['selectt'])."' AND code = '".$_SESSION['code']."' AND pagado = '0'";

    $resexist = $con->query($sqlexists);
    $Totalexist = $resexist->num_rows;
    
    //if payment not found get outta here
    if ($Totalexist == 0){
        header('Location: student_payments?err=3');
        //echo $sqlexists."<br>".rawurldecode($_POST['t']);
    } else {
        $row = $resexist->fetch_assoc();
        if ($row['pagado'] == '1'){
            header('Location: student_payments?err=2');
            //echo "YA PAGADO<br>";
        } else {
            //echo $_POST['selectt'];
        }
    }

}

    ob_start();
    require_once('clases/connection.php');
    mysql_query('SET CHARACTER SET utf8');
    mysql_query('SET NAMES "utf8"');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<title>GoSchool</title>

<link href="css/styles.css" rel="stylesheet" type="text/css" />
<!--[if IE]> <link href="css/ie.css" rel="stylesheet" type="text/css"> <![endif]-->

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>

<script type="text/javascript" src="js/plugins/forms/ui.spinner.js"></script>
<script type="text/javascript" src="js/plugins/forms/jquery.mousewheel.js"></script>
 
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>

<script type="text/javascript" src="js/plugins/charts/excanvas.min.js"></script>
<script type="text/javascript" src="js/plugins/charts/jquery.flot.js"></script>
<script type="text/javascript" src="js/plugins/charts/jquery.flot.orderBars.js"></script>
<script type="text/javascript" src="js/plugins/charts/jquery.flot.pie.js"></script>
<script type="text/javascript" src="js/plugins/charts/jquery.flot.resize.js"></script>
<script type="text/javascript" src="js/plugins/charts/jquery.sparkline.min.js"></script>

<script type="text/javascript" src="js/plugins/tables/jquery.dataTables.js"></script>
<script type="text/javascript" src="js/plugins/tables/jquery.sortable.js"></script>
<script type="text/javascript" src="js/plugins/tables/jquery.resizable.js"></script>

<script type="text/javascript" src="js/plugins/forms/autogrowtextarea.js"></script>
<script type="text/javascript" src="js/plugins/forms/jquery.uniform.js"></script>
<script type="text/javascript" src="js/plugins/forms/jquery.inputlimiter.min.js"></script>
<script type="text/javascript" src="js/plugins/forms/jquery.tagsinput.min.js"></script>
<script type="text/javascript" src="js/plugins/forms/jquery.maskedinput.min.js"></script>
<script type="text/javascript" src="js/plugins/forms/jquery.autotab.js"></script>
<script type="text/javascript" src="js/plugins/forms/jquery.chosen.min.js"></script>
<script type="text/javascript" src="js/plugins/forms/jquery.dualListBox.js"></script>
<script type="text/javascript" src="js/plugins/forms/jquery.cleditor.js"></script>
<script type="text/javascript" src="js/plugins/forms/jquery.ibutton.js"></script>
<?php if($_SESSION['qlen'] == "es"){ ?>
    <script type="text/javascript" src="js/plugins/forms/jquery.validationEngine-es.js"></script>
<?php } else if($language == "en"){ ?>
    <script type="text/javascript" src="js/plugins/forms/jquery.validationEngine-en.js"></script>
<?php } ?>
<script type="text/javascript" src="js/plugins/forms/jquery.validationEngine.js"></script>



<!-- PLUPLOAD -->
<script type="text/javascript" src="js/plugins/uploader/plupload.js"></script>
<script type="text/javascript" src="js/plugins/uploader/plupload.html4.js"></script>
<script type="text/javascript" src="js/plugins/uploader/plupload.html5.js"></script>
<script type="text/javascript" src="js/plugins/uploader/jquery.plupload.queue.js"></script>

<script type="text/javascript" src="js/plugins/wizards/jquery.form.wizard.js"></script>
<script type="text/javascript" src="js/plugins/wizards/jquery.validate.js"></script>
<script type="text/javascript" src="js/plugins/wizards/jquery.form.js"></script>

<script type="text/javascript" src="js/plugins/ui/jquery.collapsible.min.js"></script>
<script type="text/javascript" src="js/plugins/ui/jquery.breadcrumbs.js"></script>
<script type="text/javascript" src="js/plugins/ui/jquery.tipsy.js"></script>
<script type="text/javascript" src="js/plugins/ui/jquery.progress.js"></script>
<script type="text/javascript" src="js/plugins/ui/jquery.timeentry.min.js"></script>
<script type="text/javascript" src="js/plugins/ui/jquery.colorpicker.js"></script>
<script type="text/javascript" src="js/plugins/ui/jquery.jgrowl.js"></script>
<script type="text/javascript" src="js/plugins/ui/jquery.fancybox.js"></script>
<script type="text/javascript" src="js/plugins/ui/jquery.fileTree.js"></script>
<script type="text/javascript" src="js/plugins/ui/jquery.sourcerer.js"></script>

<script type="text/javascript" src="js/plugins/others/jquery.fullcalendar.js"></script>
<script type="text/javascript" src="js/plugins/others/jquery.elfinder.js"></script>

<script type="text/javascript" src="js/plugins/ui/jquery.easytabs.min.js"></script>
<script type="text/javascript" src="js/files/bootstrap.js"></script>
<script type="text/javascript" src="js/files/functions.js"></script>


<!-- FOR THIS -->
<script type="text/javascript" src="js/student/student_payments_2.js"></script>
<!-- PRINTING -->
<script type="text/javascript" src="js/jquery.printElement.min.js"></script>
<!-- QR -->
<script type="text/javascript" src="js/qrcode.js"></script>


<script type="text/javascript" src="js/charts/chart.js"></script>
<script type="text/javascript" src="js/charts/hBar_side.js"></script>

<style type="text/css">
    .fake img {
        -webkit-transform: scale(0.5); /* Saf3.1+, Chrome */
        -moz-transform: scale(0.5); /* FF3.5+ */
        -ms-transform: scale(0.5); /* IE9 */
        -o-transform: scale(0.5); /* Opera 10.5+ */
        transform: scale(0.5);
        /* IE6–IE9 */
        filter: progid:DXImageTransform.Microsoft.Matrix(M11=0.9999619230641713, M12=-0.008726535498373935, M21=0.008726535498373935, M22=0.9999619230641713,SizingMethod='auto expand');
    }​
</style>
 
</head>

<body>

<!-- Top line begins -->
<div id="top">
    <div class="wrapper">
        <a href="index.html" title="" class="logo"><img src="images/logo.png" alt="" /></a>
        
        <!-- Right top nav -->
        <div class="topNav">
            <ul class="userNav">
                <li><a title="" class="search"></a></li>
                <li><a href="#" title="" class="screen"></a></li>
                <li><a href="#" title="" class="settings"></a></li>
                <li><a href="clases/logout.php" title="" class="logout"></a></li>
                <li class="showTabletP"><a href="#" title="" class="sidebar"></a></li>
            </ul>
            <a title="" class="iButton"></a>
            <a title="" class="iTop"></a>
            <div class="topSearch">
                <div class="topDropArrow"></div>
                <form action="">
                    <input type="text" placeholder="search..." name="topSearch" />
                    <input type="submit" value="" />
                </form>
            </div>
        </div>
        
        <!-- Responsive nav -->
        <ul class="altMenu">
            <li><a href="index.html" title="">Página principal</a></li>
            <li><a href="ui.html" title="" class="exp" id="current">UI elements</a>
                <ul>
                    <li><a href="ui.html">General elements</a></li>
                    <li><a href="ui_icons.html">Icons</a></li>
                    <li><a href="ui_buttons.html">Button sets</a></li>
                    <li><a href="ui_grid.html" class="active">Grid</a></li>
                    <li><a href="ui_experimental.html">Experimental</a></li>
                </ul>
            </li>
            <li><a href="forms.html" title="" class="exp">Forms stuff</a>
                <ul>
                    <li><a href="forms.html">Inputs &amp; elements</a></li>
                    <li><a href="form_validation.html">Validation</a></li>
                    <li><a href="form_editor.html">File uploads &amp; editor</a></li>
                    <li><a href="form_wizards.html">Form wizards</a></li>
                </ul>
            </li>
            <li><a href="messages.html" title="">Messages</a></li>
            <li><a href="statistics.html" title="">Statistics</a></li>
            <li><a href="tables.html" title="" class="exp">Tables</a>
                <ul>
                    <li><a href="tables.html">Standard tables</a></li>
                    <li><a href="tables_dynamic.html">Dynamic tables</a></li>
                    <li><a href="tables_control.html">Tables with control</a></li>
                    <li><a href="tables_sortable.html">Sortable &amp; resizable</a></li>
                </ul>
            </li>
            <li><a href="other_calendar.html" title="" class="exp">Other pages</a>
                <ul>
                    <li><a href="other_calendar.html">Calendario</a></li>
                    <li><a href="other_gallery.html">Images gallery</a></li>
                    <li><a href="other_file_manager.html">File manager</a></li>
                    <li><a href="other_404.html">Sample error page</a></li>
                    <li><a href="other_typography.html">Typography</a></li>
                </ul>
            </li>
        </ul>
        <div class="clear"></div>
    </div>
</div>
<!-- Top line ends -->


<?php
    error_reporting(0);
    require_once('clases/ui/sidebar.php');
    error_reporting(1);
?>
    
    
<!-- Content begins -->
<div id="content">
    <div class="contentTop">
        <span class="pageTitle"><span class="icon-screen"></span><?php echo $texts['title']; ?></span>
        <?php include('clases/'); ?>
        <ul class="quickStats">
            <li>
                <a href="" class="blueImg"><img src="images/icons/quickstats/plus.png" alt="" /></a>
                <div class="floatR"><strong class="blue"><?php error_reporting(0); require_once('clases/student/calif_alumno.php'); ?></strong><span>promedio</span></div>
            </li>
            <li>
                <a href="" class="redImg"><img src="images/icons/quickstats/user.png" alt="" /></a>
                <div class="floatR"><strong class="blue"><?php error_reporting(0); require_once('clases/student/faltas_alumno.php'); ?></strong><span>faltas</span></div>
            </li>
            <li>
                <a href="" class="greenImg"><img src="images/icons/quickstats/money.png" alt="" /></a>
                <div class="floatR"><strong class="blue"><?php error_reporting(0); require_once('clases/student/saldo_alumno.php'); ?></strong><span>saldo</span></div>
            </li>
        </ul>
        <div class="clear"></div>
    </div>
    
    <!-- Breadcrumbs line -->
    <div class="breadLine">
        <div class="bc">
            <ul id="breadcrumbs" class="breadcrumbs">
                <li><a href="#">Principal</a></li>
                <!--
                <li><a href="#">UI elements</a>
                    <ul>
                        <li><a href="ui.html" title="">General elements</a></li>
                        <li><a href="ui_icons.html" title="">Icons</a></li>
                         <li><a href="ui_buttons.html" title="">Button sets</a></li>
                        <li><a href="ui_custom.html" title="">Custom elements</a></li>
                        <li><a href="ui_experimental.html" title="">Experimental</a></li>
                    </ul>
                </li>
                <li class="current"><a href="ui_grid.html" title="">Grid</a></li>
                -->
            </ul>
        </div>
        
        <div class="breadLinks">
            <ul>
                <li><a href="#" title=""><i class="icos-list"></i><span>Orders</span> <strong>(+58)</strong></a></li>
                <li><a href="#" title=""><i class="icos-check"></i><span>Tasks</span> <strong>(+12)</strong></a></li>
                <li class="has">
                    <a title="">
                        <i class="icos-money3"></i>
                        <span>Invoices</span>
                        <span><img src="images/elements/control/hasddArrow.png" alt="" /></span>
                    </a>
                    <ul>
                        <li><a href="#" title=""><span class="icos-add"></span>New invoice</a></li>
                        <li><a href="#" title=""><span class="icos-archive"></span>History</a></li>
                        <li><a href="#" title=""><span class="icos-printer"></span>Print invoices</a></li>
                    </ul>
                </li>
            </ul>
             <div class="clear"></div>
        </div>
    </div>
    
    <!-- Main content -->
    <div class="wrapper">
  
        

        <!-- 6 + 6 -->
        <div class="fluid">
                                              
            <!-- TABLA DE PARCIALES PAGOS BEGINS -->
            <div class="widget grid6">                    
                <div class="whead"><h6><?php echo $texts['sec_pagos']; ?></h6><div class="clear"></div></div>
                    <table cellpadding="0" cellspacing="0" width="100%" class="tDefault">
                        <tbody>
                            <tr>
                                <td><strong><?php echo $texts['sec_pagos_banco']; ?></strong></td>
                                <td><strong><?php echo $nombrebanco; ?></td>
                            </tr>
                            <tr>
                                <td><strong><?php echo $texts['sec_pagos_referencia']; ?></strong></td>
                                <td><?php echo $numreferencia; ?></td>
                            </tr>
                            <tr>
                                <td><strong><?php echo $texts['sec_pagos_cuenta']; ?></strong></td>
                                <td><?php echo $numconcentradora; ?></td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <ul class="middleFree">
                                        <li id="elpbut"><a href="#" title="<?php echo $texts['sec_pagos_imprimir']; ?>" class="bLightBlue"><span class="iconb" data-icon="&#xe1f3;"></span><span><?php echo $texts['sec_pagos_imprimir']; ?></span></a></li>
                                    </ul>
                                </td>
                            </tr>
                        </tbody>
                    </table>                                
                <div class="data" id="w1"></div>
            </div>

            <div class="widget grid6">                    
                <div class="whead"><h6><?php echo $texts['sec_pagos_subir']; ?></h6><div class="clear"></div></div>
                    
                    <div class="formRow">
                        <span style="display:none" id="qcucode"><?php echo rawurldecode($_POST['selectt']); ?></span>
                        <?php echo $texts['sec_pagos_subir_texto']; ?>

                            <div class="sideUpload" id="container">
                                <div class="dropFiles" id="jalo" style="margin-top:15px;"></div>

                                <ul class="middleFree" style="margin-bottom:20px;">
                                    <li id="elubut"><a href="#" title="<?php echo $texts['sec_pagos_subir_but']; ?>" class="bGold"><span class="iconb" data-icon="&#xe079;"></span><span><?php echo $texts['sec_pagos_subir_but']; ?></span></a></li>
                                </ul>

                                <div class="clear"></div>

                                <ul class="filesDown" style="display:none;" id="cuenta">
                                    <li class="currentFile">
                                        <div class="fileProcess">
                                            <img src="images/elements/loaders/10s.gif" alt="" class="loader" />
                                            <span id="filo"><strong>_</strong></span>
                                            <div class="fileProgress">
                                                <span id="sizo">0 / 0MB</span> - <span id="speedo">_</span>
                                            </div>
                                            
                                            <div class="contentProgress"><div class="barG tipN" title="61%" id="bar10"></div></div>
                                        </div>
                                    </li>
                                </ul>
                            </div>

                        <!--<ul class="middleFree">
                            <li id="elpbut"><a href="#" title="<?php echo $texts['sec_pagos_subir_but']; ?>" class="bGold"><span class="iconb" data-icon="&#xe1f3;"></span><span><?php echo $texts['sec_pagos_subir_but']; ?></span></a></li>
                        </ul>-->
                    </div>

                <div class="data" id="w1"></div>
            </div>
        
        </div>

           
        <div class="fluid">
            <div class="widget">
                <div class="formRow">
                    <a href="student_payments"><input type="submit" class="buttonS bRed" value="<?php echo $texts['sec_pagos_regresar']; ?>" /></a>
                </div>
            </div>
        </div>      



        <!--DIA-->
        <div style="display:none" id="dialog" title="<?php echo $texts['sec_pagos_thanks_title']; ?>"><?php echo $texts['sec_pagos_thanks']; ?></div>
        
    </div>
    <!-- Main content ends -->
    
</div>
<!-- Content ends -->


<!--codo-->
<div style="display:none;" id="codo"><textarea id="msg" rows="10" cols="40"><?php echo rawurldecode($_POST['selectt']); ?></textarea></div>

<!-- Div datos del pago -->
<div style="display:none; font-family: Arial,Helvetica,sans-serif; font-size:12px;" id="bankdata">
    <img class="fake" src="images/logos/<?php echo $_SESSION['qescuelacode'] ?>.png">
    <br>
    <br>
    <?php echo "<strong>".$texts['sec_pagos_desc']."</strong> ".$pagoname." (".$pagodesc.") ".$texts['sec_pagos_name']." ".$_SESSION['nombre']." ".$_SESSION['apellidos']; ?>
    <br>
    <?php echo $texts['sec_pagos_texto']; ?>
    <br>
    <br>
    <table border="0"  style="font-family: Arial,Helvetica,sans-serif; font-size:12px;">
        <tr>
            <td><strong><?php echo $texts['sec_pagos_banco']; ?></strong></td>
            <td><?php echo $nombrebanco; ?></td>
        </tr>
        <tr>
            <td><strong><?php echo $texts['sec_pagos_referencia']; ?></strong></td>
            <td><?php echo $numreferencia; ?></td>
        </tr>
        <tr>
            <td><strong><?php echo $texts['sec_pagos_cuenta']; ?></strong></td>
            <td><?php echo $numconcentradora; ?></td>
        </tr>
    </table>
    <br>
    * <?php echo $texts['sec_pagos_nota']; ?>
    <br>
    <br>
    <div id="qr"></div>
    <small><?php echo rawurldecode($_POST['selectt']); ?></small>
</div>


</body>
</html>
