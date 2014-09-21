<?php
error_reporting(E_ALL);
include("logon.php");
include('../dict/admin/grupos.php');

    ob_start();

    //TOP
    $breads = $texts['title'].'^admin_grupos';
    include('top.php');
?>  
<script type="text/javascript" src="js/plugins/ui/jquery.jgrowl.js"></script>

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


    </div>

       

    
    
    
</div>
<!-- Main content ends -->



<form id="formAddNewRow" action="#" title="<?php echo $texts['agregar']; ?>">

        <input type="hidden" name="idGrupos" id="idGrupos" rel="0" />

        <label for="name"><?php echo $texts['col_nombre']; ?></label><input type="text" name="nombre" id="nombre" rel="1" />
        
</form>


