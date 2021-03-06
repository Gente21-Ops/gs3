<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('dict/com.php');
?>
<!-- REMOVE USER DIALOG -->
<div id="closetxt" class="hide"><?php echo $texts['rem_cerrar']; ?></div>
<div id="savedtxt" class="hide"><?php echo $texts['rem_saved']; ?></div>
<div id="errortxt" class="hide"><?php echo $texts['rem_error']; ?></div>
<div id="nof" class="hide"><?php echo $texts['not_nof']; ?></div>
<div id="nof_add" class="hide"><?php echo $texts['not_clicktoadd']; ?></div>

<div id="diaremove" title="..." class="hide">
    <div class="formRow fluid">
        <div class="grid4">
            <img src="" id="blockthumb">
        </div>
        <div class="grid8">
            <?php echo $texts['rem_desctwo']; ?>
            <div class="grid9 on_off">
                <div class="floatL mr10" id="cont_islisted">
                    <input type="checkbox" id="c_visible" name="chbox" />
                </div>
            </div>
            <br><br>
            <?php echo $texts['rem_descthree']; ?>
            <div class="grid9 on_off">
                <div class="floatL mr10" id="cont_isblocked">
                    <input type="checkbox" id="c_blocked" name="chbox" />
                </div>
            </div>
        </div>
    </div>
</div>

<div id="diaddf" title="<?php echo $texts['add_title']; ?>" class="hide">
    <div class="formRow fluid">
        <div class="grid12">
            
            <table cellpadding="0" cellspacing="0" border="0" class="dfTable" id="dfTable" width="100%">
            <thead>
            <tr>
                <th>ID</th>
                <th><?php echo $texts['add_col_pic']; ?></th>                        
                <th><?php echo $texts['add_col_nick']; ?></th>
                <th><?php echo $texts['add_col_name']; ?></th>
                <th><?php echo $texts['add_col_type']; ?></th>
                <th><?php echo $texts['add_col_add']; ?></th>
            </tr>
            </thead>
            <tbody>
            </tbody>
            </table> 

        </div>
    </div>
</div>

<!-- Secondary nav -->
    <div class="secNav">
        <div class="secWrapper">


            
            <!-- Tabs container -->
            <div id="tab-container" class="tab-container">
                
                <!-- 
                Active conversations

                <ul class="iconsLine ic3 etabs">
                    <li><a href="#alt1" title=""><span class="icos-user"></span></a></li>
                    <li><a href="#general" title=""><span class="icos-fullscreen"></span></a></li>
                    <li><a href="#alt2" title=""><span class="icos-archive"></span></a></li>
                    <li><a href="#alt2" title=""><span class="icos-archive"></span></a></li>
                </ul>

                
                
                <div class="divider"><span></span></div>-->
                
                <!--
                <div id="general">
                
                    <div class="sidePad">
                        <a href="#" title="" class="sideB bLightBlue">Add new session</a>
                    </div>
                    
                    <div class="divider"><span></span></div>
                
                    <div class="sideUpload">
                        <div class="dropFiles"></div>
                        <ul class="filesDown">
                            <li class="currentFile">
                                <div class="fileProcess">
                                    <img src="images/elements/loaders/10s.gif" alt="" class="loader" />
                                    <strong>Homepage_widgets_102.psd</strong>
                                    <div class="fileProgress">
                                        <span>9.1 of 17MB</span> - <span>243KB/sec</span> - <span>1 min</span>
                                    </div>
                                    
                                    <div class="contentProgress"><div class="barG tipN" title="61%" id="bar10"></div></div>
                                </div>
                            </li>
                            <li><span class="fileSuccess"></span>About_Us_08956.psd<span class="remove"></span></li>
                            <li><span class="fileSuccess"></span>Our_services_02811.psd<span class="remove"></span></li>
                            <li><span class="fileError"></span>Homepage_Alt_032811.psd<span class="remove"></span></li>
                            <li><span class="fileQueue"></span>Homepage_Alt_032811.psd<span class="remove"></span></li>
                            <li><span class="fileQueue"></span>Homepage_Alt_032811.psd<span class="remove"></span></li>
                        </ul>
                    </div>
                    
                    
                </div>
                -->
                
                <div id="alt1">

                        <div class="sideWidget">
                            <div class="formRow">
                                <div class="pageTitle" id="talkto">
                                    <?php echo $texts['chatwin']; ?>
                                </div><!--<span>15 new messages</span>-->
                            </div>
                        </div>
                                            
                        <div class="sideWidget">
                            <div class="nano" id="about">
                                <div class="content" id="texto">
                                    &nbsp;
                                </div>
                            </div>
                        </div>

                        <div class="sideWidget top9" id="textbox" style="display:none;">
                            <div class="formRow">
                                <!--<label>Usual textarea:</label>-->
                                <textarea rows="8" style="height:56px;" name="textarea" id="qinput" placeholder="Write your message here"></textarea>
                            </div>
                            <div class="formRow">
                                <input type="submit" class="buttonS bLightBlue" value="SEND MESSAGE" id="elbutto" />
                            </div>
                            <!--
                            <div class="formRow">
                                &nbsp;
                            </div>
                            -->
                        </div>

                    <div class="divider" style="display:none;"><span></span></div>
                
                    <!-- Sidebar user list -->
                    <ul class="userList" id="myfirends" style="display:none; margin-top:16px;">
                        <!--
                        <li>
                            <a href="#" title="">
                                <img src="images/live/face1.png" alt="" />
                                <span class="contactName">
                                    <strong>Eugene Kopyov <span>(5)</span></strong>
                                    <i>web &amp; ui designer</i>
                                </span>
                                <span class="status_away"></span>
                                <span class="clear"></span>
                            </a>
                        </li >
                        <li>
                            <a href="#" title="">
                                <img src="images/live/face2.png" alt="" />
                                <span class="contactName">
                                    <strong>Lucy Wilkinson <span>(12)</span></strong>
                                    <i>Team leader</i>
                                </span>
                                <span class="status_off"></span>
                                <span class="clear"></span>
                            </a>
                        </li>
                        <li>
                            <a href="#" title="">
                                <img src="images/live/face3.png" alt="" />
                                <span class="contactName">
                                    <strong>John Dow</strong>
                                    <i>PHP developer</i>
                                </span>
                                <span class="status_available"></span>
                                <span class="clear"></span>
                            </a>
                        </li>
                        -->
                    </ul> 
                                        
                    
                </div>
                
                <!--
                <div id="alt2">
                
                    CHIDO
                </div>
                -->
            </div>
            
            <!--<div class="divider"><span></span></div>-->
            
       </div> 
       <div class="clear"></div>
   </div>



<!--COM SCRIPTS-->
<script type="text/javascript" src="msgserver/licode/extras/basic_example/public/erizo.js"></script>
<script type="text/javascript" src="msgserver/licode/extras/basic_example/public/scripts1_631.js?<?php echo(rand(1,100000)); ?>"></script> 

<script>
$( document ).ready(function() {
    //===== NANO SCROLLER =====//
    if ($(".nano")[0]){
        $(".nano").nanoScroller();
    }
    //===== NANO SCROLLER =====//
});
</script>