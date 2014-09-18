<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

include("logon.php");
include('../dict/admin_data.php');
ob_start();
require_once('mysqlcon.php');

$qgrupo = "";
$qgrupo_nom = "";

//agarrar NOMBRE e ID de parcial para el DOM
if(isset($_GET['qgrupo'])){
    $sql = "SELECT idGrupos, nombre
    FROM grupos 
    WHERE codeEscuelas = '".$_SESSION['qescuelacode']."' 
    AND idGrupos = '".$_GET['qgrupo']."'";
    
    $result = mysqli_query($con,$sql);
    $row = mysqli_fetch_array($result);

    $qgrupo = $_GET['qgrupo'];
    $qgrupo_nom = $row['nombre'];
} else {
    $sql = "SELECT idGrupos, nombre FROM grupos WHERE codeEscuelas = '".$_SESSION['qescuelacode']."'";
    //echo "||".$sql."||";
    $result = mysqli_query($con,$sql);
    $row = mysqli_fetch_assoc($result);
    //echo "**".$row['idGrupos']."**";
    $qgrupo = $row['idGrupos'];
    $qgrupo_nom = $row['nombre'];
}

/////menu options "grupos"
$grupos = "";
$gruposSel = "";

//TOP
$breads = $texts['title'].'^admin_grades';
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
<div id="qgrupo" style="display:none;"><?php echo $row['idGrupos']; ?></div>
    
    <!-- Main content -->
    <div class="wrapper">
        <!-- 6 + 6 -->
        <div class="fluid">        

            <!-- Table with opened toolbar -->
            <div class="widget">
                <div class="whead">
                    <h6>
                        <?php echo $texts['tabletitle_group']." ".$row['idGrupos']; ?>
                    </h6>
                    <h6 style="float:right; margin-right:33px;"></h6>

                    <div class="clear"></div>
                </div>                

                <div id="dyn2" class="shownpars">
                    <div class="formRow">

                        <div class="grid3"><?php echo $texts['anothergroup']; ?>
                            <select id="grouppicker" class="grouppicker">
                                <?php
                                    $sql4 = "SELECT idGrupos, nombre FROM grupos WHERE codeEscuelas = '".$_SESSION['qescuelacode']."'";
                                    $result4 = mysqli_query($con,$sql4);
                                    if(isset($_GET['qgrupo'])){
                                        while ($row4 = mysqli_fetch_array($result4, MYSQLI_ASSOC)) {
                                            if($_GET['qgrupo'] == $row4['idGrupos']){
                                                $grupoSel .= '<option selected value="'.$row4['idGrupos'].'">'.$row4['nombre'].'</option>';
                                            } else {
                                                $grupoSel .= '<option value="'.$row4['idGrupos'].'">'.$row4['nombre'].'</option>';
                                            }
                                        }
                                        echo $grupoSel;
                                    } else {
                                        while ($row4 = mysqli_fetch_array($result4, MYSQLI_ASSOC)) {
                                            $grupo .= '<option value="'.$row4['idGrupos'].'">'.$row4['nombre'].'</option>';
                                        }
                                        echo $grupo;
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="clear"></div>
                    </div>
                    
                    <table cellpadding="0" cellspacing="0" border="0" class="dTable" id="dTable2">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th><?php echo $texts['col_nombre']; ?></th>
                        <th><?php echo $texts['col_apellido']; ?></th>
                        <th>Calificaciones</th>
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

