<?php


include("logon.php");

include('../dict/students_msgs.php');
include('general/students_getmsgs.php');
include('msgs_getnames.php');

    ob_start();
    require_once('connection.php');
    mysql_query('SET CHARACTER SET utf8');
    mysql_query('SET NAMES "utf8"');
    
    //TOP (Nombre^URL^|Nombre^URL)
    $breads = $texts['title'].'^students_msgs^general/students_msgs';
    include('top.php');
?>  

<div style="display:none;" id="qescuelacode"><?php echo $_SESSION['qescuelacode']; ?></div>
<div style="display:none;" id="quser"><?php echo $_SESSION['code']; ?></div>
<div style="display:none;" id="qnick"><?php echo $_SESSION['qnick']; ?></div>
    
    <!-- Main content -->
    <div class="wrapper">

        <!--
        <ul class="middleNavR">
            <li><a href="#" title="Add an article" class="tipN"><img src="images/icons/middlenav/create.png" alt="" /></a></li>
            <li><a href="#" title="Upload files" class="tipN"><img src="images/icons/middlenav/upload.png" alt="" /></a></li>
            <li><a href="#" title="Add something" class="tipN"><img src="images/icons/middlenav/add.png" alt="" /></a></li>
            <li><a href="#" title="Messages" class="tipN"><img src="images/icons/middlenav/dialogs.png" alt="" /></a><strong>8</strong></li> 
            <li><a href="#" title="Check statistics" class="tipN"><img src="images/icons/middlenav/stats.png" alt="" /></a></li>
        </ul>
        -->

        <!-- Enter message field -->
        <div class="enterMessage">
            <input type="text" name="enterMessage" placeholder="Enter your message..." id="msgbox" onkeydown="if (event.keyCode == 13) allmsg();" />
            <div class="sendBtn" id="container" >
                <a href="#" title="" class="attachPhoto" id="mainpic" onmouseover="fireup('mainpic');"></a>
                <!--<a href="#" title="" class="attachLink"></a>-->
                <input type="submit" name="sendMessage" class="buttonS bLightBlue" value="Enviar" id="but_all" onclick="allmsg();" />
            </div>

        </div>
    
        <!-- Messages #1 -->        
            <div id="lesmesg">
                
                <div id="addpics"style="display:block;"></div>
                <div class="clear"></div>
                
                <?php 
                $salida = "";
                $rand = rand(10,100);
                if ($cursor->count() < 1){
                    echo ' &nbsp; NO HAY MENSAJES, entre su primer mensaje en la caja de arriba';
                }
                
                foreach ($cursor as $obj) {
                    error_reporting(E_ALL); 
                    ini_set( 'display_errors','1');

                    //recompose answers
                    $answers = "";
                    for ($a = 0; $a < sizeof($obj['resp']); $a++){


                        if ($obj['resp'][$a]['flag'] == '0' || $obj['resp'][$a]['flag'] == '2'){

                            $answers .= '<li class="by_me" id="resp_'.$obj['resp'][$a]['uid'].'">
                                <a href="#" title=""><img src="images/users/37/'.$obj['resp'][$a]['user'].'.jpg?s='.$rand.' alt="" /></a>
                                <div class="messageArea">
                                    <span class="aro"></span>
                                    <div class="infoRow">
                                        <span class="name"><strong>'.getnames($obj['resp'][$a]['user']).'</strong> says:</span>
                                        <span class="time">'.time_since(time() - $obj['resp'][$a]['tstamp']).' ago <a onclick="openflag(\''.$obj['_id'].'\',\'1\',\''.$obj['resp'][$a]['uid'].'\')"><img src="images/icons/usual/icon-flag.png"></a></span>
                                        <div class="clear"></div>
                                    </div>'.$obj['resp'][$a]['msg'].'
                                </div>
                                <div class="clear"></div>
                            </li>';
                        }

                    }


                    $gal = "";
                    //recompose galleries
                    
                    if (sizeof($obj['pics']) > 0){                        
                        for ($b = 0; $b < sizeof($obj['pics']); $b++){

                            $picjpg = pjpg($obj['pics'][$b]);
                            $picname = ext($obj['pics'][$b],0);

                            $erase = "";

                            //is it me?
                            if ($obj['user'] == $_SESSION['code']){ $erase = '<div class="imgaldel" onclick="picdel(\''.$obj['_id'].'\',\''.$obj['pics'][$b].'\',\'1\')"></div>';  }

                            $gal .= '<div class="imgal" id="gi_'.$picname.'"><a href="files/'.$_SESSION['qescuelacode'].'/'.$picjpg.'" data-namo="'.$obj['_id'].'" class="c_'.$obj['_id'].'" rel="c_'.$obj['_id'].'" id="prev_'.$picname.'" target="_blank"><img src="files/'.$_SESSION['qescuelacode'].'/120/'.$picjpg.'" class="imgalin"></a>'.$erase.'</div>';
                        }
                    }
                    

                    $salida .= '<ul class="messagesOne" id="msg_'.$obj['_id'].'">
                        <li class="by_user">
                            <a href="#" title=""><img src="images/users/37/'.$obj['user'].'.jpg?s='.$rand.'" alt="" /></a>
                            <div class="messageArea">
                                <span class="aro"></span>
                                <div class="infoRow">
                                    <span class="name" id="qname_'.$obj['_id'].'"><strong>'.getnames($obj['user']).'</strong> dice:</span>
                                    <span class="time"> '.time_since(time() - $obj['tstamp']).' ago  <a onclick="openflag(\''.$obj['_id'].'\',\'2\',\'0\')"><img src="images/icons/usual/icon-flag.png"></a></span>
                                    <div class="clear"></div>
                                </div>
                                '.$obj['msg'].'
                                <div id="addpics_'.$obj['_id'].'" style="margin-top:10px; width:100%;">'.$gal.'</div>
                                <div class="clear"></div>
                                <div class="enterMessage">
                                    <input type="text" name="enterMessage" placeholder="Reply to post..." id="msgbox_'.$obj['_id'].'"  onkeydown="if (event.keyCode == 13) addcomment(\''.$obj['_id'].'\');" style="padding: 10px 45px 10px 10px;" />
                                    <div class="sendBtn">
                                        <!--<a href="#" title="" class="attachPhoto" onmouseover="fireup(\'pbut_'.$obj['_id'].'\');" id="pbut_'.$obj['_id'].'"></a>
                                        <a href="#" title="" class="attachLink"></a>-->
                                    </div>
                                </div>
                            </div>
                            <div class="clear"></div>
                        </li>
                        '.$answers.'
                    </ul>
                    <div class="divider"><span></span></div>';

                }

                echo $salida;

                ?>

                
                <!--
                <ul class="messagesOne">
                    <li class="by_user">
                        <a href="#" title=""><img src="images/live/face1.png" alt="" /></a>
                        <div class="messageArea">
                            <span class="aro"></span>
                            <div class="infoRow">
                                <span class="name"><strong>John</strong> says:</span>
                                <span class="time">3 hours ago</span>
                                <div class="clear"></div>
                            </div>
                            Mensaje principal
                        </div>
                        <div class="clear"></div>
                    </li>
                
                    <li class="by_me">
                        <a href="#" title=""><img src="images/live/face2.png" alt="" /></a>
                        <div class="messageArea">
                            <span class="aro"></span>
                            <div class="infoRow">
                                <span class="name"><strong>Eugene</strong> says:</span>
                                <span class="time">3 hours ago</span>
                                <div class="clear"></div>
                            </div>
                            Respuyesta 1
                        </div>
                        <div class="clear"></div>
                    </li>
                
                    <li class="by_me">
                        <a href="#" title=""><img src="images/live/face2.png" alt="" /></a>
                        <div class="messageArea">
                            <span class="aro"></span>
                            <div class="infoRow">
                                <span class="name"><strong>Eugene</strong> says:</span>
                                <span class="time">3 hours ago</span>
                                <div class="clear"></div>
                            </div>
                            Respuesta 2
                        </div>
                        <div class="clear"></div>
                    </li>
                    
                    <li class="divider"><span></span></li>
                    
                </ul>
                -->
        
            </div>
        
    </div>
    <!-- Main content ends -->


<!-- FLAG DIALOG -->

<div id="diaflag" title="FLAG MESSAGE">
    This wessage will be flagged for review and won't be visible anymore to anybody, the school's management personel will review this message later on. Please only flag a message if it:
    <br><br>
    <ul style="list-style-type:circle; margin-left:20px; padding-left:20px;">
        <li>Promotes bullying</li>
        <li>Contains improper languaje or insults</li>
        <li>Promotes hate or discrimination</li>
    </ul>
    <br>
    <strong>¿Are you sure you want to flag this message?</strong>
</div>



<!-- picdel DIALOG -->

<div id="diapicdel" title="FLAG MESSAGE" style="display:none;">
    <div>
        
    </div>
    This image will be deleted
</div>


