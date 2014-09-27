<?php
error_reporting(E_ALL);
include("logon.php");
include('../dict/admin/materias.php');

    ob_start();

    //TOP
    $breads = $texts['title'].'^admin_materias';
    include('top.php');

    $sql = "SELECT idNiveles, nombre FROM niveles";
    $result = mysqli_query($con,$sql);

    $sql2 = "SELECT idUsers, nombre, apellidos FROM users WHERE tipo = 1 AND codeEscuelas = '".$_SESSION['qescuelacode']."'";
    $result2 = mysqli_query($con,$sql2);
?>  
    
<!-- Main content -->
<div class="wrapper">


    <!-- 6 + 6 -->
    <div class="fluid">
    
        
        <!-- Table with opened toolbar -->
        <div class="widget">
            <div class="whead"><h6><?php echo $texts['tabletitle']; ?></h6><div class="clear"></div></div>

            <ul class="tToolbar">
                <li id="btnAddNewRow"><a href="#" title=""><span class="icos-archive"></span><?php echo $texts['agregar_nuevo']; ?></a></li>
                <li id="btnDeleteRow"><a href="#" title=""><span class="icos-cross"></span><?php echo $texts['borrar_existente']; ?></a></li>
            </ul>

            <div id="dyn2" class="shownpars">

                <a class="tOptions act" title="Options"><img src="images/icons/options" alt="" /></a>
                <table cellpadding="0" cellspacing="0" border="0" class="dTable" id="dTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th><?php echo $texts['col_nombre']; ?></th>
                        <th><?php echo $texts['col_nivel']; ?></th>
                        <th><?php echo $texts['col_maestro']; ?></th>
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

<!--

<form id="formAddNewRow" action="#" title="<?php echo $texts['agregar']; ?>">

        <input type="hidden" name="idMaterias" id="idMaterias" rel="0" />
        <label for="name"><?php echo $texts['col_nombre']; ?></label><input type="text" name="nombre" id="nombre" rel="1" />
        
</form>
-->
<form id="formAddNewRow" action="#" title="<?php echo $texts['agregar']; ?>">

        <input type="hidden" name="idParciales" id="idParciales" rel="0" />

        <label for="name"><?php echo $texts['materia']; ?></label>
        <br>
            <input type="text" name="nombre" id="nombre" rel="1" />
        <br>
        <label for="name"><?php echo $texts['col_nivel']; ?></label>
        <br>
        <select id="nivel" name="nivel"> 
            <?php
                while($row = mysqli_fetch_array($result)){    
                      echo "<option value='".$row['idNiveles']."'>".$row['nombre']."</option>";
                } 

            ?>
        </select>
        <br>
        <label for="teacher"><?php echo $texts['col_maestro']; ?></label>
        <br>
        <select id="teacher" name="teacher"> 
            <?php
                while($row2 = mysqli_fetch_array($result2)){    
                      echo "<option value='".$row2['idUsers']."'>".$row2['nombre']." ".$row2['apellidos']."</option>";
                } 

            ?>
        </select>
</form>
