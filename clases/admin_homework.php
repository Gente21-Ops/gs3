<?php
error_reporting(E_ALL);
include("logon.php");
include('../dict/admin_homework.php');

    ob_start();
    require_once('connection.php');
    mysql_query('SET CHARACTER SET utf8');
    mysql_query('SET NAMES "utf8"');

    //TOP
    $breads = $texts['title'].'^parents_homework';
    include('top.php');

    if(!isset($_GET['qestudiante'])){
        $qestudiante = "";
    } else {
        $sql2 = "SELECT nombre, apellidos FROM users WHERE codeEscuelas = '".$_SESSION['qescuelacode']."' AND idUsers = '".$_GET['qestudiante']."'";
        $result2 = mysql_query($sql2, $con);
        $row2 = mysql_fetch_array($result2);

        $qestudiante = $_GET['qestudiante'];
        $qestudiante_nom = $row2['nombre']." ".$row2['apellidos'];
    }

    /////menu options "students"
    $student = "";
    $studentSel = "";
?>  

<div id="deldialog" style="display:none;"><strong><?php echo $texts['deldialog']; ?></strong></div>
<div id="deltitle" style="display:none;"><?php echo $texts['deltitle']; ?></div>
<div id="qlango" style="display:none;"><?php echo $_SESSION['qlen']; ?></div>
<div id="qestudiante" style="display:none;"><?php echo $qestudiante; ?></div>
    
    <!-- Main content -->
    <div class="wrapper">
    
        <!-- 6 + 6 -->
        <div class="fluid">        
            
            <!-- Table with opened toolbar -->
            <div class="widget">
                <div class="whead"><h6><?php echo $texts['tabletitle']." ".$qestudiante_nom; ?></h6>
                    <div class="clear"></div>
                </div>

                <div id="dyn2" class="shownpars">

                    <table cellpadding="0" cellspacing="0" border="0" class="dTable" id="dTable">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th><?php echo $texts['col_titulo']; ?></th>
                        <th><?php echo $texts['col_fecha']; ?></th>
                        <th><?php echo $texts['col_fechaentrega']; ?></th>
                        <th><?php echo $texts['col_materia']; ?></th>
                        <th><?php echo $texts['col_correo']; ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    </table> 
                </div>
                <div class="clear"></div> 
            </div> 



            <!-- Table with opened toolbar -->
            <div class="widget">
                <div class="whead"><h6><?php echo $texts['tabletitle_done']." ".$qestudiante_nom; ?></h6><div class="clear"></div></div>

                <div id="dyn2" class="shownpars">

                    <table cellpadding="0" cellspacing="0" border="0" class="dTable" id="dTable_done">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th><?php echo $texts['col_titulo']; ?></th>
                        <th><?php echo $texts['col_fecha']; ?></th>
                        <th><?php echo $texts['col_fechaentrega']; ?></th>
                        <th><?php echo $texts['col_materia']; ?></th>
                        <th><?php echo $texts['col_grade']; ?></th>
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