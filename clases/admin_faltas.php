<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

include("logon.php");
include('../dict/admin_data.php');
ob_start();
require_once('mysqlcon.php');

//agarrar NOMBRE e ID de parcial para el DOM
if(isset($_GET['qparcial'])){
    $sql = "SELECT idParciales, nombre FROM parciales WHERE codeEscuelas = '".$_SESSION['qescuelacode']."' AND idParciales = '".$_GET['qparcial']."'";
    $result = mysqli_query($con,$sql);
    $row = mysqli_fetch_array($result);

    $qparcial = $_GET['qparcial'];
    $qparcial_nom = $row['nombre'];
} else {
    $sql = "SELECT idParciales, nombre FROM parciales WHERE codeEscuelas = '".$_SESSION['qescuelacode']."'";
    $result = mysqli_query($con,$sql);
    $row = mysqli_fetch_array($result);

    $qparcial = $row['idParciales'];
    $qparcial_nom = $row['nombre'];
}

//agarrar idEstudiante para el DOM
if(!isset($_GET['qestudiante'])){
    $qestudiante = "";
} else {
    $sql2 = "SELECT nombre, apellidos FROM users WHERE codeEscuelas = '".$_SESSION['qescuelacode']."' AND idUsers = '".$_GET['qestudiante']."'";
    $result2 = mysqli_query($con,$sql2);
    $row2 = mysqli_fetch_array($result2);

    $qestudiante = $_GET['qestudiante'];
    $qestudiante_nom = $row2['nombre']." ".$row2['apellidos'];
}

/////menu options "months"
$months = "";
$monthsSel = "";

//TOP
$breads = $texts['title'].'^admin_faltas';
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
<div id="qestudiante" style="display:none;"><?php echo $qestudiante; ?></div>

    <!-- Main content -->
    <div class="wrapper">
    
        <!-- 6 + 6 -->
        <div class="fluid">        

            <!-- Table with opened toolbar -->
            <div class="widget">
                <div class="whead">
                    <h6>
                        <?php echo $texts['tabletitle_faltas']." ".$qparcial_nom." ".$texts['tabletitle_grades2']." ".$qestudiante_nom; ?>
                    </h6>
                    <h6 style="float:right; margin-right:33px;"></h6>

                    <div class="clear"></div>
                </div>                

                <div id="dyn2" class="shownpars">
                    <div class="formRow">

                        <div class="grid4"><?php echo $texts['anotherday']; ?>
                            <select id="midtermpicker" class="midtermpicker">
                            <?php
                                $sql3 = "SELECT idParciales, nombre FROM parciales WHERE codeEscuelas = '".$_SESSION['qescuelacode']."'";
                                $result3 = mysqli_query($con,$sql3);
                                if(isset($_GET['qparcial'])){
                                    while ($row3 = mysqli_fetch_array($result3, MYSQLI_ASSOC)) {
                                        if($_GET['qparcial'] == $row3['idParciales']){
                                            $monthsSel .= '<option selected value="'.$row3['idParciales'].'">'.$row3['nombre'].'</option>';
                                        } else {
                                            $monthsSel .= '<option value="'.$row3['idParciales'].'">'.$row3['nombre'].'</option>';
                                        }
                                    }
                                    echo $monthsSel;
                                } else {
                                    while ($row3 = mysqli_fetch_array($result3, MYSQLI_ASSOC)) {
                                        $months .= '<option value="'.$row3['idParciales'].'">'.$row3['nombre'].'</option>';
                                    }
                                    echo $months;
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
                        <th><?php echo $texts['col_faltas']; ?></th>
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

