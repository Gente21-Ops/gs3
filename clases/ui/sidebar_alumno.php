<?php include('dict/sidebar_alumno.php'); ?>

<!-- Sidebar begins -->
<div id="sidebar">
    <div class="mainNav">


        <div class="user">
            <a title="" class="leftUserDrop"><img id="elusero" original-title="<img src='images/users/320/<?php echo $_SESSION['code']; ?>.jpg?r=<?php echo rand(0,100); ?>' style='width:200px; height:200px;'>" src="images/users/72/<?php echo $_SESSION['code']; ?>.jpg" alt="" /><span><strong>3</strong></span></a><span><?php if (strlen($_SESSION['qnick']) < 2){ echo $_SESSION['nombre']; } else echo $_SESSION['qnick']; ?></span>

            <!--
            <ul class="leftUser">
                <li><a href="#" title="" class="sProfile">My profile</a></li>
                <li><a href="#" title="" class="sMessages">Messages</a></li>
                <li><a href="#" title="" class="sSettings">Settings</a></li>
                <li><a href="#" title="" class="sLogout">Logout</a></li>
            </ul>
        -->
        </div>
        
        <!-- Responsive nav
        <div class="altNav">
            <div class="userSearch">
                <form action="">
                    <input type="text" placeholder="search..." name="userSearch" />
                    <input type="submit" value="" />
                </form>
            </div>
            
            <ul class="userNav">
                <li><a href="#" title="" class="profile"></a></li>
                <li><a href="#" title="" class="messages"></a></li>
                <li><a href="#" title="" class="settings"></a></li>
                <li><a href="#" title="" class="logout"></a></li>
            </ul>
        </div>
         -->
        
        <!-- Main nav -->
        <ul class="nav" id="navo"> 

            <li><a href="#" onclick="assignme('students_msgs','content'); return false;" class="active linko" title=""><img src="images/icons/mainnav/messages.png" alt="" /><span><?php echo $texts['mensajes']; ?></span></a></li>

            <li><a href="#" onclick="assignme('students_homework','content'); return false;" title="" class="linko"><img src="images/icons/mainnav/homework.png" alt="" /><span><?php echo $texts['tareas']; ?></span></a></li>

            <li><a href="#" onclick="assignme('general_calendar','content'); return false;" title="" class="linko"><img src="images/icons/mainnav/calendar.png" alt="" /><span><?php echo $texts['calendario']; ?></span></a></li>
            
            <li><a href="#" onclick="assignme('students_files','content'); return false;" title="Chido" class="linko"><img src="images/icons/mainnav/files.png" alt="" /><span><?php echo $texts['documentos']; ?></span></a></li>
            
            <li><a href="#" onclick="assignme('students_faltas','content'); return false;" title="" class="linko"><img src="images/icons/mainnav/statistics.png" alt="" /><span><?php echo $texts['estadisticas']; ?></span></a></li>

            <li><a href="#" onclick="assignme('students_config','content'); return false;" title="" class="linko"><img src="images/icons/mainnav/config.png" alt="" /><span><?php echo $texts['configuracion']; ?></span></a></li>            
            
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