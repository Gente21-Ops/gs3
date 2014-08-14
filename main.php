<?php
include("clases/logon.php");
include('dict/main.php');

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
<script type="text/javascript" src="js/plugins/forms/jquery.validationEngine-en.js"></script>
<script type="text/javascript" src="js/plugins/forms/jquery.validationEngine.js"></script>

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


<script type="text/javascript" src="js/charts/chart.js"></script>
<script type="text/javascript" src="js/charts/hBar_side.js"></script>

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
                    <li><a href="ui_custom.html">Custom elements</a></li>
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
        <?php //include('clases/'); ?>
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

        <div class="fluid">
            <div class="grid6">
                <ul class="middleNavR">
                    <li><a href="#" title="Add an article" class="tipN"><img src="images/icons/middlenav/create.png" alt="" /></a></li>
                    <li><a href="#" title="Upload files" class="tipN"><img src="images/icons/middlenav/upload.png" alt="" /></a></li>
                    <li><a href="#" title="Messages" class="tipN"><img src="images/icons/middlenav/dialogs.png" alt="" /></a><strong>8</strong></li>
                    <li><a href="#" title="Check statistics" class="tipN"><img src="images/icons/middlenav/stats.png" alt="" /></a></li>
                </ul>
            </div>
            
            <div class="grid6 middleNavR">
                <img src="images/logos/c2d35dca3f4e8a58458315cb07d66c4f.png">
            </div>
        </div>
               
    
        <!-- 6 + 6 -->
        <div class="fluid">
        
            <!-- Messages #1 -->
            <div class="widget grid6">
                <div class="whead">
                    <h6><?php echo $texts['sec_mensajes']; ?></h6>
                    <div class="on_off">
                        <span class="icon-reload-CW"></span>
                        <input type="checkbox" id="check1" checked="checked" name="chbox" />
                    </div>            
                    <div class="clear"></div>
                </div>
                
                <ul class="messagesOne">
                    <li class="by_user">
                        <a href="#" title=""><img src="images/live/face1.png" alt="" /></a>
                        <div class="messageArea">
                            <span class="aro"></span>
                            <div class="infoRow">
                                <span class="name"><strong>John</strong> says:</span>
                                <span class="time">3 hours ago</span>
                                <div class="clear"></div>
                            </div>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam vel est enim, vel eleifend felis. Ut volutpat, leo eget euismod scelerisque, eros purus lacinia velit, nec rhoncus mi dui eleifend orci. 
                            Phasellus ut sem urna, id congue libero. Nulla eget arcu vel massa suscipit ultricies ac id velit
                        </div>
                        <div class="clear"></div>
                    </li>
                
                    <li class="divider"><span></span></li>
                
                    <li class="by_me">
                        <a href="#" title=""><img src="images/live/face2.png" alt="" /></a>
                        <div class="messageArea">
                            <span class="aro"></span>
                            <div class="infoRow">
                                <span class="name"><strong>Eugene</strong> says:</span>
                                <span class="time">3 hours ago</span>
                                <div class="clear"></div>
                            </div>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam vel est enim, vel eleifend felis. Ut volutpat, leo eget euismod scelerisque, eros purus lacinia velit, nec rhoncus mi dui eleifend orci. 
                            Phasellus ut sem urna, id congue libero. Nulla eget arcu vel massa suscipit ultricies ac id velit
                        </div>
                        <div class="clear"></div>
                    </li>
                
                    <li class="by_me">
                        <a href="#" title=""><img src="images/live/face2.png" alt="" /></a>
                        <div class="messageArea">
                            <span class="aro"></span>
                            <div class="infoRow">
                                <span class="name"><strong>Eugene</strong> says:</span>
                                <span class="time">3 hours ago</span>
                                <div class="clear"></div>
                            </div>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam vel est enim, vel eleifend felis. Ut volutpat, leo eget euismod scelerisque, eros purus lacinia velit, nec rhoncus mi dui eleifend orci. 
                            Phasellus ut sem urna, id congue libero. Nulla eget arcu vel massa suscipit ultricies ac id velit
                        </div>
                        <div class="clear"></div>
                    </li>
                    
                    <li class="divider"><span></span></li>
                
                    <li class="by_user">
                        <a href="#" title=""><img src="images/live/face1.png" alt="" /></a>
                        <div class="messageArea">
                            <span class="aro"></span>
                            <div class="infoRow">
                                <span class="name"><strong>John</strong> says:</span>
                                <span class="time">3 hours ago</span>
                                <div class="clear"></div>
                            </div>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam vel est enim, vel eleifend felis. Ut volutpat, leo eget euismod scelerisque, eros purus lacinia velit, nec rhoncus mi dui eleifend orci. 
                            Phasellus ut sem urna, id congue libero. Nulla eget arcu vel massa suscipit ultricies ac id velit
                        </div>
                        <div class="clear"></div>
                    </li>
                    
                    <li class="divider"><span></span></li>
                
                    <li class="by_me">
                        <a href="#" title=""><img src="images/live/face2.png" alt="" /></a>
                        <div class="messageArea">
                            <span class="aro"></span>
                            <div class="infoRow">
                                <span class="name"><strong>Eugene</strong> says:</span>
                                <span class="time">3 hours ago</span>
                                <div class="clear"></div>
                            </div>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam vel est enim, vel eleifend felis. Ut volutpat, leo eget euismod scelerisque, eros purus lacinia velit, nec rhoncus mi dui eleifend orci. 
                            Phasellus ut sem urna, id congue libero. Nulla eget arcu vel massa suscipit ultricies ac id velit
                        </div>
                        <div class="clear"></div>
                    </li>
                </ul>
            </div>
            
                                              
            <!-- TABLA DE MATERIAS BEGINS -->
            <div class="grid6">
                <div class="widget">
                    <div class="whead">
                        <span class="titleIcon"><input type="checkbox" id="titleCheck" name="titleCheck" /></span>
                        <h6><?php echo $texts['sec_materias']; ?></h6><div class="clear"></div>
                    </div>
                    
                    <table cellpadding="0" cellspacing="0" width="100%" class="dTable" id="checkAll">
                        <thead>
                            <tr>
                                <td width="50">ID</td>
                                <td class="sortCol"><div>Materia<span></span></div></td>
                                <td width="100">Detalle</td>
                            </tr>
                        </thead>
                        <tbody>
                            
                            <?php
                                error_reporting(0);
                                require_once('clases/student/tabla_materias.php');
                            ?>
                        </tbody>
                    </table>
                </div> 
                
                <div class="clear"></div>

                <!-- Calendar -->
                <div class="widget">
                    <div class="whead"><h6><?php echo $texts['sec_calendario']; ?></h6><div class="clear"></div></div>
                    <div id="calendar"></div>
                </div>

            </div>
            


            <!-- TABLA DE MATERIAS ENDS --> 




        </div>

           

        
        
        
    </div>
    <!-- Main content ends -->
    
</div>
<!-- Content ends -->

</body>
</html>
