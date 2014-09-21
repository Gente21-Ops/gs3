<?php
error_reporting(E_ALL);
include("logon.php");
include('../dict/students_statistics.php');

    ob_start();

    //TOP
    $breads = $texts['title'].'^students_faltas';
    include('top.php');


    //agarrar NOMBRE e ID de parcial para el DOM
    if(isset($_GET['qparcial'])){
        $sql = "SELECT idParciales, nombre FROM parciales WHERE codeEscuelas = '".$_SESSION['qescuelacode']."' AND idParciales = '".$_GET['qparcial']."'";
        $result = mysqli_query($con,$sql);
        $row = mysqli_fetch_array($result);

        $qparcial = $_GET['qparcial'];
        $qparcial_nom = $row['nombre'];
    } else {
        $sql2 = "SELECT idParciales, nombre FROM parciales WHERE abierto = '1' AND codeEscuelas = '".$_SESSION['qescuelacode']."'";
        $result2 = mysqli_query($con,$sql2);
        $row2 = mysqli_fetch_array($result2);

        $qparcial = $row2['idParciales'];
        $qparcial_nom = $row2['nombre'];
    }

    //agarrar idEstudiante para el DOM
    if(!isset($_GET['qestudiante'])){
        $result = mysqli_query($con,"SELECT idEstudiante FROM map_familiares WHERE idFamiliar = '".$_SESSION['idUsers']."'");
        $row = mysqli_fetch_assoc($result);
        $qestudiante = $row['idEstudiante'];
    } else {
        $qestudiante = $_GET['qestudiante'];
    }

    /////menu options "months"
    $months = "";
    $monthsSel = "";

    /////menu options "students"
    $student = "";
    $studentSel = "";
?>




<div id="deldialog" style="display:none;"><strong><?php echo $texts['deldialog']; ?></strong></div>
<div id="deltitle" style="display:none;"><?php echo $texts['deltitle']; ?></div>
<div id="qlango" style="display:none;"><?php echo $_SESSION['qlen']; ?></div>
<div id="qparcial" style="display:none;"><?php echo $qparcial; ?></div>
<div id="qestudiante" style="display:none;"><?php echo $qestudiante; ?></div>
    
    <!-- Main content -->
    <div class="wrapper">
    
        <!-- 6 + 6 -->
        <div class="fluid">        
            
            <!-- Bars chart -->
            <div class="widget grid6 chartWrapper">
                <div class="whead"><h6><?php echo $texts['table_attendance']; ?>
                    <select id="studentpicker" class="studentpicker">
                            <?php
                                $result2 = mysqli_query($con,"SELECT 
                                        users.idUsers, 
                                        users.nombre, 
                                        users.apellidos, 
                                        map_familiares.idFamiliares 
                                        FROM users, map_familiares 
                                        WHERE users.codeEscuelas = '".$_SESSION['qescuelacode']."' 
                                        AND map_familiares.idEstudiante = users.idUsers 
                                        AND map_familiares.idFamiliar = ".$_SESSION['idUsers']);

                                if(isset($_GET['qestudiante'])){
                                    while ($row3 = mysqli_fetch_array($result2)) {
                                        if($_GET['qestudiante'] == $row3['idUsers']){
                                            $studentSel .= '<option selected value="'.$row3['idUsers'].'">'.$row3['nombre'].' '.$row3['apellidos'].'</option>';
                                        } else {
                                            $studentSel .= '<option value="'.$row3['idUsers'].'">'.$row3['nombre'].' '.$row3['apellidos'].'</option>';
                                        }
                                    }
                                    echo $studentSel;
                                } else {
                                    while ($row3 = mysqli_fetch_array($result2)) {
                                        $student .= '<option value="'.$row3['idUsers'].'">'.$row3['nombre'].' '.$row3['apellidos'].'</option>';
                                    }
                                    echo $student;
                                }
                            ?>
                            </select>
                </h6><div class="clear"></div></div>
                <div class="body"><div class="bars" id="placeholder"></div></div>
            </div>

            <div class="widget grid6 chartWrapper">
                <div class="whead"><h6><?php echo $texts['table_grades']; ?>
                    <select class="studentpicker">
                                <?php
                                    if(isset($_GET['qestudiante'])){
                                        echo $studentSel;
                                    } else {
                                        echo $student;
                                    }
                                ?>
                            </select>
                </h6><div class="clear"></div></div>
                <div class="body"><div class="bars" id="placeholder2"></div></div>
            </div>

        </div>
        
        
    </div>
    <!-- Main content ends -->

<!-- Content ends -->

