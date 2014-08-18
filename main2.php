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

<script type="text/javascript" src="js/jquery.easing.1.3.min.js"></script>


<!-- Lets add the nano scroller IF FF OR CHROME -->
<script src="js/jquery.nanoscroller.js" type="text/javascript" charset="utf-8" async defer></script>
<link href="css/nanoscroller.css" rel="stylesheet" type="text/css" />
 

<!--
<script type="text/javascript" src="js/plugins/charts/excanvas.min.js"></script>


<script type="text/javascript" src="js/plugins/charts/jquery.flot.js"></script>
<script type="text/javascript" src="js/plugins/charts/jquery.flot.orderBars.js"></script>
<script type="text/javascript" src="js/plugins/charts/jquery.flot.pie.js"></script>
<script type="text/javascript" src="js/plugins/charts/jquery.flot.resize.js"></script>

<script type="text/javascript" src="js/plugins/charts/jquery.sparkline.min.js"></script>
-->

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

<script type="text/javascript" src="js/plupload212/plupload.full.min.js"></script>

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
<script type="text/javascript" src="js/files/functions.js?se=<?php echo rand(10,100); ?>"></script>

<!-- EDITABLE -->
<script type="text/javascript" src="js/plugins/tables/jquery.dataTables.js"></script>
<script type="text/javascript" src="js/plugins/tables/jquery.sortable.js"></script>
<script type="text/javascript" src="js/plugins/tables/jquery.resizable.js"></script>

<script type="text/javascript" src="js/datatableseditable/jquery.jeditable.js"></script>
<script type="text/javascript" src="js/datatableseditable/jquery.validate.js"></script>
<script type="text/javascript" src="js/datatableseditable/jquery.dataTables.editable.js"></script>

<script type="text/javascript" src="js/jquery.alerts.js"></script>
<link href="css/jquery.alerts.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="js/plugins/jquery.blockUI.js"></script>

<!--
<script type="text/javascript" src="js/charts/chart.js"></script>


<script type="text/javascript" src="js/charts/hBar_side.js"></script>
-->

<!--
<script type="text/javascript" src="js/history/jquery.history.js"></script>
<script type="text/javascript" src="js/general/simpleLoader.js"></script>
-->


    
</style>

 </head>

<body>



<?php
    require_once('clases/ui/header.php');
?>


<?php
    //HIDEBAR
    if ($_SESSION['tipo'] == '1'){
        require_once('clases/ui/sidebar_profesor.php');
    } else if ($_SESSION['tipo'] == '2'){
        require_once('clases/ui/sidebar_alumno.php');
    } else if ($_SESSION['tipo'] == '3'){
        require_once('clases/ui/sidebar_admon.php');
    } else if ($_SESSION['tipo'] == '4'){
        require_once('clases/ui/sidebar_padre.php');
    } 
    
?>

    
<!-- Content begins -->
<div id="content">
    loader... <br>
</div>
<!-- Content ends -->

<!--activity-->
<div id="tim" class="hide">
    0
</div>

</body>
</html>
