<?php
header('Access-Control-Allow-Origin: http://107.22.250.130');
header('Access-Control-Allow-Credentials: true');
?>
<!-- Sidebar begins -->
<div id="sidebar">
    <div class="mainNav">
        <div class="user">
            <a title="" class="leftUserDrop"><img src="images/users/72/<?php echo $_SESSION['code']; ?>.png" alt="" /><span><strong>3</strong></span></a><span><?php echo $_SESSION['nombre']; ?></span>
            <ul class="leftUser">
                <li><a href="#" title="" class="sProfile">My profile</a></li>
                <li><a href="#" title="" class="sMessages">Messages</a></li>
                <li><a href="#" title="" class="sSettings">Settings</a></li>
                <li><a href="#" title="" class="sLogout">Logout</a></li>
            </ul>
        </div>
        
        <!-- Responsive nav -->
        <div class="altNav">
            <div class="userSearch">
                <form action="">
                    <input type="text" placeholder="search..." name="userSearch" />
                    <input type="submit" value="" />
                </form>
            </div>
            
            <!-- User nav -->
            <ul class="userNav">
                <li><a href="#" title="" class="profile"></a></li>
                <li><a href="#" title="" class="messages"></a></li>
                <li><a href="#" title="" class="settings"></a></li>
                <li><a href="#" title="" class="logout"></a></li>
            </ul>
        </div>
        
        <!-- Main nav -->
        <ul class="nav">
            <li><a href="index.html" title="" class="active"><img src="images/icons/mainnav/dashboard.png" alt="" /><span>Dashboard</span></a></li>
            <!--
            <li><a href="#" data-location="t2.html" title="Chido"><img src="images/icons/mainnav/ui.png" alt="" /><span>UI elements</span></a>
            -->
            <li><a href="t2" title="TITULO PEDO"><img src="images/icons/mainnav/ui.png" alt="" /><span>UI elements</span></a>
                <ul>
                    <li><a href="ui.html" title=""><span class="icol-fullscreen"></span>General elements</a></li>
                    <li><a href="ui_icons.html" title=""><span class="icol-images2"></span>Icons</a></li>
                    <li><a href="ui_buttons.html" title=""><span class="icol-coverflow"></span>Button sets</a></li>
                    <li><a href="ui_grid.html" title=""><span class="icol-view"></span>Grid</a></li>
                    <li><a href="ui_experimental.html" title=""><span class="icol-beta"></span>Experimental</a></li>
                </ul>
            </li>
            <!--
            <li><a href="#" data-location="t3.html" title=""><img src="images/icons/mainnav/forms.png" alt="" /><span>Forms stuff</span></a>
            -->
            <li><a href="admin_students_a" title="LISTA DE ALUMNOS" data-js="admin/admin_students_a.js"><img src="images/icons/mainnav/forms.png" alt="" /><span>Forms stuff</span></a>
                <ul>
                    <li><a href="forms.html" title=""><span class="icol-list"></span>Inputs &amp; elements</a></li>
                    <li><a href="form_validation.html" title=""><span class="icol-alert"></span>Validation</a></li>
                    <li><a href="form_editor.html" title=""><span class="icol-pencil"></span>File uploader &amp; WYSIWYG</a></li>
                    <li><a href="form_wizards.html" title=""><span class="icol-signpost"></span>Form wizards</a></li>
                </ul>
            </li>
            <li><a href="messages.html" title=""><img src="images/icons/mainnav/messages.png" alt="" /><span>Messages</span></a></li>
            <li><a href="statistics.html" title=""><img src="images/icons/mainnav/statistics.png" alt="" /><span>Statistics</span></a></li>
            <li><a href="tables.html" title=""><img src="images/icons/mainnav/tables.png" alt="" /><span>Tables</span></a>
                <ul>
                    <li><a href="tables.html" title=""><span class="icol-frames"></span>Standard tables</a></li>
                    <li><a href="tables_dynamic.html" title=""><span class="icol-refresh"></span>Dynamic table</a></li>
                    <li><a href="tables_control.html" title=""><span class="icol-bullseye"></span>Tables with control</a></li>
                    <li><a href="tables_sortable.html" title=""><span class="icol-transfer"></span>Sortable and resizable</a></li>
                </ul>
            </li>
            <li><a href="other_calendar.html" title=""><img src="images/icons/mainnav/other.png" alt="" /><span>Other pages</span></a>
                <ul>
                    <li><a href="other_calendar.html" title=""><span class="icol-dcalendar"></span>Calendar</a></li>
                    <li><a href="other_gallery.html" title=""><span class="icol-images2"></span>Images gallery</a></li>
                    <li><a href="other_file_manager.html" title=""><span class="icol-files"></span>File manager</a></li>
                    <li><a href="#" title="" class="exp"><span class="icol-alert"></span>Error pages <span class="dataNumRed">6</span></a>
                        <ul>
                            <li><a href="other_403.html" title="">403 error</a></li>
                            <li><a href="other_404.html" title="">404 error</a></li>
                            <li><a href="other_405.html" title="">405 error</a></li>
                            <li><a href="other_500.html" title="">500 error</a></li>
                            <li><a href="other_503.html" title="">503 error</a></li>
                            <li><a href="other_offline.html" title="">Website is offline error</a></li>
                        </ul>
                    </li>
                    <li><a href="other_typography.html" title=""><span class="icol-create"></span>Typography</a></li>
                    <li><a href="other_invoice.html" title=""><span class="icol-money2"></span>Invoice template</a></li>
                </ul>
            </li>
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