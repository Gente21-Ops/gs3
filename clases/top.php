<div class="contentTop">
        <span class="pageTitle"><span class="icon-screen"></span><?php echo $texts['title']; ?></span>
        <?php 
            
            if($_SESSION['tipo'] == 2){
                require_once('student/faltas_alumno.php');
                require_once('student/calif_alumno.php');
                require_once('student/saldo_alumno.php');
                echo '
                <ul class="quickStats">
                    <li>
                        <a href="" class="blueImg"><img src="images/icons/quickstats/plus.png" alt="" /></a>
                        <div class="floatR"><strong class="blue">'.number_format($qcalif,2).'</strong><span>promedio</span></div>
                    </li>
                    <li>
                        <a href="" class="redImg"><img src="images/icons/quickstats/user.png" alt="" /></a>
                        <div class="floatR"><strong class="blue">'.$qfaltas.'</strong><span>faltas</span></div>
                    </li>
                    <!--<li>
                        <a href="" class="greenImg"><img src="images/icons/quickstats/money.png" alt="" /></a>
                        <div class="floatR"><strong class="blue">'.$qsaldo.'</strong><span>saldo</span></div>
                    </li>-->
                </ul>
                ';
            }
        ?>
        <div class="clear"></div>
    </div>
    
    <!-- Breadcrumbs line -->
    <div class="breadLine">
        <div class="bc">
            <ul id="breadcrumbs" class="breadcrumbs">
                <li><a href="#">Principal</a></li>
                <?php
                    /*$items = explode('|', $breads); 
                    for ($r = 0; $r < sizeof($items); $r++){
                        $inner = explode('^', $items[$r]);
                        
                        //linking is disabled until finding a solution for dynamic loading
                        //echo '<li><a href="'.$inner[1].'" data-js="'.$inner[2].'">'.$inner[0].'</a></li>';
                        echo '<li><a href="#" data-js="'.$inner[2].'">'.$inner[0].'</a></li>';
                    }*/
                 ?>

                
                <!--
                <li><a href="#">UI elements</a>
                    <ul>
                        <li><a href="ui.html" title="">General elements</a></li>
                        <li><a href="ui_icons.html" title="">Icons</a></li>
                         <li><a href="ui_buttons.html" title="">Button sets</a></li>
                        <li><a href="ui_custom.html" title="">Custom elements</a></li>
                        <li><a href="ui_experimental.html" title="">Experimental</a></li>
                    </ul>
                </li>
                <li class="current"><a href="ui_grid.html" title="">Grid</a></li>
                -->
            </ul>
        </div>
        
        <div class="breadLinks">
            <ul>
                <?php
                    /*
                    if($_SESSION['tipo'] == 2){
                        require_once("student/tareas_done_alumno.php");
                        require_once("student/tareas_alumno.php");
                        echo '<li><a href="students_homework" title=""><i class="icos-list"></i><span>Tareas completadas</span> <strong>(+'.$cuantasTareasHechas.')</strong></a></li>';

                        echo '<li><a href="students_homework" title=""><i class="icos-check"></i><span>Tareas pendientes</span> <strong>(+'.$cuantasTareas.')</strong></a></li>';
                    } else if($_SESSION['tipo'] == 4){
                        echo '<li><a href="parents_homework" title=""><i class="icos-list"></i><span>Tareas completadas</span> <strong>(+'.$cuantasTareasHechas.')</strong></a></li>';

                        echo '<li><a href="parents_homework" title=""><i class="icos-check"></i><span>Tareas pendientes</span> <strong>(+'.$cuantasTareas.')</strong></a></li>';
                    }*/
                ?>
                <!--<li><a href="#" title=""><i class="icos-list"></i><span>Tareas completadas</span> <strong>(+<?php //require_once('student/tareas_done_alumno.php'); ?>)</strong></a></li>
                <li><a href="#" title=""><i class="icos-check"></i><span>Tareas pendientes</span> <strong>(+<?php //require_once('student/tareas_alumno.php'); ?>)</strong></a></li>
                <li class="has">
                    <a title="">
                        <i class="icos-money3"></i>
                        <span>Amigos</span>
                        <span><img src="images/elements/control/hasddArrow.png" alt="" /></span>
                    </a>
                    <ul>
                        <li><a href="#" title=""><span class="icos-add"></span>New invoice</a></li>
                        <li><a href="#" title=""><span class="icos-archive"></span>History</a></li>
                        <li><a href="#" title=""><span class="icos-printer"></span>Print invoices</a></li>
                    </ul>
                </li>-->
            </ul>
             <div class="clear"></div>
        </div>
    </div>