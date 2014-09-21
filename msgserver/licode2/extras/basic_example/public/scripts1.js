//var serverUrl = "/";
var serverUrl = "http://107.22.250.130:3001/";
var localStream, room;

var myfriends = new Array();

//WHO AM I 
//whoiam is the code for the user
var whoiam = "no one";
//whoiamid is the code from the chat
var whoiamid = 0;
var whatsmyname = "";
var whatsmyrole = 1;
var myroom = "any school";
var first = 0;

//timer vars, state: 1 active, 0 idle
var idleTime = 0;
var state = 1;
var idleseconds = 300000;

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
        ":=o":"Gasp.png"
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
    function conectedfriends(){
        //ok so we're gonna create a li per connected friend
        var salida = "";
        for (var mf=0; mf < myfriends.length; mf++){

            var elstate = 'status_available';
            if (myfriends[mf][3] == 0){
                elstate = 'status_away';
            } else if (myfriends[mf][3] != "undefined" || myfriends[mf][3] == 1){
                elstate = 'status_available';
            }
            console.log('Friend ('+myfriends[mf][0]+') state: '+myfriends[mf][3]);

            //if the peer is connected we show him
            if (String(myfriends[mf][2]) != "undefined"){
                salida += "<li id='li_"+myfriends[mf][0]+"' peer='li_"+myfriends[mf][2]+"'><a href='#' title=''><img src='images/users/37/"+myfriends[mf][0]+".jpg' alt='' />"
                +"<span class='contactName'>"
                +"<strong>"+myfriends[mf][1]+" <span>(5)</span></strong>"
                +"<i>web &amp; ui designer</i>"
                +"</span>"
                +"<span class='"+elstate+"'></span>"
                +"<span class='clear'></span>"
                +"</a>"
                +"</li >";
            }
        }
        console.log('Creating friend\'s list');
        $('#myfirends').html(salida);
    }
    //list of connected friends ends

    //we get friend's list from server
    function getfriends(){
        console.log('>> getting list of friends...');
        $.post( "clases/ui/getfriends.php", function( data ) {
            console.log('>>Amigos 0:');
            console.log(data);
            //I get my own data first:
            var who = data.split('^');
            whoiam = who[0];
            whatsmyname = who[3];
            whatsmyrole = who[4];
            //alert(whoiam);
            var friends = who[1].split('~');
            var into = new Array();
            for (var h = 0; h < friends.length; h++){
                into = [];
                into = friends[h].split('|');
                console.log('>>Amigos 1:');
                console.log(into);
                var frodos = new Array();
                frodos[0] = into[0];
                frodos[1] = into[1];
                frodos[2] = into[2];
                frodos[3] = into[3];
                myfriends[h] = frodos;
                console.log('>>Amigos 2:');
                console.log(myfriends);
            }

            //IF INIT
            if (first == 0){ first = 1; runme(); }
            
            //MY SCHOOL
            myroom = who[2];
        });
    }

    //INIT
    if (first == 0){ getfriends();  }

    //RUNME STARTS
    function runme(){ 
    
        console.log('Initializing COM client at 632, hello I am ID: '+whoiam);

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
                console.log('>> Access accepted!');
                var subscribeToStreams = function (streams) {
                    for (var index in streams) {
                        var stream = streams[index];
                        if (localStream.getID() !== stream.getID()) {
                            room.subscribe(stream);
                        }
                    }
                };

                room.addEventListener("room-connected", function (roomEvent) {
                    console.log('>> Connected to room!');
                    console.log(roomEvent.streams)
                    //room.publish(localStream, {maxVideoBW: 300});
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
                        +'\nI AM '+whoiam+' (ON GS3)  AND ID:'+whoiamid);

                    //streams list (all users in the room)
                    var lostreams = room.remoteStreams;
                    console.log(room.remoteStreams);

                    //MSG PROCESSING FUNCTION STARTS
                    stream.addEventListener("stream-data", function(evt){
                        //FORMAT: data|type|id|gsid|towhom
                        //0 => syncronization message
                        //1 => simple message to all listeners
                        //2 => simple message broacast to a single listener
                        
                        //console.log('MESSAGE HAS BEEN TRANSMITTED, qtype:'+evt.msg.qtype+' qid:'+evt.msg.qid+' qgsid:'+evt.msg.qgsid+' data:'+evt.msg.qdata+' qstate:'+evt.msg.qstate);
                        if (evt.msg.qtype == 0){
                            //console.log('- THIS IS A SYNCRONIZATION MSG');
                            //we look for the friend into the friends array:
                            for (var hh = 0; hh < myfriends.length; hh++){
                                if (myfriends[hh][0] == evt.msg.qgsid){
                                    myfriends[hh][2] = whoiamid;
                                    myfriends[hh][3] = evt.msg.qstate;
                                }
                            }
                            
                            state = evt.msg.qstate;
                            conectedfriends();
                        } else if (evt.msg.qtype == 1){
                            //console.log('- THIS IS A MSG TO ALL LISTENERS');
                            //document.getElementById("sound").innerHTML="<embed src='noerro.mp3' hidden=true autostart=true loop=false>";                          
                            var clickSound = new Audio('noerro.mp3');

                            //we look for the friend into the friends array on order to update state:
                            for (var hh = 0; hh < myfriends.length; hh++){
                                if (myfriends[hh][0] == evt.msg.qgsid){
                                    //I force the state to one, since I am sure that he is passing a msg along
                                    myfriends[hh][3] = 1;
                                    
                                }
                            }
                            //idleTime we force to zero so the counter starts again
                            idleTime = 0;
                            state = 1;
                            conectedfriends();

                            clickSound.play();
                            //console.log('Received data '+evt.msg.qdata+' from stream');
                            //remote message
                            var tstamp = microtime();
                            $("#texto").append('<span class="singlemsg" title="'+mytime()+'"><strong>'+evt.msg.qname+': </strong>'+emoji(evt.msg.qdata)+'</span><span class="singlemsgdate"> </span><br><span class="singlemsgspace bottom5" id="sp'+tstamp+'"><br>&nbsp;<br></span>');
                            //by forcing the recalculation the scrollbar appears
                            
                            //$(".nano").nanoScroller({ scroll: 'bottom' });
                            $(".nano").nanoScroller();
                            $(".nano").nanoScroller({ scrollTo: $('#sp'+tstamp)}); 
                            //

                            //local message
                            //$("#texto").append('<span class="singlemsg"><strong>'+evt.msg.qname+': </strong>'+evt.msg.qdata+'</span><span class="singlemsgdate"><br>'+mytime()+'</span><span class="singlemsgspace"><br><br></span>').slideDown("slow");
                            
                            
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

                /*--------------------OTHER FUNCTIONS STARTS-------------------*/
                function broadcast(type,mychatid,mygsid,towho,clearname,data,mystate){
                    //FORMAT: data|type|id|gsid|towhom
                    //console.log('Broadcasting clearname: '+clearname);
                    /*-----POR AHORA ENVIA LOPS MENSAJES SOLO A TODOS LOS USUARIOS!!!!----*/
                    localStream.sendData({qtype:type,qdata:data,qid:mychatid,qgsid:mygsid,qwho:towho,qname:clearname,qstate:mystate});
                }

                function msg(qmsg){
                    //when sending a message do I really need to get the friends again?
                    getfriends();
    
                    //$('#content').html('<br><strong><span style="font-size:50px">MESSAGE ON OWN WINDOW</span></strong>');

                    //I identify myself
                    broadcast(0,whoiamid,whoiam,0,whatsmyname,'Inscribeme',state);

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

                //localStream.show("myVideo");

            });
        
        localStream.init();
        });

    //RUNME ENDS
    }


};