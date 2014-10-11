//var serverUrl = "/";
var serverUrl = "http://107.22.250.130:3001/";
var localStream, room; 

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
//var types = Array('','Profesor','Alumn@','Padre/Madre');

//timers
//WARNING THIS CREATES LAG IN THE NETWORK 
//SO VALUES MUST BE KEPT OVER 100000
var idleseconds = 10000;
var deadseconds = 20000;

//CONNECTED STATUSES
var c_status = Array('','status_available', 'status_away', 'status_off');
//timer vars, state: 1 active, 0 idle
var idleTime = 0;
var state = 0;

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

    function localmsg(texto){
        var tstamp = GL.microtime();
        $("#texto").append('<span class="singlemsg" title="'+GL.mytime()+'"><strong>'+GL.userdata.qnick+': </strong>'+emoji(texto)+'</span><span class="singlemsgdate"> </span><br><span class="singlemsgspace bottom5" id="sp'+tstamp+'"><br>&nbsp;<br></span>')
        //by forcing the recalculation the scrollbar appears
        $(".nano").nanoScroller();
        $(".nano").nanoScroller({ scrollTo: $('#sp'+tstamp)});
    }

    //list of connected friends starts
    function conectedfriends(connectedness){
        //ok so we're gonna create a li per connected friend
        var salida = "";
        var getpic = '';
        if (first == 0){ getpic = '?p='+GL.now(); };
        $.each( myfriends, function( key, value ) {
            
            salida += "<li id='li_"+value.id+"'><a href='#' title=''><img src='images/users/37/"+value.id+".jpg"+getpic+"' alt='' />"
                +"<span class='contactName'>" 
                +"<strong>"+value.name+" <span></span></strong>"
                //+"<strong>"+value.name+" <span>(5)</span></strong>"
                //+"<i>web &amp; ui designer</i>"
                +"<i>GS user (more data)</i>"
                +"</span>"
                +"<span class='status_off' id='lis_"+value.id+"'></span>"
                +"<span class='clear'></span>"
                +"</a>"
                +"</li >";
        });        
        //console.log('recreating friend\'s list with data:');
        GL.consol(myfriends);
        $('#myfirends').html(salida);
    } 
    //list of connected friends ends

    //change friend status
    function changefstat(qid,status,timo){    
        GL.consol('changefstat para: '+qid+' | status:'+status+' | '+timo);    
        //cambio su status en la lista local de amigos
        var res = $.grep(myfriends, function(e){ return e.id == qid; });
        if(res && res.length == 1){
            //we only change the updated time if available
            //otherwise the other states will never occur
            if (status == 1){
                res[0].updated = timo;
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
        GL.consol('Checking everybody\'s status at '+GL.mytime());
        $.each( myfriends, function( key, value ) {
            if (value.updated != undefined){
                //if the difference in time is larger than deadtime and status is not 2 we kill him
                if ( (checktime - value.updated) > deadseconds && value.status != 2){
                    GL.consol('User '+value.id+' | '+value.name+' is dead, new status: ');
                    changefstat(value.id,2,value.updated);
                }
                //if the difference in time is larger than idletime and status is not 1 we set him as idle
                else if ( (checktime - value.updated) > idleseconds && value.status != 1){
                    changefstat(value.id,1,value.updated);
                }
            } 
        });
    }

    //we get friend's list from server
    function getfriends(){        
        //console.log('>> getting list of friends at '+GL.now());
        $.post( "clases/ui/getfriends.php", function( data ) {
            //new json format
            myfriends = JSON.parse(data);
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
        });
        
    }

    //INIT
    if (first == 0){ getfriends(); };




    //RUNME STARTS
    function runme(){ 
    
        console.log('@ Initializing COM client at 1122');

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
                        localmsg($('#qinput').val());
                        broadcast(1,whoiamid,GL.userdata.coder,0,GL.userdata.qnick,qmsg,state);
                        //clear the area
                        $('textarea#qinput').val('');
                    }

                    $("#elbutto").click(function() {
                        if ($('#qinput').val().length > 1){
                            msg($('#qinput').val()); 
                        } 
                        return false;                   
                    });

                    //===== TIMER STARTS =====//    
				    //Increment the idle time counter every minute.
				    function interun(){
				    	
				        var idleInterval = setInterval(keepAlive, idleseconds); // 1 minute
						
				        function keepAlive() {			        	
				            broadcast(0,whoiamid,GL.userdata.coder,0,GL.userdata.qnick,'Status update to idle | idleseconds:'+idleseconds,state);
				            checkallstatus();
				            //this doesn't work
				            //window.clearInterval(idleInterval);
				            //GL.consol('Interval killed');
				            //GL.consol('Timer tick! @'+GL.now()+' | idletime:'+idleTime+' | MY STATE:'+state);
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
                        } else if (evt.msg.qtype == 1){
                            ////console.log('- THIS IS A MSG TO ALL LISTENERS');                         
                            
                            //click sound
                            var clickSound = new Audio('noerro.mp3');
                            clickSound.play();

                            //say I'm alive
                            if (evt.msg.qgsid != GL.userdata.coder){
                                GL.consol('Message to all users from: '+evt.msg.qgsid);
                                GL.consol(evt.msg);
                                changefstat(evt.msg.qgsid,1,GL.now());
                            }

                            //idleTime we force to zero so the counter starts again
                            idleTime = 0;
                            state = 1;
                            //conectedfriends();
                            
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