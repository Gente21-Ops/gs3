<?php
error_reporting(E_ALL);
include("logon.php");
include('../dict/students_homework.php');

//this page's controler
include('student/students_homework_do.php');

    ob_start();
    require_once('connection.php');
    mysql_query('SET CHARACTER SET utf8');
    mysql_query('SET NAMES "utf8"');

    //TOP
    $breads = $texts['title'].'^students_homework_do';
    include('top.php');

    $files = $con->query("SELECT name, patho FROM files WHERE code = '".$_GET['qcode']."'");
?>

<div id="deldialog" style="display:none;"><strong><?php echo $texts['deldialog']; ?></strong></div>
<div id="deltitle" style="display:none;"><?php echo $texts['deltitle']; ?></div>
<div id="qlango" style="display:none;"><?php echo $_SESSION['qlen']; ?></div>
<div id="qcodetareas" style="display:none;"><?php echo $_GET['qcode']; ?></div>
<div id="qnick" style="display:none;"><?php echo $_SESSION['qnick']; ?></div>
<div id="qusercode" style="display:none;"><?php echo $_SESSION['code']; ?></div>
<div id="qansweredtime" style="display:none;">SE ACABA DE RESPONDER</div>
<div id="qdoc" style="display:none;">SE ACABA DE RESPONDER</div>
<div id="qcodeschool" style="display:none;"><?php echo $_SESSION['qescuelacode']; ?></div>
    
    <!-- Main content -->
    <div class="wrapper">
    
        <!-- 6 + 6 -->
        <div class="fluid">        
            
            <!-- Table with opened toolbar -->
            <div class="widget grid12">
                <div class="whead"><h6><?php echo $texts['detalles_tarea']; ?></h6><div class="clear"></div></div>
                <div class="body">
                    <h1 class="pt10"><?php echo $row['qnombre'] ?></h1>
                    <p><?php echo $row['descripcion'] ?></p>
                    

                    <ul class="messagesOne" id="larespuesta">
                        <?php if (strlen($row['qanswer'])>2){ ?>
                        <li class="by_user">
                            <a href="#" title=""><img src="images/users/37/<?php echo $_SESSION['code']; ?>.jpg" alt=""></a>

                            <div class="messageArea">
                                <span class="aro"></span>
                                <div class="infoRow">
                                    <span class="name">Respuesta de <strong><?php echo $_SESSION['qnick']; ?></strong></span>
                                    <span class="time"><?php echo $row['qanswered']; ?></span>
                                    <div class="clear"></div>
                                </div>
                                <?php echo $row['qanswer']; ?>
                            </div>
                            <div class="clear"></div>
                        </li>
                        <?php } ?>
                    </ul>
                    

                    <div class="clear"></div>

                    <ul class="middleFree">
                        <li>
                            <button class="buttonM bLightBlue floatL" id="simpleanswer"><span class="icol-pencil"></span><span><?php echo $texts['mod_tarea']; ?></span></button>
                        </li>
                        <!--<li>
                            <button class="buttonM bLightBlue floatL" id="newpad"><span class="icol-word"></span><span><?php echo $texts['generar_doc_compartido']; ?></span></button>
                        </li>-->
                        
                        <!--
                        <li><input type="submit" class="buttonS bLightBlue" value="RESPUESTA SIMPLE" /></li>
                        <li><input type="submit" class="buttonS bLightBlue" value="GENERAR O EDITAR DOCUMENTO COMPARTIDO" /></li>
                        -->
                    </ul>
                </div>                
                
            </div> 

        </div>



        <!-- List styles -->
        <div class="fluid">

            <div class="grid6">
                <div class="widget">
                    <div class="whead"><h6><?php echo $texts['archivos_apoyo']; ?></h6><div class="clear"></div></div>
                    <div class="body">
                        <ul class="liInfo">
                            <?php
                                while($rowFiles = mysqli_fetch_array($files)){
                                    echo '<li><a href="files/'.$_SESSION['qescuelacode'].'/'.$rowFiles['patho'].'" target="_blank">'.$rowFiles['name'].'</a></li>';
                                }   
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        
            <div class="grid6">
                <div class="widget">
                    <div class="whead"><h6><?php echo $texts['subir_archivos']; ?></h6><div class="clear"></div></div>
                    <div class="body">

                        <div class="dropFiles<?php if ($_SESSION['qlen'] == 'es'){ echo "_es"; } else if ($_SESSION['qlen'] == 'fr'){ echo "_fr"; } ?>" id="jalo" class="margin-bottom:10px;"></div>
                        
                        <!-- FILE UPLOADING STUFF -->
                        <ul id="filelist" class="filesDown">


                            <?php 
                                //already uploaded files
                            
                                $fid = 0;
                                $html1 = '';
                                
                                while($rowf = mysqli_fetch_array($resultf)){
                                    $newname = str_replace('_', ' ', $rowf['name']);

                                    $html1 .= '<li class="currentFile" id="'.$fid.'">';
                                    $html1 .='<span class="fileSuccess"></span>'.$newname.' <span class="righto">';
                                    $html1 .='<a href="files/'.$_SESSION['qescuelacode'].'/'.$rowf['patho'].'" data-namo="'.$rowf['name'].'" id="prev_'.$fid.'" target="_blank"><span class="icos-inbox" style="padding:0; margin-right:10px;"></span></a> ';
                                    $html1 .='<a href="#" id="delo_'.$fid.'"><span class="icos-trash" style="padding:0; margin-right:0px;"></span></a></span>';
                                    $html1 .='</li>';
                                    $fid += 1;
                                }

                                echo $html1;

                                while($rowf = mysqli_fetch_array($resultf)){
                                    echo $rowf['name']."<br>";
                                }   
                            
                            ?>

                        </ul>
                        
                        <div id="container" style="margin-top:10px;">
                            <a href="#" class="buttonM bLightBlue" id="browse"><span class="icon-camera"></span><span><?php echo $texts['browse_files']; ?></span></a>
                        </div>

                        <pre id="console"></pre>

                    </div>
                </div>
            </div>
        
        </div>


        <!-- 6 + 6 -->
        <div class="fluid">       
            
            <!-- Table with opened toolbar 
            <div class="widget grid12">
                <div class="whead"><h6><?php echo $texts['detalle_tarea']; ?></h6><div class="clear"></div></div>
                <div class="body">
                    <div class="formRow">
                        <label>List of assets:</label>
                        <div class="clear"></div>
                    </div>
                    <div class="formRow">
                        <input type="submit" class="buttonS bBlue" value="COMPLETAR TAREA" />
                    </div>
                </div>
            </div> -->

        </div>

        
        
    </div>
    <!-- Main content ends -->

<!-- Content ends -->


<!-- RESPONSE -->
<div id="mod_wys" title="Respuesta a la tarea">
    <textarea id="editor" name="editor" placeholder="Escribe aquí tu respuesta">
        <?php echo $row['qanswer']; ?>
    </textarea>
</div>


<!-- PAD -->
<div id="mod_pad" title="Nuevo documento compartido">
    <div class="formRow" id="pcreate1st" style="padding-top:0px;">
        <label>Da un nombre al documento, si usas un nombre que ya existe, se abrirá el documento que existía anteriormente</label>
        <input type="hidden" value="<?php echo $row['qnombre'] ?>" id="qpadtext">
        <input type="text" id="qpadname" value="<?php echo $row['qnombre'] ?>" placeholder="Nombre del documento" />
    </div>
</div>

<!-- FILE DELETING -->
<div id="mod_del" title="Borrar archivo">
    <div class="formRow" id="deltexto" style="padding-top:0px;">
        File
    </div>
</div>  
