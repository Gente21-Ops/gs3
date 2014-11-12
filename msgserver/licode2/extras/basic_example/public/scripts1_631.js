//var serverUrl = "/";
var serverUrl = "http://107.22.250.130:3001/";
var localStream, room; 
var clickSound = new Audio('noerro.mp3');

//WHO AM I 
//whoiam is the code for the user
var whoiam = '0';
//whoiamid is the code from the chat
var whoiamid = 0;
var whatsmyname = GL.userdata.qnick;
var whatsmyrole = 1;
var myroom = "any school";
var first = 0;
var myfriends = {};
var prevmsgw = 30;
//var types = Array('','Profesor','Alumn@','Padre/Madre');

//timers
//WARNING THIS CREATES LAG IN THE NETWORK 
//SO VALUES MUST BE KEPT OVER 100000
var idleseconds = 600000; //<- 600 seconds (10 minutes)
var deadseconds = 1200000; //<- 1200 seconds (20 minutes)

//CONNECTED STATUSES
var c_status = Array('','status_available', 'status_away', 'status_off');
//timer vars, state: 1 active, 0 idle
var idleTime = 0;
var state = 0;

//who am I talking with?
var talkingto = '0';
var islisted = 0;
var isblocked = 0;

//GLOBAL VARS START
function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\\[").replace(/[\]]/, "\\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
        results = regex.exec(location.search);
    return results == null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}

function print_r(arr,name) {
    //console.log(name);
    for(var index in arr) { 
      //console.log(index + " : " + arr[index]);
    }
}

window.onload = function () {

    GL.consol('TEST @'+GL.now());
    var txtclose = $('#closetxt').text();

    $('#diaddf').dialog({
        autoOpen: false,
        position: 'center',
        width: $(window).width()-180,
        height: $(window).height()-180,
        modal: true,
        buttons: {
            "Agregar amigos": function () {
                $.blockUI();

                var sel_ids = [];
                var noms = '';
                //retrieve all data
                $('[id^="fcheck_"]').each(function( index ) {
                    if($(this).attr('checked')){
                    	var dato = {};
                    	var fullid = $(this).attr('id').split('_');
                        dato.id = fullid[1];
                        dato.name = $(this).data('name');
                        sel_ids.push(dato);
                    }                    
                    GL.consol('SELECTED: '+$(this).attr('id'));
                });
                var newf = JSON.stringify(sel_ids);
                GL.consol(newf);

                GL.getter('clases/ui/chat_addu.php',{ qnewf:newf },'json',newgot);
                function newgot(myigot) {
                    if (myigot != '0'){
                    	myfriends = myigot;
                    	conectedfriends();
                    	GL.consol('The friends list has been updated:');
                    	GL.consol(myfriends);
                        $.jGrowl('Users added to your friends\' list');
                    } else {
                        $.jGrowl('ERROR, unable to add friends');
                    }

                    $.unblockUI();
                }

                $(this).dialog("close");
            }
        },
        open: function () {

            //we need a list of those friends that I already have
            //but that are not blocked
            var igot = '';
            $.each( myfriends, function( key, value ) { igot += '\''+value.id+'\','; });
            igot = igot.substring(0, igot.length - 1);

            //add friend's table
            oTable = $('#dfTable').on("init", function() {
                $('.on_off :checkbox').iButton({
                    labelOn: "",
                    labelOff: "",
                    enableDrag: false 
                });
                //let's hide the missing pics      
                $("#dfTable img").error(function () { $(this).hide(); });    
            }).dataTable({            
                "bJQueryUI": false,
                "bRetrieve": true,
                "bAutoWidth": false,
                "sPaginationType": "full_numbers",
                "sDom": '<"H"fl>t<"F"ip>',
                "sAjaxSource": 'clases/ui/msg_add.php?igot='+igot,
                "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
                    $(nRow).attr('id', aData[0]);
                    return nRow;
                },
                aoColumns: [
                {
                    sName: "id",
                    bSearchable: false,
                    bVisible: false
                }, { sName: "pic" }, { sName: "nick" }, { sName: "name" }, { sName: "type" }, { sName: "add" }] 

            });
        }
    });

    //user remove
    $('#diaremove').dialog({
        autoOpen: false,
        width: 480,
        modal: true,
        buttons: {
            "Guardar cambios": function () {
                $.blockUI();
                var isvisok = 0;
                var isblook = 0;
                if($('#ibutton').attr('checked')){ isvisok = 1 }
                if($('#ibutton').attr('checked')){ isblook = 1 }
                GL.getter('clases/ui/chat_deleteu.php',{ qfid:talkingto, qblock:isblook, qvis:isvisok },'json',retdelu);
                function retdelu(mydelu) {
                    if (parseInt(mydelu) == 1){
                        getfriends();
                        $.jGrowl('The user has been deleted from your friends\' list');
                    } else {
                        $.jGrowl('ERROR, unable to delete from list');
                    }

                    $.unblockUI();
                }

                $(this).dialog("close");
            }
        },
        open: function () {
        	if (islisted == 1){
        		//$('#c_visible').prop('checked', true);
        		$('#c_visible').iButton('toggle',true);
        	} else {
        		//$('#c_visible').prop('checked', false);
        		$('#c_visible').iButton('toggle',false);
        	}
            
        	if (parseInt(isblocked) == 1){
        		//$('#c_blocked').prop('checked', true);
        		$('#c_blocked').iButton('toggle',true);
        	} else {
        		//$('#c_blocked').prop('checked', false);
        		$('#c_blocked').iButton('toggle',false);
        	}
        	GL.consol('islisted'+islisted+' | isblocked'+isblocked);
        }
    });

    //block button
    $('c_visible').iButton({
		enableDrag: true 
	});
	$('c_blocked').iButton({
		enableDrag: true 
	});

    function getfriendname(qid){
        //GL.consol('Trying to get friend\'s name:'+qid);
        var res = $.grep(myfriends, function(e){ return e.id == qid; });
        if(res && res.length == 1){
            return res[0].name;
        } else {
            GL.consol('>>COULDN\'T GET IT XD');
            //GL.consol(res);
        }
    }

    function rebuildmsgs(allmsgs){
        //GL.consol('rebuild...');
        var laststamp;
        for (var key in allmsgs) {            
            //GL.consol('Trying to rebuild MSG from user: '+allmsgs[key].rid);//
            //find out friend's name if not me
            if (allmsgs[key].sid != GL.userdata.coder){
                localmsg_dest(allmsgs[key].txt,getfriendname(allmsgs[key].sid),allmsgs[key].tim);
            } else {
                localmsg_dest(allmsgs[key].txt,GL.userdata.qnick,allmsgs[key].tim);
                //GL.consol('I sent this msg: '+allmsgs[key].txt);
            }
            laststamp = allmsgs[key].tim;
        }
        lower();
    }

    function tof(who){
    	//GL.consol('TOF - Trying to talk to:'+who);
        //clearup text
        $("#texto").html('');
        talkingto = who;           
        //let's retrieve this person's name
        var res = $.grep(myfriends, function(e){ return e.id == who; });
        if(res && res.length == 1){
        	islisted = parseInt(res[0].visible);
        	isblocked = parseInt(res[0].blocked);
            $('#talkto').html('<div>'
                +'<div style="float:left;"><img src="images/users/37/'+who+'.jpg" style="width:37px; height:37px;"></div>'
                +'<div style="float:left; line-height:98%;">'
                +'<span> &nbsp;'+res[0].name+'</span><br>' 
                +' <!--&nbsp; <span class="icos-user littleicon"></span>-->'
                +' &nbsp; <img src="images/icons/usual/icon-cog60.png" class="littleicon" id="trash_'+who+'">'
                +' <span class="addfriends" id="add_'+who+'";> | &nbsp; [AGREGAR AMIGOS]</a></span>'
                +'</div>'
                +'</div>');

            //hook delete
            $('#trash_'+who).click(function(e){
            	$('#diaremove').dialog('open');
                $('#ui-dialog-title-diaremove').html('<span style="font-size:15px;">'+res[0].name.toUpperCase()+'</span>');                 
                $('#blockthumb').attr('src','images/users/120/'+talkingto+'.jpg');
            });
            //hook add friend
            $('#add_'+who).click(function(e){
                $('#diaddf').dialog('open');
                /*
                $('#ui-dialog-title-diaremove').html('<span style="font-size:15px;">'+res[0].name.toUpperCase()+'</span>');                 
                $('#blockthumb').attr('src','images/users/120/'+talkingto+'.jpg');
                */
            });
            //GL.consol('islisted'+islisted+' | isblocked'+isblocked);
            //GL.consol(myfriends);
            //now let's retrieve the messages from this person
            rebuildmsgs(GL.ch_getdata(GL.userdata.coder,who));
        }
        return false;
    }


    function emoji(qstr){
        var url = "images/emojis/standar/", patterns = [],
             metachars = /[[\]{}()*+?.\\|^$\-,&#\s]/g;

          // build a regex pattern for each defined property
          for (var i in GL.emoticons) {
            if (GL.emoticons.hasOwnProperty(i)){ // escape metacharacters
              patterns.push('('+i.replace(metachars, "\\$&")+')');
            }
          }

          // build the regular expression and replace
          return qstr.replace(new RegExp(patterns.join('|'),'g'), function (match) {
            return typeof GL.emoticons[match] != 'undefined' ?
                   '<img src="'+url+GL.emoticons[match]+'"/>' :
                   match;
        });
    }

    function lower(){
        $(".nano").nanoScroller();
        $(".nano").nanoScroller({ scroll: 'bottom' });
        //$(".nano").nanoScroller({ scrollTo: $('#sp'+tstamp)});
    }
    function localmsg(texto){
        var tstamp = GL.now();       
        $("#texto").append('<span class="singlemsg" title="'+GL.mytime()+'"><strong>'+GL.userdata.qnick+': </strong>'+emoji(texto)+'</span><span class="singlemsgdate"></span><br><span class="singlemsgspace bottom5" id="sp'+tstamp+'"><br>&nbsp;<br></span>');
        //nano bottom
        setTimeout(lower, 500);        
    }
    function localmsg_dest(texto,dest,tstamp){
        $("#texto").append('<span class="singlemsg" title="'+GL.mytimefromepoch(tstamp)+'"><strong>'+dest+': </strong>'+emoji(texto)+'</span><span class="singlemsgdate"></span><br><span class="singlemsgspace bottom5" id="sp'+tstamp+'"><br>&nbsp;<br></span>');
        //nano bottom
        setTimeout(lower, 500); 
    }

    //list of connected friends starts
    function conectedfriends(connectedness){
        //ok so we're gonna create a li per connected friend
        var salida = '';
        var getpic = '';
        $('#myfirends').html('Loading list of friends...');
        if (first == 0){ getpic = '?p='+GL.now(); };
        $.each( myfriends, function( key, value ) {
            //I add you unless you are not visible or blocked
            if (value.visible != 0 || value.blocked != 0){
                salida += '<li id="li_'+value.id+'">'
                /*+'<a href="#" onclick="tof(\''+value.id+'\'); return false;" title="">'*/
                +'<a href="#" title="">'
                +'<img src="images/users/37/'+value.id+'.jpg'+getpic+'" style="width:22px; height:22px;" alt="" />'
                +'<span class="contactName">'
                +'<strong>'+value.name+' <span></span></strong>'
                //+"<strong>"+value.name+" <span>(5)</span></strong>"
                //+"<i>web &amp; ui designer</i>"
                //+'<i>GS user (more data)</i>'
                +'</span>'
                +'<span class="status_off" id="lis_'+value.id+'"></span>'
                +'<span class="clear"></span>'
                +'</a>'
                +'</li >';
            }            
        });        
        // onclick='talkingto(\'"+value.id+"\'); return false;'
        //console.log('recreating friend\'s list with data:');
        //GL.consol(myfriends);
        $('#myfirends').html(salida);

        //hooks de select friend
        $('[id^="li_"]').click(function(e){
            e.preventDefault();
            var whoisit = $(this).attr('id').split('_');
            //GL.consol('ID OF CLICKED: '+$(this).attr('id'));
            tof(whoisit[1]);
        });

    } 
    //list of connected friends ends

    //change friend status
    function changefstat(qid,status,timo){    
        //GL.consol('changefstat para: '+qid+' | status:'+status+' | '+timo);     
        //cambio su status en la lista local de amigos
        var res = $.grep(myfriends, function(e){ return e.id == qid; });
        if(res && res.length == 1){
            //we only change the updated time if available
            //otherwise the other states will never occur
            if (status == 1){
                res[0].updated = timo;
                //GL.consol('I DO update the time for user:'+qid+' nwe time:'+timo);
            }           
            res[0].status = status;
        }        
        //cambio el color
        //GL.consol('User lis_'+qid+' Wants to switch his status to:'+c_status[status]+' at:'+timo);
        $('#lis_'+qid).attr("class",c_status[status]);
        //GL.clearo(); 
    }

    function checkallstatus(){        
        var checktime = GL.now();
        $.each( myfriends, function( key, value ) {
            if (value.updated != undefined){ 
            	GL.consol('Cehcktime:'+checktime+' | his latest update was @'+(checktime - value.updated)+' | updated @'+value.updated);
                //if the difference in time is larger than deadtime and status is not 2 we kill him
                if ( (checktime - value.updated) >= deadseconds && value.status != 3){
                    GL.consol('>>> User '+value.id+' | '+value.name+' is dead, new status: 3');
                    changefstat(value.id,3,value.updated);
                }
                //if the difference in time is larger than idletime and status is not 1 we set him as idle
                else if ( (checktime - value.updated) >= idleseconds && value.status != 2){
                    GL.consol('>>> User '+value.id+' | '+value.name+' is asleep, new status: 2');
                    changefstat(value.id,2,value.updated);
                }
            } else {
                //este usuario NO existe (no está conectado)
                //GL.consol('Este usuario NO tiene definido su timer');
                //changefstat(value.id,1,value.updated);
            }
        });
        //GL.consol('Checking everybody\'s status at '+GL.mytime());
        GL.consol(myfriends);
    }

    //we get friend's list from server
    function getfriends(){  

    	GL.getter('clases/ui/getfriends.php',{},'json',retmydat);
        function retmydat(mydata) {
            //new json format
            myfriends = mydata;
            conectedfriends();
            //I must get the current user's data before the sync!!!
            //this is redundant since functions.js does it as well BUT not in sync
            GL.getter('clases/ui/getmyadata.php',{},'json',returnData);
            function returnData(param) {
                GL.userdata = param;
                whoiam = GL.userdata.coder;
                //ALL SET!!! we can get this show started
                if (first == 0){ runme(); }
            }
        };
        
    }

    //INIT
    if (first == 0){ getfriends(); };




    //RUNME STARTS
    function runme(){ 
    
        console.log('@ Initializing COM client at '+GL.now());
        recording = false;
        var screen = getParameterByName("screen");
        var config = {audio: false, video: false, data: true, screen: screen, videoSize: [640, 480, 640, 480]};
        // If we want screen sharing we have to put our Chrome extension id. The default one only works in our Lynckia test servers.
        // If we are not using chrome, the creation of the stream will fail regardless.
        if (screen){
            config.extensionId = "okeephmleflklcdebijnponpabbmmgeo";
        }
        localStream = Erizo.Stream(config);
        
        var createToken = function(userName, role, callback) {

            var req = new XMLHttpRequest();
            var url = serverUrl + 'createToken/';
            var body = {username: userName, role: role};

            req.onreadystatechange = function () {
                if (req.readyState === 4) {
                    callback(req.responseText);
                }
            };

            req.open('POST', url, true);
            req.setRequestHeader('Content-Type', 'application/json');
            req.send(JSON.stringify(body));
        };

           
        createToken("user", "presenter", function (response) {
            var token = response;
            room = Erizo.Room({token: token});

            //console.log('>>TOKEN: '+token);
            //console.log('>>ROOM ID: '+String(room.roomID));
            //console.log(room);
            //console.log('>>-------------------------------------------------');

            localStream.addEventListener("access-accepted", function () {
                var subscribeToStreams = function (streams) {
                    for (var index in streams) {
                        var stream = streams[index];
                        if (localStream.getID() !== stream.getID()) {
                            room.subscribe(stream);
                        }
                    }
                };

                room.addEventListener("room-connected", function (roomEvent) {
                    room.publish(localStream);
                    subscribeToStreams(roomEvent.streams); 
                });

                room.addEventListener("stream-subscribed", function(streamEvent) {
                    var stream = streamEvent.stream;
                    GL.consol('>> Stream suscribed!');
                    
                    var div = document.createElement('div');
                    div.setAttribute("style", "width: 320px; height: 240px;");
                    div.setAttribute("id", "test" + stream.getID());

                    document.body.appendChild(div);
                    stream.show("test" + stream.getID());
                    

                    //I recognize myself:
                    whoiamid = localStream.getID();
                    //I change my local state to connected
                    state = 2;
                    /*//console.log('REMOTE STREAM ID: '+stream.getID()+'\nLOCAL STREAM:'+localStream.getID()
                        +'\nI AM '+GL.userdata.coder+' (ON GS3)  AND ID:'+whoiamid); */

                    //streams list (all users in the room)
                    var lostreams = room.remoteStreams;
                    //console.log(room.remoteStreams);

                    /*---------------START UP SYNC MSG---------------*/
                    //I identify myself (only once and we burn first)
                    if (first == 0){
                    	broadcast(0,whoiamid,GL.userdata.coder,0,GL.userdata.qnick,'StartUp Sync MSG',state);
                    	interun();
                    	first = 1;
                    }
                    

                    /*--------------------OTHER FUNCTIONS STARTS-------------------*/
                    function broadcast(type,mychatid,mygsid,towho,clearname,data,mystate){
                        //GL.consol('BROADCAST: type:'+type+' | mychatid:'+mychatid+' | mygsid:'+mygsid+' | towho:'+towho+' | clearname:'+clearname+' | data:'+data+' | mystate:'+mystate);
                        localStream.sendData({
                            qtype:type,
                            qid:mychatid,
                            qgsid:mygsid,
                            qwho:towho,
                            qname:clearname,
                            qdata:data,
                            qstate:mystate
                        });
                    }

                    function msg(qmsg){
                        //possible security risk on user input
                        var eltexto = $('#qinput').val()
                        localmsg(eltexto);
                        broadcast(2,whoiamid,GL.userdata.coder,talkingto,GL.userdata.qnick,qmsg,state);
                        //save this msg to localStorage
                        GL.ch_savedata(GL.now(),GL.userdata.coder,talkingto,eltexto,eltexto);
                        //clear the area
                        $('textarea#qinput').val('');
                    }

                    //HOOK SEND BUTTON
                    $("#elbutto").click(function() {
                        if ($('#qinput').val().length > 1){
                            msg($('#qinput').val()); 
                        }
                        return false;                   
                    });
                    //HOOK ENTER                  
                    $(document).keypress(function (e) {
                        //si se presiona enter y hay texto y el input tiene focus
                        if(e.which == 13 && $('#qinput').val().length > 1 && $('#qinput').is(":focus")){
                            msg($('#qinput').val());
                            return false;
                        }
                    });

                    //===== TIMER STARTS =====//    
				    //Increment the idle time counter every minute.
				    function interun(){				    	
				        var idleInterval = setInterval(keepAlive, idleseconds);						
				        function keepAlive() {			     
				            checkallstatus();
				        }        
				    }
                    
                    /*--------------------OTHER FUCNTIONS ENDS---------------------*/

                    //MSG PROCESSING FUNCTION STARTS
                    stream.addEventListener("stream-data", function(evt){
                        //console.log('Se ha recibido un mensaje del tipo:'+evt.msg.qtype+' está siendo enviado por:'+evt.msg.qgsid);
                        //GL.consol(evt.msg);
                        //FORMAT: data|type|id|gsid|towhom
                        //0 => syncronization message
                        //1 => simple message to all listeners
                        //2 => simple message broacast to a single listener 

                        //***SUPER FUCKING IMPORTANT*********************////////////////////////////////
                        //ALL events inside this listener will have an effect on all peers
                        //so if you want to do something locally must be run outside of thi scope
                        
                        //el mensaje de sincronización solo sirve para ver si existo
                        if (evt.msg.qtype == 0){                            
                            //if it's not me who send the msg
                            if (evt.msg.qgsid != GL.userdata.coder){
                            	//GL.consol('- THIS IS A SYNCRONIZATION MSG FROM: '+evt.msg.qgsid+' CURRENT USER:'+GL.userdata.coder);
                            	//GL.consol(evt.msg);
                                changefstat(evt.msg.qgsid,1,GL.now());
                            }
                        ////console.log('- THIS IS A MSG TO ALL LISTENERS');    
                        } else if (evt.msg.qtype == 1){

                            //say I'm alive
                            if (evt.msg.qgsid != GL.userdata.coder){
                                //click sound
                                clickSound.play();

                                GL.consol('Message to all users from: '+evt.msg.qgsid);
                                GL.consol(evt.msg);
                                changefstat(evt.msg.qgsid,1,GL.now());
                            }
                            
                            //remote message
                            var tstamp = GL.microtime();
                            $("#texto").append('<span class="singlemsg" title="'+GL.mytime()+'"><strong>'+evt.msg.qname+': </strong>'+emoji(evt.msg.qdata)+'</span><span class="singlemsgdate"> </span><br><span class="singlemsgspace bottom5" id="sp'+tstamp+'"><br>&nbsp;<br></span>');
                            //by forcing the recalculation the scrollbar appears
                            
                            //$(".nano").nanoScroller({ scroll: 'bottom' });
                            $(".nano").nanoScroller();
                            $(".nano").nanoScroller({ scrollTo: $('#sp'+tstamp)});  
                            
                            //////////THE TWILIGHT ZONE//////////////////////
                            //THIS HAPPENS ON THE OTHER CLIENT'S BROWSER/////
                            //$('#content').html('<br><strong><span style="font-size:50px">MESSAGE FROM BEYOND</span></strong>');
                            //////////THE TWILIGHT ZONE//////////////////////
                        ////console.log('- THIS IS A MSG TO A CERTAIN LISTENER');
                        } else if (evt.msg.qtype == 2){
                            //I check that it's not me
                            if (evt.msg.qgsid != GL.userdata.coder){

                                //I check that it's directed to me
                                if (evt.msg.qwho == GL.userdata.coder){
                                    //GL.consol('This is a private MSG for me from '+evt.msg.qgsid);
                                    clickSound.play();
                                    changefstat(evt.msg.qgsid,1,GL.now()); 
									var tstamp = GL.microtime();
                                    //remote message
                                    //THIS MSG should NOT be written to the output window unless it's for the current "taling to" user
                                    //otherwise it will go directly into the ch_ object in order to be read later on
                                    if (evt.msg.qgsid == talkingto){
                                        GL.consol('I am the talkingto user, evt.msg.qwho:'+evt.msg.qwho+' | talkingto:'+talkingto+' | evt.msg.qgsid:'+evt.msg.qgsid);
                                        localmsg_dest(evt.msg.qdata,evt.msg.qname,GL.now()); 
                                    } else {
                                        GL.consol('I am NOT the talkingto user, evt.msg.qwho:'+evt.msg.qwho+' | talkingto:'+talkingto+' | evt.msg.qgsid:'+evt.msg.qgsid);
                                        $.jGrowl('<div class="msgpop" id="msgpop_'+evt.msg.qgsid+'" style="cursor: pointer; cursor: hand;">'+
                                            '<div style="float:left"><img src="images/users/37/'+evt.msg.qgsid+'.jpg" style="width:40px; height:40px; vertical-align:middle;"></div>'+
                                            '<div style="float:left; margin-left:5px; width:180px;"><strong>'+getfriendname(evt.msg.qgsid)+'</strong><br>'+emoji(GL.trunkme(evt.msg.qdata,prevmsgw))+'</div>'+
                                            '</div>', { 
                                            /**/open: function() {
                                                //si soy el usuario seleccionado imprimo, si no espero el click 
                                                if (talkingto == evt.msg.qgsid){
                                                    GL.consol('>>YOU HAVE CLICKED THE TALKING TO USER, we append the MSG');
                                                    tof(evt.msg.qgsid);
                                                    $("#msgpop_"+evt.msg.qgsid).closest('.jGrowl-notification').remove();
                                                } else {
                                                    GL.consol('>>YOU HAVE CLICKED ON ANOTHER USER, we DON\'T append the MSG un til the click');
                                                    $('body').on('click', '#msgpop_'+evt.msg.qgsid, function () {
                                                        tof(evt.msg.qgsid);
                                                        $("#msgpop_"+evt.msg.qgsid).closest('.jGrowl-notification').remove();
                                                    });
                                                }
                                            },
                                            sticky: true,
                                            /*life: 15000,*/
                                            position: 'bottom-right',
                                            easing: 'swing'
                                        });
                                        //msg nottify
                                        GL.consol('Trying to set class to:'+evt.msg.qgsid);
                                        $( "#li_"+evt.msg.qgsid ).addClass( "gotmsg" );
                                    }

                                    //write to LS
                                    GL.ch_savedata(GL.now(),evt.msg.qgsid,GL.userdata.coder,evt.msg.qdata);

                                }
                            }
                        }
                        ////new room request for single file sharing
                        else if (evt.msg.qtype == 3){

                        }
                        ////new room request for multi file sharing
                        else if (evt.msg.qtype == 4){
                        
                        }
                        
                    });
                    //MSG PROCESSING FUNCTION ENDS



                    
                    
                    //===== TIMER ENDS =====//
                    /*
                    //Zero the idle timer on mouse movement.
                    $('body').mousemove(function (e) {
                        idleTime = 0;
                    });
                    $('body').mouseover(function (e) {
                        idleTime = 0;
                    });
                    $('body').keypress(function (e) {
                        idleTime = 0;
                    });
					*/
                    
                });

                room.addEventListener("stream-added", function (streamEvent) {
                    //console.log('>> Stream Added!');
                    var streams = [];
                    streams.push(streamEvent.stream);
                    subscribeToStreams(streams);
                });

                room.addEventListener("stream-removed", function (streamEvent) {
                    //console.log('>> Stream Removed!');                
                    // Remove stream from DOM
                    var stream = streamEvent.stream;
                    if (stream.elementID !== undefined) {
                        var element = document.getElementById(stream.elementID);
                        document.body.removeChild(element);
                    }
                });

                room.connect();
                //localStream.show("myVideo");

            });
        
        localStream.init();
        });

    //RUNME ENDS
    }


};