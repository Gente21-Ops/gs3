<?php 

error_reporting(E_ALL); 
ini_set( 'display_errors','1');

include('dict/sidebar_admin.php'); ?>

<!-- Sidebar begins -->
<div id="sidebar">
    <div class="mainNav">


        <div class="user">
            <a title="" class="leftUserDrop"><img id="elusero" src="images/users/72/<?php echo $_SESSION['code']; ?>.jpg" alt="" /><span><strong>3</strong></span></a><span><?php if (strlen($_SESSION['qnick']) < 2){ echo $_SESSION['nombre']; } else echo $_SESSION['qnick']; ?></span>

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

            <li><a href="#" onclick="assignme('students_msgs','content'); return false;" class="active linko" title=""><img src="images/icons/mainnav/messages.png" alt="" /><span>Mensajes</span></a></li>

            <!--
            <li><a href="#" onclick="assignme('admin_bancos','content'); return false;" class="linko" title=""><img src="images/icons/mainnav/banks.png" alt="" /><span>Pagos</span></a></li>
            -->

            <!-- FACT -->
            <li><a href="#" onclick="assignme('admin_gen_invoice','content'); return false;" class="linko" title=""><img src="images/icons/mainnav/banks.png" alt="" /><span>Pagos</span></a></li>

            <li><a href="#" onclick="assignme('admin_grupos','content'); return false;" title="" class="linko"><img src="images/icons/mainnav/groups.png" alt="" /><span>Grupos</span></a></li>

            <li><a href="#" onclick="assignme('admin_students_a','content'); return false;" title="" class="linko"><img src="images/icons/mainnav/students.png" alt="" /><span><?php echo $texts['lista']; ?></span></a></li>

            <li><a href="#" onclick="assignme('general_calendar','content'); return false;" title="" class="linko"><img src="images/icons/mainnav/calendar.png" alt="" /><span><?php echo $texts['calendario']; ?></span></a></li>
            
            <li><a href="#" onclick="assignme('admin_materias','content'); return false;" title="Chido" class="linko"><img src="images/icons/mainnav/subjects.png" alt="" /><span>Materias</span></a></li>
            
            <!--<li><a href="#" onclick="assignme('admin_students_a','content'); return false;" title="" class="linko"><img src="images/icons/mainnav/statistics.png" alt="" /><span><?php echo $texts['estadisticas']; ?></span></a></li>-->

            <!--<li><a href="#" onclick="assignme('admin_parents','content'); return false;" title="" class="linko"><img src="images/icons/mainnav/family.png" alt="" /><span>Familiares</span></a></li>-->

            <li><a href="#" onclick="assignme('admin_admon','content'); return false;" title="" class="linko"><img src="images/icons/mainnav/admins.png" alt="" /><span>Administrativos</span></a></li>

            <li><a href="#" onclick="assignme('admin_teachers','content'); return false;" title="" class="linko"><img src="images/icons/mainnav/professor.png" alt="" /><span>Profesores</span></a></li>
            
            <li><a href="#" onclick="assignme('admin_data','content'); return false;" title="" class="linko"><img src="images/icons/mainnav/statistics.png" alt="" /><span><?php echo $texts['statistics']; ?></span></a></li>

            <li><a href="#" onclick="assignme('students_config','content'); return false;" title="" class="linko"><img src="images/icons/mainnav/config.png" alt="" /><span><?php echo $texts['configuracion']; ?></span></a></li>            

        </ul>
    </div>
    
    <!-- LA BARRA DE COM SOLO DEBERÍA DE APARECER CUANDO ES CHROME O FF -->
    <?php
        //HIDEBAR
        require_once('com.php');
        
    ?>

    

</div>
<!-- Sidebar ends -->