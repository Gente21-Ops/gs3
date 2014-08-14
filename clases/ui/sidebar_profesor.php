<?php include('dict/sidebar_profesor.php'); ?>

<!-- Sidebar begins -->
<div id="sidebar">
    <div class="mainNav">


        <div class="user">
            <a title="" class="leftUserDrop"><img id="elusero" original-title="<img src='images/users/320/<?php echo $_SESSION['code']; ?>.jpg?r=<?php echo rand(0,100); ?>' style='width:200px; height:200px;'>" src="images/users/72/<?php echo $_SESSION['code']; ?>.jpg" alt="" /><span><strong>3</strong></span></a><span><?php if (strlen($_SESSION['qnick']) < 2){ echo $_SESSION['nombre']; } else echo $_SESSION['qnick']; ?></span>

          
        </div>
        

        
        <!-- Main nav -->
        <ul class="nav" id="navo"> 

            <li><a href="#" onclick="assignme('students_msgs','content'); return false;" class="active linko" title=""><img src="images/icons/mainnav/messages.png" alt="" /><span><?php echo $texts['mensajes']; ?></span></a></li>

            
            <!-- LISTA DE GRUPOS Y DE MATERIAS -->

            <li><a href="#" onclick="assignme('profesor_grupos','content'); return false;" title="" class="linko"><img src="images/icons/mainnav/groups.png" alt="" /><span><?php echo $texts['gruposmat']; ?></span></a></li>


            <li><a href="#" onclick="assignme('general_calendar','content'); return false;" title="" class="linko"><img src="images/icons/mainnav/calendar.png" alt="" /><span><?php echo $texts['calendario']; ?></span></a></li>
            
            <li><a href="#" onclick="assignme('students_files','content'); return false;" title="Chido" class="linko"><img src="images/icons/mainnav/files.png" alt="" /><span><?php echo $texts['documentos']; ?></span></a></li>    

            <li><a href="#" onclick="assignme('profesor_config','content'); return false;" title="" class="linko"><img src="images/icons/mainnav/config.png" alt="" /><span><?php echo $texts['configuracion']; ?></span></a></li>            
            
        </ul>
    </div>
    
    <!-- LA BARRA DE COM SOLO DEBERÍA DE APARECER CUANDO ES CHROME O FF -->
    <?php
        //HIDEBAR
        error_reporting(0);
        require_once('com.php');
        error_reporting(1);
    ?>

    

</div>
<!-- Sidebar ends -->