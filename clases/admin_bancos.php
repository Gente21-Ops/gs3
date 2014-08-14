<?php
error_reporting(E_ALL);
include("logon.php");
include('../dict/admin/bancos.php');

    ob_start();

    //TOP
    $breads = $texts['title'].'^admin_bancos';
    include('top.php');
?>  


<div id="deldialog" style="display:none;"><strong><?php echo $texts['deldialog']; ?></strong></div>
<div id="deltitle" style="display:none;"><?php echo $texts['deltitle']; ?></div>
<div id="qlango" style="display:none;"><?php echo $_SESSION['qlen']; ?></div>


    <!-- Main content -->
    <div class="wrapper">

    
        <!-- 6 + 6 -->
        <div class="fluid">
        
            
            <!-- BANCOS -->
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
                        <th><?php echo $texts['col_proveedor']; ?></th>

                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    </table> 
                </div>
                <div class="clear"></div> 
            </div> 


            <!-- DESCUENTOS -->
            <div class="widget grid6">
                <div class="whead"><h6><?php echo $texts['tabletitleDcto']; ?></h6><div class="clear"></div></div>

                <ul class="tToolbar">
                    <li id="btnAddNewRow"><a href="#" title=""><span class="icos-archive"></span><?php echo $texts['agregar_nuevoDcto']; ?></a></li>
                    <li id="btnDeleteRow"><a href="#" title=""><span class="icos-cross"></span><?php echo $texts['borrar_existenteDcto']; ?></a></li>
                </ul>

                <div id="dyn2" class="shownpars">

                    <a class="tOptions act" title="Options"><img src="images/icons/options" alt="" /></a>
                    <table cellpadding="0" cellspacing="0" border="0" class="dTableDctos">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th><?php echo $texts['col_nombre']; ?></th>
                        <th><?php echo $texts['col_porciento']; ?></th>
                        <th><?php echo $texts['col_recurrente']; ?></th>
                        <th><?php echo $texts['col_idParciales']; ?></th>
                        
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

        <input type="hidden" name="idBancos" id="idBancos" rel="0" />

        <label for="name"><?php echo $texts['col_nombre']; ?></label><input type="text" name="nombre" id="nombre" rel="1" />
        <br>
        <label for="name"><?php echo $texts['col_proveedor']; ?></label><br><br>
        <select name="proveedor" id="proveedor" rel="2">
         <option value="banco">Banco</option>
         <option value="DineroMail">DineroMail</option>
         <option value="Paypal">Paypal</option>
         <option value="escuela">Escuela</option>
        </select>
        
</form>


<form id="formAddNewRow" action="#" title="<?php echo $texts['agregarDcto']; ?>">

        <input type="hidden" name="idDescuentos" id="idDescuentos" rel="0" />

        <label for="name"><?php echo $texts['col_nombre']; ?></label><input type="text" name="name" id="name" class="required" rel="1" />
        <br>
        <label for="name"><?php echo $texts['col_porciento']; ?></label><input type="text" name="percent" id="percent" rel="2" />
        <br>
        <label for="name"><?php echo $texts['col_recurrente']; ?></label><br><br>
        <select name="recurrent" id="recurrent" rel="3">
         <option value="0">No</option>
         <option value="1">Si</option>
        </select><br><br>
        <label for="name"><?php echo $texts['col_idParciales']; ?></label><input type="text" name="idParciales" id="idParciales" rel="4" />
        
</form>