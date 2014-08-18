<?php
/*
error_reporting(E_ALL);
ini_set('display_errors', '1');
*/
include("logon.php");
include('../dict/professor_takelist.php');

    ob_start();

    //TOP
    $breads = $texts['title'].'^professor_takelist';
    include('top.php');

    //locales para calendario
    if ($_SESSION['qlen'] == 'es'){
        echo '<script src="http://jquery-ui.googlecode.com/svn/tags/latest/ui/i18n/jquery.ui.datepicker-es.js"></script>';
    } else if ($_SESSION['qlen'] == 'fr'){
        echo '<script src="http://jquery-ui.googlecode.com/svn/tags/latest/ui/i18n/jquery.ui.datepicker-fr.js"></script>';
    } else {
        echo '<script src="http://jquery-ui.googlecode.com/svn/tags/latest/ui/i18n/jquery.ui.datepicker-en-GB.js"></script>';
    }

    $day = 0;
    $month = 0;
    $year = 0;

    date_default_timezone_set($_SESSION['qtimezone']);

    //get M/D/Y
    if (!isset($_GET['m']) || !isset($_GET['d']) || !isset($_GET['y'])){
        $day = gmdate('d');
        $month = gmdate('m');
        $year = gmdate('Y');
    } else {
        $day = $_GET['d'];
        $month = $_GET['m'];
        $year = $_GET['y'];
    }

?>  

<div id="qidgrupo" style="display:none;"><?php echo $_GET['qcode']; ?></div>
<div id="qidmat" style="display:none;"><?php echo $_GET['qmat']; ?></div>
<div id="qday" style="display:none;"><?php echo $day; ?></div>
<div id="qmonth" style="display:none;"><?php echo $month; ?></div>
<div id="qyear" style="display:none;"><?php echo $year; ?></div>
<div id="t_present" style="display:none;"><?php echo $texts['col_asisok']; ?></div>
<div id="t_notpresent" style="display:none;"><?php echo $texts['col_asisno']; ?></div>
<div id="qlang" style="display:none;"><?php echo $_SESSION['qlen']; ?></div>
    
    <!-- Main content -->
    <div class="wrapper">
    
        <!-- 6 + 6 -->
        <div class="fluid">        
            
            <!-- Table with opened toolbar -->
            <div class="widget">
                <div class="whead">
                    <h6>
                        <?php echo $texts['tabletitle']." ".$day."/".$month."/".$year; ?>
                    </h6>
                    <h6 style="float:right; margin-right:33px;"></h6>

                    <div class="clear"></div>
                </div>                

                <div id="dyn2" class="shownpars">
                    <div class="formRow">
                        
                        <div class="grid9"><?php echo $texts['anotherday']; ?> &nbsp; <input type="text" class="datepicker" value="<?php echo $year.'-'.$month.'-'.$day; ?>" /></div><div class="clear"></div>
                    </div>
                    
                    <table cellpadding="0" cellspacing="0" border="0" class="dTable" id="dTable">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th><?php echo $texts['col_apellidos']; ?></th>
                        <th><?php echo $texts['col_nombre']; ?></th>
                        <th><?php echo $texts['col_asistio']; ?></th>
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

<!-- Content ends -->

