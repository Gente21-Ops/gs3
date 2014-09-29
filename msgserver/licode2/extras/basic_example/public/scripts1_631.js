//var serverUrl = "/";
var serverUrl = "http://107.22.250.130:3001/";
var localStream, room; 

//WHO AM I 
//whoiam is the code for the user
var whoiam = GL.userdata.coder;
//whoiamid is the code from the chat
var whoiamid = 0;
var whatsmyname = "";
var whatsmyrole = 1;
var myroom = "any school";
var first = 0;
var myfriends = {};

//timer vars, state: 1 active, 0 idle
var idleTime = 0;
var state = 1;
var idleseconds = 300000;

//CONNECTED STATUSES
var c_status = ['status_off', 'status_available', 'status_away'];
var mystatus = 0;

//emojis
var emoticons = {
        "=D":"Laughing.png",
        ":)":"Laughing.png",
        "(smile)":"Smile.png",
        "X(":"Angry.png",
        "X-(":"Angry.png",
        "(angry)":"Angry.png",
        "(content)":"Content.png",
        "(grin)":"Grin.png",
        ":*":"Kiss.png",
        ":-*":"Kiss.png",
        "(kiss)":"Kiss.png",
        "8-)":"Cool.png",
        "(cool)":"Cool.png",
        "(heart)":"Heart.png",
        "<3":"Heart.png",
        "(devil)":"Naughty.png",
        "(sick)":"Sick.png",
        "(no)":"Thumbs-Down.png",
        "(yes)":"Thumbs-Up.png",
        "(ok)":"Thumbs-Up.png",
        "(tongue)":"Yuck.png",
        "=P":"Yuck.png",
        ":P":"Yuck.png",
        ";-)":"Wink.png",
        ";)":"Wink.png",
        ";=)":"Gasp.png",
        ":-O":"Gasp.png",
        ":=o":"Gasp.png",
        ";P":"Crazy.png",
        "(crazy)":"Crazy.png",
        "($)":"Money-Mouth.png",
        "(money)":"Money-Mouth.png",
        "=B":"Nerd.png",
        ":B":"Nerd.png",
        "(nerd)":"Nerd.png"
      }

//TIMESTAMP
function mytime(){
    var currentdate = new Date(); 
    var datetime = "AT: " + currentdate.getDate() + "/"
        + (currentdate.getMonth()+1)  + "/" 
        + currentdate.getFullYear() + " - "  
        + currentdate.getHours() + ":"  
        + currentdate.getMinutes() + ":" 
        + currentdate.getSeconds();
    return datetime;
}

function microtime(){
    var seconds = new Date() / 1000;
    return Math.ceil(seconds);
}

//GLOBAL VARS START
function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\\[").replace(/[\]]/, "\\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
        results = regex.exec(location.search);
    return results == null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}

function print_r(arr,name) {
    console.log(name);
    for(var index in arr) {
      console.log(index + " : " + arr[index]);
    }
}

function localmsg(texto){
    var tstamp = microtime();
    $("#texto").append('<span class="singlemsg" title="'+mytime()+'"><strong>'+whatsmyname+': </strong>'+emoji(texto)+'</span><span class="singlemsgdate"> </span><br><span class="singlemsgspace bottom5" id="sp'+tstamp+'"><br>&nbsp;<br></span>')
    //by forcing the recalculation the scrollbar appears
    
    $(".nano").nanoScroller();
    $(".nano").nanoScroller({ scrollTo: $('#sp'+tstamp)});
}

function emoji(qstr){
    var url = "images/emojis/standar/", patterns = [],
         metachars = /[[\]{}()*+?.\\|^$\-,&#\s]/g;

      // build a regex pattern for each defined property
      for (var i in emoticons) {
        if (emoticons.hasOwnProperty(i)){ // escape metacharacters
          patterns.push('('+i.replace(metachars, "\\$&")+')');
        }
      }

      // build the regular expression and replace
      return qstr.replace(new RegExp(patterns.join('|'),'g'), function (match) {
        return typeof emoticons[match] != 'undefined' ?
               '<img src="'+url+emoticons[match]+'"/>' :
               match;
    });
}

window.onload = function () {

    //list of connected friends starts
    function conectedfriends(connectedness){
        //ok so we're gonna create a li per connected friend
        var salida = "";
        $.each( myfriends, function( key, value ) {
            salida += "<li id='li_"+value.id+"'><a href='#' title=''><img src='images/users/37/"+value.id+".jpg' alt='' />"
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
        console.log('recreating friend\'s list with data:');
        GL.consol(myfriends);
        $('#myfirends').html(salida);
    } 
    //list of connected friends ends

    //change friend status
    function changefstat(qid,status){
        var qtime = GL.now();
        GL.consol('User '+qid+' Wants to switch his status to:'+status+' at:'+qtime);
        //cambio su status en la lista de amigos
        var result = $.grep(myfriends, function(e){ return e.id == qid; });
        GL.consol(result);
        //cambio el color
        $('#lis_'+qid).attr("class",c_status[status]);       
    }

    //we get friend's list from server
    function getfriends(){        
        console.log('>> getting list of friends at '+GL.now());
        $.post( "clases/ui/getfriends.php", function( data ) {
            //new json format
            myfriends = JSON.parse(data);
            console.log(myfriends);
            conectedfriends();
        });
        if (first == 0){
            runme();
            first = 1;
        }
    }

    //INIT
    if (first == 0){ getfriends(); };

    //RUNME STARTS
    function runme(){ 
    
        console.log('Initializing COM client at 632');

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

            console.log('>>TOKEN: '+token);
            console.log('>>ROOM ID: '+String(room.roomID));
            console.log(room);
            console.log('>>-------------------------------------------------');

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
                    console.log('>> Stream suscribed!');
                    
                    var div = document.createElement('div');
                    div.setAttribute("style", "width: 320px; height: 240px;");
                    div.setAttribute("id", "test" + stream.getID());

                    document.body.appendChild(div);
                    stream.show("test" + stream.getID());
                    

                    //I recognize myself:
                    whoiamid = localStream.getID();
                    console.log('REMOTE STREAM ID: '+stream.getID()+'\nLOCAL STREAM:'+localStream.getID()
                        +'\nI AM '+GL.userdata.coder+' (ON GS3)  AND ID:'+whoiamid); 

                    //streams list (all users in the room)
                    var lostreams = room.remoteStreams;
                    console.log(room.remoteStreams);

                    /*---------------START UP SYNC MSG---------------*/
                    //I identify myself
                    broadcast(0,whoiamid,GL.userdata.coder,0,whatsmyname,'',state);

                    /*--------------------OTHER FUNCTIONS STARTS-------------------*/
                    function broadcast(type,mychatid,mygsid,towho,clearname,data,mystate){ 
                        localStream.sendData({
                            qtype:type,
                            qdata:data,
                            qid:mychatid,
                            qgsid:mygsid,
                            qwho:towho,
                            qname:clearname,
                            qstate:mystate
                        });
                    }

                    function msg(qmsg){
                        //when sending a message do I really need to get the friends again?
                        //getfriends();                  

                        //envio el mensaje a mi propia ventana desde fuera de los listeners de otr forma la acción se realiza en el otro usuario
                        localmsg($('#qinput').val());
                        //send message
                        broadcast(1,whoiamid,whoiam,0,whatsmyname,qmsg,state);

                        //clear the area
                        $('textarea#qinput').val('');
                        //console.log('Pasa mensaje: '+qmsg);
                    }

                    $("#elbutto").click(function() {
                        if ($('#qinput').val().length > 1){
                            msg($('#qinput').val()); 
                        }                    
                    });
                    //===== TIMER STARTS =====//    
                    //Increment the idle time counter every minute.
                    var idleInterval = setInterval(timerIncrement, idleseconds); // 1 minute

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

                    function timerIncrement() {
                        idleTime ++;
                        if (idleTime > 1) {
                            state = 0;
                            //conectedfriends();
                            //window.location.reload();
                            broadcast(0,whoiamid,whoiam,0,whatsmyname,'Status update to idle',state);
                        } else {
                            state = 1;
                        }
                        //console.log('oooooooooooooo TIMER: '+idleTime+ ' - MY STATE: '+state);
                    }
                    //===== TIMER ENDS =====//
                    /*--------------------OTHER FUCNTIONS ENDS---------------------*/

                    //MSG PROCESSING FUNCTION STARTS
                    stream.addEventListener("stream-data", function(evt){
                        console.log('Se ha recibido un mensaje del tipo:'+evt.msg.qtype);
                        //FORMAT: data|type|id|gsid|towhom
                        //0 => syncronization message
                        //1 => simple message to all listeners
                        //2 => simple message broacast to a single listener
                        
                        //console.log('MESSAGE HAS BEEN TRANSMITTED, qtype:'+evt.msg.qtype+' qid:'+evt.msg.qid+' qgsid:'+evt.msg.qgsid+' data:'+evt.msg.qdata+' qstate:'+evt.msg.qstate);
                        //el mensaje de sincronización solo sirve para ver si existo
                        if (evt.msg.qtype == 0){
                            console.log('- THIS IS A SYNCRONIZATION MSG FROM: '+evt.msg.qgsid+' CURRENT USER:'+GL.userdata.coder);

                            //change user's status to connected
                            //if it's not me who's sending the message then I take action
                            if (evt.msg.qgsid != GL.userdata.coder){
                                changefstat(evt.msg.qgsid,1);
                            }                            

                            //we look for the friend into the friends array:
                            /*
                            for (var hh = 0; hh < myfriends.length; hh++){
                                if (myfriends[hh][0] == evt.msg.qgsid){
                                    myfriends[hh][2] = whoiamid;
                                    myfriends[hh][3] = evt.msg.qstate;
                                }
                            }
                            */
                            /*
                            state = evt.msg.qstate;
                            conectedfriends();
                            */
                        } else if (evt.msg.qtype == 1){
                            //console.log('- THIS IS A MSG TO ALL LISTENERS');                         
                            
                            //click sound
                            var clickSound = new Audio('noerro.mp3');
                            clickSound.play();

                            //say I'm alive
                            if (evt.msg.qgsid != GL.userdata.coder){ changefstat(evt.msg.qgsid,1); }

                            //idleTime we force to zero so the counter starts again
                            idleTime = 0;
                            state = 1;
                            conectedfriends();

                            
                            //remote message
                            var tstamp = microtime();
                            $("#texto").append('<span class="singlemsg" title="'+mytime()+'"><strong>'+evt.msg.qname+': </strong>'+emoji(evt.msg.qdata)+'</span><span class="singlemsgdate"> </span><br><span class="singlemsgspace bottom5" id="sp'+tstamp+'"><br>&nbsp;<br></span>');
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
                    
                });

                room.addEventListener("stream-added", function (streamEvent) {
                    console.log('>> Stream Added!');
                    var streams = [];
                    streams.push(streamEvent.stream);
                    subscribeToStreams(streams);
                });

                room.addEventListener("stream-removed", function (streamEvent) {
                    console.log('>> Stream Removed!');                
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