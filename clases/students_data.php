<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

include("logon.php");
include('../dict/students_data.php');
ob_start();
require_once('mysqlcon.php');

    //$sql = "SELECT idParciales, nombre FROM parciales WHERE codeEscuelas = '".$_SESSION['qescuelacode']."'";
    //$result = mysqli_query($con,$sql);

    

    if(isset($_GET['qparcial'])){
        $sql = "SELECT idParciales, nombre FROM parciales WHERE codeEscuelas = '".$_SESSION['qescuelacode']."' AND idParciales = '".$_GET['qparcial']."'";
        $result = mysqli_query($con,$sql);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

        $qparcial = $_GET['qparcial'];
        $qparcial_nom = $row['nombre'];
    } else {
        $sql2 = "SELECT idParciales, nombre FROM parciales WHERE abierto = '1' AND codeEscuelas = '".$_SESSION['qescuelacode']."'";
        $result2 = mysqli_query($con,$sql2);
        $row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);

        $qparcial = $row2['idParciales'];
        $qparcial_nom = $row2['nombre'];
    }

    //TOP
    $breads = $texts['title'].'^students_data';
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

<div id="t_present" style="display:none;"><?php echo $texts['col_asisok']; ?></div>
<div id="t_notpresent" style="display:none;"><?php echo $texts['col_asisno']; ?></div>
<div id="qlang" style="display:none;"><?php echo $_SESSION['qlen']; ?></div>
<div id="qparcial" style="display:none;"><?php echo $qparcial; ?></div>

    
    <!-- Main content -->
    <div class="wrapper">
    
        <!-- 6 + 6 -->
        <div class="fluid">        
            
            <!-- Table with opened toolbar -->
            <div class="widget">
                <div class="whead">
                    <h6>
                        <?php echo $texts['tabletitle_faltas']." ".$qparcial_nom; ?>
                    </h6>
                    <h6 style="float:right; margin-right:33px;"></h6>

                    <div class="clear"></div>
                </div>                

                <div id="dyn2" class="shownpars">
                    <div class="formRow">
                        
                        <div class="grid9"><?php echo $texts['anotherday']; ?> &nbsp; 

                            <select class="midtermpicker">
                            <?php
                                if(isset($_GET['qparcial'])){
                                    $sql3 = "SELECT idParciales, nombre FROM parciales WHERE codeEscuelas = '".$_SESSION['qescuelacode']."'";
                                    $result3 = mysqli_query($con,$sql3);
                                    while ($row3 = mysqli_fetch_array($result3, MYSQLI_ASSOC)) {
                                        if($_GET['qparcial'] == $row3['idParciales']){
                                            echo '<option selected value="'.$row3['idParciales'].'">'.$row3['nombre'].'</option>';
                                        } else {
                                            echo '<option value="'.$row3['idParciales'].'">'.$row3['nombre'].'</option>';
                                        }
                                    }
                                } else {
                                    $sql3 = "SELECT idParciales, nombre FROM parciales WHERE codeEscuelas = '".$_SESSION['qescuelacode']."'";
                                    $result3 = mysqli_query($con,$sql3);
                                    while ($row3 = mysqli_fetch_array($result3, MYSQLI_ASSOC)) {
                                        echo '<option value="'.$row3['idParciales'].'">'.$row3['nombre'].'</option>';
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
                        <th><?php echo $texts['col_materia']; ?></th>
                        <th><?php echo $texts['col_faltas']; ?></th>
                    </tr>
                    </thead>
                    </table> 

                </div>

                <div class="clear"></div> 

            </div> 

            <!-- Table with opened toolbar -->
            <div class="widget">
                <div class="whead">
                    <h6>
                        <?php echo $texts['tabletitle_grades']." ".$qparcial_nom; ?>
                    </h6>
                    <h6 style="float:right; margin-right:33px;"></h6>

                    <div class="clear"></div>
                </div>                

                <div id="dyn2" class="shownpars">
                    <div class="formRow">
                        
                        <div class="grid9"><?php echo $texts['anotherday']; ?> &nbsp; 

                            <select class="midtermpicker">
                            <?php
                                if(isset($_GET['qparcial'])){
                                    $sql3 = "SELECT idParciales, nombre FROM parciales WHERE codeEscuelas = '".$_SESSION['qescuelacode']."'";
                                    $result3 = mysqli_query($con,$sql3);
                                    while ($row3 = mysqli_fetch_array($result3, MYSQLI_ASSOC)) {
                                        if($_GET['qparcial'] == $row3['idParciales']){
                                            echo '<option selected value="'.$row3['idParciales'].'">'.$row3['nombre'].'</option>';
                                        } else {
                                            echo '<option value="'.$row3['idParciales'].'">'.$row3['nombre'].'</option>';
                                        }
                                    }
                                } else {
                                    $sql3 = "SELECT idParciales, nombre FROM parciales WHERE codeEscuelas = '".$_SESSION['qescuelacode']."'";
                                    $result3 = mysqli_query($con,$sql3);
                                    while ($row3 = mysqli_fetch_array($result3, MYSQLI_ASSOC)) {
                                        echo '<option value="'.$row3['idParciales'].'">'.$row3['nombre'].'</option>';
                                    }
                                }
                            ?>
                            </select>
                        </div>
                        
                        <!--<select class="datepicker" type="text" value="<?php echo $_SESSION['']; ?>" /></div>-->

                        <div class="clear"></div>
                    </div>
                    
                    <table cellpadding="0" cellspacing="0" border="0" class="dTable" id="dTable2">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th><?php echo $texts['col_materia']; ?></th>
                        <th><?php echo $texts['col_calif']; ?></th>
                    </tr>
                    </thead>
                    </table> 

                </div>

                <div class="clear"></div> 

            </div> 
            


        </div>
        
        
    </div>
    <!-- Main content ends -->

<!-- Content ends -->

