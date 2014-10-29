<?php
error_reporting(E_ALL);
include("logon.php");
include('../dict/admin/teachers.php');

    ob_start();

    //TOP
    $breads = $texts['title'].'^admin_teachers_subjects';
    include('top.php');

    $sql = "SELECT nombre, apellidos FROM users WHERE idUsers = '".$_GET['qmaestro']."'";
    $result = mysql_query($sql, $con);
    $row = mysql_fetch_assoc($result);
    $qprof_nom = $row['nombre']." ".$row['apellidos'];

    $sql2 = "SELECT idMaterias, nombre FROM materias";
    $result2 = mysql_query($sql2, $con);
    

?>  

<div id="qmaestro" style="display:none;"><?php echo $_GET['qmaestro']; ?></div>

<!-- Main content -->
<div class="wrapper">


    <!-- 6 + 6 -->
    <div class="fluid">
    
        
        <!-- Table with opened toolbar -->
        <div class="widget">
            <div class="whead"><h6><?php echo $texts['tabletitle_subjects']." ".$qprof_nom; ?></h6><div class="clear"></div></div>

            <ul class="tToolbar">
                <li id="btnAddNewRow"><a href="#" title=""><span class="icos-archive"></span><?php echo $texts['agregar_nuevo_subject']; ?></a></li>
                <li id="btnDeleteRow"><a href="#" title=""><span class="icos-cross"></span><?php echo $texts['borrar_existente_subject']; ?></a></li>
            </ul>

            <div id="dyn2" class="shownpars">

                <a class="tOptions act" title="Options"><img src="images/icons/options" alt="" /></a>
                <table cellpadding="0" cellspacing="0" border="0" class="dTable" id="dTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th><?php echo $texts['col_materias']; ?></th>
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
    

<form id="formAddNewRow" action="#" title="<?php echo $texts['agregar_subject']; ?>">

        <input type="hidden" name="maestro" id="maestro" value="<?php echo $_GET['qmaestro']; ?>"/>
        <label for="name"><?php echo $texts['materia']; ?></label>
        <br>
            <select id="materia" name="materia"> 
            <?php
                while($row2 = mysql_fetch_array($result2)){    
                      echo "<option value='".$row2['idMaterias']."'>".$row2['nombre']."</option>";
                } 

            ?>
            </select>
            <!--<input type="text" name="materia" id="materia" required rel="2" />-->

</form>
