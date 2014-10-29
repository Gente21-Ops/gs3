<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

include("logon.php");
include('../dict/professor_takegrades.php');
ob_start();
require_once('mysqlcon.php');

    $sql = "SELECT idParciales, nombre FROM parciales WHERE codeEscuelas = '".$_SESSION['qescuelacode']."'";
    $result = mysqli_query($con,$sql);

    $sql2 = "SELECT idParciales, nombre FROM parciales WHERE abierto = '1' AND codeEscuelas = '".$_SESSION['qescuelacode']."'";
    $result2 = mysqli_query($con,$sql2);
    $row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);

    $qparcial = 0;

    if(isset($_GET['qparcial'])){
        $qparcial = $_GET['qparcial'];
    } else {
        //$row4 = mysqli_fetch_array($result2,MYSQLI_ASSOC);
        echo $row2['idParciales'];
        $qparcial = $row2['idParciales']."||";
        //echo '<div id="qparcial" style="display:none;">'.$_GET['qparcial'].'</div>';
    }   

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

?>  

<div id="qidgrupo" style="display:none;"><?php echo $_GET['qcode']; ?></div>
<div id="qidmat" style="display:none;"><?php echo $_GET['qmat']; ?></div>
<div id="t_present" style="display:none;"><?php echo $texts['col_asisok']; ?></div>
<div id="t_notpresent" style="display:none;"><?php echo $texts['col_asisno']; ?></div>
<div id="qlang" style="display:none;"><?php echo $_SESSION['qlen']; ?></div>
<div id="qparcial" style="display:none;"><?php echo $qparcial; ?></div>
<!--<div id="qparcial" style="display:none;"><?php echo $_GET['qparcial']; ?></div>-->
    
    <!-- Main content -->
    <div class="wrapper">
    
        <!-- 6 + 6 -->
        <div class="fluid">        
            
            <!-- Table with opened toolbar -->
            <div class="widget">
                <div class="whead">
                    <h6>
                        <?php echo $texts['tabletitle']/*." ".$day."/".$month."/".$year*/; ?>
                    </h6>
                    <h6 style="float:right; margin-right:33px;"></h6>

                    <div class="clear"></div>
                </div>                

                <div id="dyn2" class="shownpars">
                    <div class="formRow">
                        
                        <div class="grid9"><?php echo $texts['anotherday']; ?> &nbsp; 

                            <select class="datepicker">
                            <?php
                                //echo "caca";

                                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                    if(isset($_GET['qparcial'])){
                                        if($_GET['qparcial'] == $row['idParciales']){
                                            echo '<option selected value="'.$row['idParciales'].'">'.$row['nombre'].'</option>';
                                        } else {
                                            echo '<option value="'.$row['idParciales'].'">'.$row['nombre'].'</option>';
                                        }
                                    } else {
                                        echo '<option value="'.$row['idParciales'].'">'.$row['nombre'].'</option>';
                                    }
                                }
                            ?>
                            </select>
                        </div>
                        
                        <!--<select class="datepicker" type="text" value="<?php echo $_SESSION['']; ?>" /></div>-->

                        <div class="clear"></div>
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

