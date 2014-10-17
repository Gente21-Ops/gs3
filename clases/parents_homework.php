<?php
error_reporting(E_ALL);
include("logon.php");
include('../dict/parents_homework.php');

mysql_query('SET CHARACTER SET utf8');
mysql_query('SET NAMES "utf8"');

//TOP
$breads = $texts['title'].'^parents_homework';
include('top.php');


if(!isset($_GET['qestudiante'])){
    $result = mysql_query("SELECT idEstudiante FROM map_familiares WHERE idFamiliar = '".$_SESSION['idUsers']."'");
    $row = mysql_fetch_assoc($result);
    $qestudiante = $row['idEstudiante'];
} else {
    $qestudiante = $_GET['qestudiante'];
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
                <div class="whead"><h6><?php echo $texts['tabletitle']; ?>
                    <select class="studentpicker">
                    <?php
                        $result2 = mysql_query("SELECT 
                                users.idUsers, 
                                users.nombre, 
                                users.apellidos, 
                                map_familiares.idFamiliares 
                                FROM users, map_familiares 
                                WHERE users.codeEscuelas = '".$_SESSION['qescuelacode']."' 
                                AND map_familiares.idEstudiante = users.idUsers 
                                AND map_familiares.idFamiliar = ".$_SESSION['idUsers']);

                        if(isset($_GET['qestudiante'])){
                            while ($row3 = mysql_fetch_array($result2)) {
                                if($_GET['qestudiante'] == $row3['idUsers']){
                                    $studentSel .= '<option selected value="'.$row3['idUsers'].'">'.$row3['nombre'].' '.$row3['apellidos'].'</option>';
                                } else {
                                    $studentSel .= '<option value="'.$row3['idUsers'].'">'.$row3['nombre'].' '.$row3['apellidos'].'</option>';
                                }
                            }
                            echo $studentSel;
                        } else {
                            while ($row3 = mysql_fetch_array($result2)) {
                                $student .= '<option value="'.$row3['idUsers'].'">'.$row3['nombre'].' '.$row3['apellidos'].'</option>';
                            }
                            echo $student;
                        }
                    ?>
                    </select>
                </h6>
                    
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
                <div class="whead"><h6><?php echo $texts['tabletitle_done']; ?></h6><div class="clear"></div></div>

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

<!-- Content ends


<form id="formAddNewRow" action="#" title="<?php echo $texts['agregar']; ?>">

    <input type="hidden" name="idStudents" id="idStudents" rel="0" />

    <div class="formRow fluid">
        <div class="grid7"><input type="text"  name="apellidos" id="apellidos" class="required" rel="1" placeholder="<?php echo $texts['f_apellidos']; ?>" /></div>
        <div class="grid5"><input type="text" name="nombre" id="nombre" class="required" rel="2" placeholder="<?php echo $texts['f_nombre']; ?>" /></div>
    </div>

    <div class="formRow fluid">        
        <div class="grid12"><input type="text" name="pass" id="pass" class="required" placeholder="<?php echo $texts['f_contrasena']; ?>" /></div>
    </div>

    <div class="formRow fluid">        
        <div class="grid12"><input type="text" name="direccion" class="required" id="direccion" rel="5" placeholder="<?php echo $texts['f_direccion']; ?>" /></div>
    </div>

    <div class="formRow fluid">
        <div class="grid5"><input type="text" name="telefono" id="telefono" rel="3" placeholder="<?php echo $texts['f_telefono']; ?>"  class="maskPhone required" /></div>
        <div class="grid7"><input type="text" name="e_mail" id="e_mail" rel="4" class="required" placeholder="<?php echo $texts['f_email']; ?>" /></div>
    </div>

</form>  -->