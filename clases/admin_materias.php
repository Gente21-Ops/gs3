<?php
error_reporting(E_ALL);
include("logon.php");
include('../dict/admin/materias.php');

    ob_start();

    //TOP
    $breads = $texts['title'].'^admin_materias';
    include('top.php');
?>  
    
<!-- Main content -->
<div class="wrapper">


    <!-- 6 + 6 -->
    <div class="fluid">
    
        
        <!-- Table with opened toolbar -->
        <div class="widget grid6">
            <div class="whead"><h6><?php echo $texts['tabletitle']; ?></h6><div class="clear"></div></div>

            <ul class="tToolbar">
                <li id="btnAddNewRow"><a href="#" title=""><span class="icos-archive"></span><?php echo $texts['agregar_nuevo']; ?></a></li>
                <li id="btnDeleteRow"><a href="#" title=""><span class="icos-cross"></span><?php echo $texts['borrar_existente']; ?></a></li>
            </ul>

            <div id="dyn2" class="shownpars">

                <a class="tOptions act" title="Options"><img src="images/icons/options" alt="" /></a>
                <table cellpadding="0" cellspacing="0" border="0" class="dTable">
                <thead>
                <tr>
                    <th>ID</th>
                    <th><?php echo $texts['col_nombre']; ?></th>
                    
                    
                </tr>
                </thead>
                <tbody>
                </tbody>
                </table> 
            </div>
            <div class="clear"></div> 
        </div> 


        <!-- Table with opened toolbar -->
        <div class="widget grid6">
            <div class="whead"><h6><?php echo $texts['tabletitle']; ?></h6><div class="clear"></div></div>

            <ul class="tToolbar">
                <li id="btnAddNewRow"><a href="#" title=""><span class="icos-archive"></span><?php echo $texts['agregar_nuevo']; ?></a></li>
                <li id="btnDeleteRow"><a href="#" title=""><span class="icos-cross"></span><?php echo $texts['borrar_existente']; ?></a></li>
            </ul>

            <div id="dyn2" class="shownpars">

                <a class="tOptions act" title="Options"><img src="images/icons/options" alt="" /></a>
                <table cellpadding="0" cellspacing="0" border="0" class="dTable">
                <thead>
                <tr>
                    <th>ID</th>
                    <th><?php echo $texts['col_nombre']; ?></th>
                    <th><?php echo $texts['col_descripcion']; ?></th>
                    <th><?php echo $texts['col_abierto']; ?></th>
                    <th><?php echo $texts['col_limite_pago']; ?></th>
                    <th><?php echo $texts['col_esparcial']; ?></th>
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



<form id="formAddNewRow" action="#" title="<?php echo $texts['agregar']; ?>">

        <input type="hidden" name="idMaterias" id="idMaterias" rel="0" />
        <label for="name"><?php echo $texts['col_nombre']; ?></label><input type="text" name="nombre" id="nombre" rel="1" />
        
</form>

<form id="formAddNewRow" action="#" title="<?php echo $texts['agregar']; ?>">

        <input type="hidden" name="idParciales" id="idParciales" rel="0" />

        <label for="name"><th><?php echo $texts['col_nombrePar']; ?></th></label><input type="text" name="nombre" id="nombre" rel="1" />
        <br>
        <label for="name"><th><?php echo $texts['col_descripcionPar']; ?></th></label><input type="text" name="descripcion" id="descripcion" rel="2" />
        <br>
        <label for="name"><th><?php echo $texts['col_abiertoPar']; ?></th></label><br><br>
        
        <select name="abierto" id="abierto" rel="3">
         <option value="0">No</option>
         <option value="1">Si</option>
        </select><br><br>

        <label for="name"><th><?php echo $texts['col_limite_pago']; ?></th></label><input type="text" name="limite_pago" id="limite_pago" rel="4" />
        <br>
        <label for="name"><th><?php echo $texts['col_esparcial']; ?></th></label><br><br>
        <select name="esparcial" id="esparcial" rel="5">
         <option value="0">No</option>
         <option value="1">Si</option>
        </select><br><br>
</form>
