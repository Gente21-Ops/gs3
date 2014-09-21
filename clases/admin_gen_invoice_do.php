<?php
error_reporting(E_ALL);
include("logon.php");
include('../dict/admin_gen_invoice_do.php');

    ob_start();
    require_once('connection.php');
    mysql_query('SET CHARACTER SET utf8');
    mysql_query('SET NAMES "utf8"');

    //TOP
    $breads = $texts['title'].'^students_config';
    include('top.php');

    //locales para calendario
    if ($_SESSION['qlen'] == 'es'){
        echo '<script src="http://jquery-ui.googlecode.com/svn/tags/latest/ui/i18n/jquery.ui.datepicker-es.js"></script>';
    } else if ($_SESSION['qlen'] == 'fr'){
        echo '<script src="http://jquery-ui.googlecode.com/svn/tags/latest/ui/i18n/jquery.ui.datepicker-fr.js"></script>';
    } else {
        echo '<script src="http://jquery-ui.googlecode.com/svn/tags/latest/ui/i18n/jquery.ui.datepicker-en-GB.js"></script>';
    }

    //aqui obtenemos los datos del usuario a quien se factura
    include("admin/checkfiscal.php");
    include("admin/checkfees.php"); 

    //vars fees
    $c_prix = $rowx['colegiatura_costo'];
    $c_disc = $rowx['colegiatura_desc_prontopago'];
    $c_limit = intval($rowx['colegiatura_dia_limite']);
    $c_late = intval($rowx['colegiatura_recargo']);

    //string de datos del emisor
    $c_emi = $rowx['f_moneda'].'~';
    $c_emi .= $rowx['f_lugarexp'].'~';
    $c_emi .= $rowx['f_em_nombre'].'~';
    $c_emi .= $rowx['f_em_rfc'].'~';
    $c_emi .= $rowx['f_em_calle'].'~';
    $c_emi .= $rowx['f_em_noext'].'~';
    $c_emi .= $rowx['f_em_col'].'~';
    $c_emi .= $rowx['f_em_loc'].'~';
    $c_emi .= $rowx['f_em_referencia'].'~';
    $c_emi .= $rowx['f_em_municipio'].'~';
    $c_emi .= $rowx['f_em_estado'].'~';
    $c_emi .= $rowx['f_em_pais'].'~';
    $c_emi .= $rowx['f_em_cp'].'~';
    $c_emi .= $rowx['f_em_regimen'];

    //string datos del receptor
    $c_rec = $userfiscal['name'].'~';
    $c_rec .= $userfiscal['dom_rfc'].'~';
    $c_rec .= $userfiscal['dom_calle'].'~';
    $c_rec .= $userfiscal['dom_ext'].'~';
    $c_rec .= $userfiscal['dom_col'].'~';
    $c_rec .= $userfiscal['dom_loc'].'~';
    $c_rec .= $userfiscal['dom_mun'].'~';
    $c_rec .= $userfiscal['dom_ref'].'~';
    $c_rec .= $userfiscal['dom_estado'].'~';
    $c_rec .= $userfiscal['dom_pais'].'~';
    $c_rec .= $userfiscal['dom_cp'].'~';
    $c_rec .= $userfiscal['_id'];

    //echo " EL ID ES: ".$userfiscal['_id']." <br>";

    //calcula recargos (nose usa a menos que sea por eun mes anterior que no se pagó)
    function recarga($cant){
        //echo "RECARGA!!!";
        global $c_late;
        global $c_limit;
        $ladat = date('j');
        //checamos que el día sea superior al limite
        if ($ladat > $c_limit){
            if ($c_late != 0){
                $pre = ($cant * $c_late) / 100;
                return round( $pre, 2 );
            } else {
                return $cant;
            }            
        } else {
            return 0;
        }
    }

    //calcula descuentos (porpronto pago)
    function disco($cant){
        global $c_disc;
        $ladat = date('j');
        global $c_limit;
        if ($ladat > $c_limit){
            if ($c_disc != 0){
                $pre = (($cant * $c_disc) / 100) - $cant;
                return round( $pre , 2 );
            } else {
                return $cant;
            }
        } else {
            return $cant;
        }
    }

    //calcula descuentos por beca
    function becas($cant){
        global $userfiscal;
        if (intval($userfiscal['beca']) > 0){
            $pre = ($cant * intval($userfiscal['beca'])) / 100;
            return round( $pre , 2 );
        } else {
            return $cant;
        }
    }

    //month translator
    function mtom($num){
        $mes = array('enero','febrero','marzo','abril','mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre');
        return $mes[intval($num - 1)];
    }

    function totol($cant,$costo,$recargo,$beca){
        //para calcular el total es: catidad*(costo + recargo - beca)
        return round($cant * ( $costo + $recargo - $beca ), 2);
    }

?>


<script src="js/jquery.printElement.min.js" type="text/javascript"></script>
<!--<script src="js/jquery.base64.min.js" type="text/javascript"></script>-->
     
  

    <div id="qcode" style="display:none;"><?php echo $_GET['qcode']; ?></div>
    <div id="qlang" style="display:none;"><?php echo $_SESSION['qlen']; ?></div>
    <div id="qimgchanged" style="display:none;"><?php echo $texts['imgchanged']; ?></div>
    <div id="qerror" style="display:none;"><?php echo $texts['savederror']; ?></div>
    <div style="display:none;" id="quser"><?php echo $_SESSION['code']; ?></div>

    <!-- PHOLDERS -->
    <div id="p_desc" style="display:none;"><?php echo $texts['i_desc'] ?></div>
    <div id="p_cant" style="display:none;"><?php echo $texts['i_cant'] ?></div>
    <div id="p_uni" style="display:none;"><?php echo $texts['i_uni'] ?></div>
    <div id="p_late" style="display:none;"><?php echo $texts['i_late'] ?></div>
    <div id="p_disc" style="display:none;"><?php echo $texts['i_disc'] ?></div>
    <div id="p_prix" style="display:none;"><?php echo $texts['i_prix'] ?></div>
    <div id="p_kill" style="display:none;"><?php echo $texts['i_kill'] ?></div>

    <!-- EMI/REC --> 
    <div id="p_emi" style="display:none;"><?php echo base64_encode($c_emi); ?></div>
    <div id="p_rec" style="display:none;"><?php echo base64_encode($c_rec); ?></div>
    
    <!-- Main content -->
    <div class="wrapper">

        <?php 

            if (sizeof($userfiscal) < 1){
                echo '<div class="nNote nWarning"><p>'.$texts['newnotice'].'</p></div>';
            }

        ?>
   
        <!-- 6 + 6 -->
        <form action="" class="main">
            <fieldset>
                <div class="widget fluid">
                    <div class="whead"><h6><?php echo $texts['tabletitle']; ?></h6><div class="clear"></div></div>
                    <div class="formRow fluid">
                        <span class="grid6"><input type="text" id="name" value="<?php echo $userfiscal['name']; ?>" placeholder="<?php echo $texts['dom_apellidos'] ?>" /></span>
                        <span class="grid4"><input type="text" id="dom_rfc" value="<?php echo $userfiscal['dom_rfc']; ?>" placeholder="<?php echo $texts['dom_rfc'] ?>" /></span>
                        <span class="grid2"><input type="text" id="beca" value="<?php if (intval($userfiscal['beca']) > 0) { echo $userfiscal['beca']; }  else { echo "0"; } ?>" placeholder="<?php echo $texts['beca'] ?>" class="maskPct" title="Porcentaje de beca asignado al alumno" /></span>
                        <div class="clear"></div>
                    </div>
                    <div class="formRow fluid">
                        <span class="grid4"><input type="text" id="dom_calle" value="<?php echo $userfiscal['dom_calle']; ?>" placeholder="<?php echo $texts['dom_calle'] ?>" /></span>
                        <span class="grid4"><input type="text" id="dom_ext" value="<?php echo $userfiscal['dom_ext']; ?>" placeholder="<?php echo $texts['dom_ext'] ?>" /></span>
                        <span class="grid4"><input type="text" id="dom_col" value="<?php echo $userfiscal['dom_col']; ?>" placeholder="<?php echo $texts['dom_col'] ?>" /></span>
                        <div class="clear"></div>
                    </div>
                    <div class="formRow fluid">
                        <span class="grid4"><input type="text" id="dom_loc" value="<?php echo $userfiscal['dom_loc']; ?>" placeholder="<?php echo $texts['dom_loc'] ?>" /></span>
                        <span class="grid4"><input type="text" id="dom_mun" value="<?php echo $userfiscal['dom_mun']; ?>" placeholder="<?php echo $texts['dom_mun'] ?>" /></span>
                        <span class="grid4"><input type="text" id="dom_ref" value="<?php echo $userfiscal['dom_ref']; ?>" placeholder="<?php echo $texts['dom_ref'] ?>" /></span>
                        <div class="clear"></div>
                    </div>
                    <div class="formRow fluid">
                        <span class="grid4"><input type="text" id="dom_estado" value="<?php echo $userfiscal['dom_estado']; ?>" placeholder="<?php echo $texts['dom_estado'] ?>" /></span>
                        <span class="grid4"><input type="text" id="dom_pais" value="<?php echo $userfiscal['dom_pais']; ?>" placeholder="<?php echo $texts['dom_pais'] ?>" /></span>
                        <span class="grid4"><input type="text" id="dom_cp" value="<?php echo $userfiscal['dom_cp']; ?>" placeholder="<?php echo $texts['dom_cp'] ?>" /></span>
                        <div class="clear"></div>
                    </div>

                    <div class="formRow fluid">
                        <div class="grid4">
                            <input type="submit" id="sendo" class="buttonM bBlue" value="<?php echo $texts['guardar']; ?>" />
                        </div>
                        <div class="grid8">
                            <span class="note"><?php echo $texts['guardar_notice'] ?></span>
                        </div>
                        <div class="clear"></div>
                    </div>

                </div>
            </fieldset>


            <div class="divider"><span></span></div>


            <fieldset>
                <div class="widget fluid" id="itemos">
                    <div class="whead">
                        <h6><?php echo $texts['tableitemos']; ?></h6>


                        <div class="titleOpt">
                            <a href="#" data-toggle="dropdown" onclick="additemo('');"><span class="icos-add"></span><span class="clear"></span></a>
                        </div>


                        <div class="clear"></div>
                    </div>

                    <!--ITEMS CONT-->
                    <div id="icont">

                        <div class="formRow fluid" id="itemo_0" data-index="0">
                            <span class="grid4">
                                <span class="note" id="limitingtext">Descripción</span>
                                <input type="text" id="i_0_desc" data-enco="<?php echo base64_encode($texts['def_desc'].mtom($_GET['m']).' '.$_GET['y']); ?>" value="<?php echo $texts['def_desc'].mtom($_GET['m']).' '.$_GET['y']; ?>" placeholder="<?php echo $texts['i_desc'] ?>"  class="tipS" onblur="revdesc('0');" />
                            </span>
                            
                            <span class="grid1">
                                <span class="note" id="limitingtext">Cantidad</span>
                                <input type="text" id="i_0_cant" value="1" placeholder="<?php echo $texts['def_cant'] ?>" onblur="revalo('0');" />
                            </span>
                            
                            <span class="grid2">
                                <span class="note" id="limitingtext">Costo</span>
                                <input type="text" id="i_0_uni" value="<?php echo $c_prix; ?>" placeholder="<?php echo $texts['i_uni'] ?>" onblur="revalo('0');" />
                            </span>

                            <span class="grid1">
                                <span class="note" id="limitingtext">Recargo</span>
                                <input type="text" id="i_0_late" value="<?php echo recarga($c_prix); ?>" placeholder="<?php echo $texts['i_late'] ?>" title="Recargo <?php echo $c_late; ?>%" onblur="revalo('0');" />
                            </span>

                            <span class="grid1">
                                <span class="note" id="limitingtext">Beca</span>
                                <input type="text" id="i_0_beca" value="<?php echo becas($c_prix); ?>" placeholder="<?php echo $texts['i_disc'] ?>" title="Beca <?php echo $userfiscal['beca']."%"; ?>" onblur="revalo('0');" />
                            </span>

                            <span class="grid2">
                                <span class="note" id="limitingtext">Total</span>
                                <input type="text" id="i_0_prix" value="<?php  echo totol(1,$c_prix,recarga($c_prix),becas($c_prix)); ?>" placeholder="<?php echo $texts['i_prix'] ?>"  disabled />
                            </span>

                            <span class="grid1">
                                <span class="note" id="limitingtext">&nbsp;</span>
                                
                                <td class="tableActs" align="center">
                                    <a href="javascript:void(0);" class="tablectrl_small bDefault tipS" onclick="killitemo('0');" title="<?php echo $texts['i_kill'] ?>"><span class="iconb" data-icon="&#xe136;"></span></a>
                                </td>
                            </span>

                        </div>

                    </div>


                    <div class="formRow fluid">
                        <div class="grid4">
                            <input type="submit" id="sendof" class="buttonS bGreen" value="<?php echo $texts['guardarf']; ?>" />
                        </div>
                        <div class="grid8">
                            <span style="float:right; text-align:right;" id="telltotal"><strong>0.00</strong></span>
                        </div>
                        <div class="clear"></div>
                    </div>


                </div>
            </fieldset>
        

        </form>
        
        
    </div>
    <!-- Main content ends -->

<div style="display:none; font-weight:bold;" id="savedo"><?php echo $texts['saved']; ?></div>



<form id="formWait" action="#" title="<?php echo $texts['w_title']; ?>">

    <input type="hidden" name="idStudents" id="idStudents" rel="0" />

    <div class="formRow fluid">
        <div class="grid12" id="waitInner">
            <div align="center">
                <img src="images/elements/loaders/10.gif" alt="">
                <br>
                Se está generando la factura digital, espere un momento por favor...
            </div>
            
        </div>
    </div>

</form> 


<!-- F
<div class="pager" id="efo" style="display:none">
    
    <div class="headero">
        <div class="headerol roundo">
                <?php echo $userfiscal['name']; ?>  - RFC: <?php echo $userfiscal['dom_rfc']; ?>
            <br>
                DOMICILIO: <?php echo $userfiscal['dom_calle']; ?> <?php echo $userfiscal['dom_ext']; ?> - <?php echo $userfiscal['dom_col']; ?>
            <br>
                <?php echo $userfiscal['dom_loc']; ?> <?php echo $userfiscal['dom_mun']; ?>
            <br>
                <?php echo $userfiscal['dom_estado']; ?> <?php echo $userfiscal['dom_pais']; ?> <?php echo $userfiscal['dom_cp']; ?>
        </div>
        <div class="headeror roundo">
            Datos relativos a la factura
        </div>
    </div>

    <div class="clear"></div>

    <div class="bodo roundo" id="elbodo">
        <h3>CONCEPTOS</h3>
        <div class="fitemo">
            <div class="fitemo1"><strong>DESCRIPCIÓN</strong></div>
            <div class="fitemo2"><strong>C.</strong></div>
            <div class="fitemo3"><strong>P. UNITARIO</strong></div>
            <div class="fitemo4"><strong>P. TOTAL</strong></div>
        </div>
        <div class="clear2"></div>

        <br>
    </div>

    <div class="clear"></div>

    <div class="footo roundo">
        footo
    </div>


</div> -->