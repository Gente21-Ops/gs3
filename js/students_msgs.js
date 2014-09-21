
console.log('STUDENTS_MSGS LOADED 1654');
function ran(min,max){
    return Math.floor(Math.random()*(max-min+1)+min);
}

var msgid = 0;

//objeto y tipo a flagear
var q_fobject = '';
var q_ftype = '';
var q_respid = '';

//imgs
var tcount = 0;
var delfile = '';
var delobj = '';

//image collection
var coll = new Array();

var filbuffer = new Array();

function addcomment(obj){
    var qresp = $('#msgbox_'+obj).val();
    if (qresp.length > 1){
        console.log('ADDING COMMENT: '+qresp +' ON OBJECT:'+obj);

        //if there are images let's set them up too
        var exitpics = '';
        if (coll.length > 0){
            exitpics = coll.join('|');
        }

        //send msg to db
        $.post('clases/streamInsert.php', { qmsgid:obj, qcodeschool:$('#qescuelacode').text(), qiduser:$('#quser').text(), qmsg:qresp, qtowho:'0', qpics:exitpics }, function(data) {
            if (data.length > 5){
                var resp = '<li class="by_me" id="resp_'+data+'">'+
                        '<a href="#" title=""><img src="images/users/37/'+$('#quser').text()+'.jpg" alt="" /></a>'+
                        '<div class="messageArea">'+
                        '<span class="aro"></span>'+
                            '<div class="infoRow">'+
                                '<span class="name"><strong>'+$('#qnick').text()+'</strong> says:</span>'+
                                '<span class="time">NEW <a onclick="openflag(\''+obj+'\',\'1\',\''+data+'\')"><img src="images/icons/usual/icon-flag.png"></a></span>'+
                                '<div class="clear"></div>'+
                            '</div>'+qresp+
                        '</div>'+
                        '<div class="clear"></div>'+
                   '</li>';
                $('#msg_'+obj).append(resp).hide().fadeIn('slow');
                $('#msgbox_'+obj).val('');
            }

            //we clear up the pics collection
            coll = [];

        });        
    }
}

//false=name, true=ext
function ext(qs,type){
    var namo = qs.split('.');
    return namo[type];
}

//send message to all
function allmsg () {
    console.log('Sendin MSG to everybody');

    //if there are images let's set them up too
    var exitpics = '';
    if (coll.length > 0){
        exitpics = coll.join('|');
    }
    
    $.post('clases/streamAdd.php', { qscode:$('#qescuelacode').text(), quser:$('#quser').text(), qmsg:$('#msgbox').val(), qtowho:'0', qpics:exitpics }, function(data) {
        if (data != ''){

            //we clear up the prev gallery
            $('#addpics').html('');

            //img gall
            var galsal = '';
            if (coll.length > 0){
                
                for (var g=0; g<coll.length; g++){
                    var newfn = coll[g].replace('.png','.jpg');
                    var jname = ext(coll[g],0);
                    galsal += '<div class="imgal" id="gi_'+jname+'"><a href="files/'+$('#qescuelacode').text()+'/'+newfn+'" class="c_'+data+'" rel="c_'+data+'" id="prev_'+jname+'" target="_blank"><img class="imgalin" class="imgalin" src="files/'+$('#qescuelacode').text()+'/120/'+newfn+'"></a></div>'
                    //galsal += '<div id="imgal_'+jname+'">'+fileok+'</div>'
                    //$("#prev_"+justcodo[0]).fancybox({ 'hideOnContentClick': true });
                }
            }

            var msgr = '<ul class="messagesOne" id="msg_'+data+'">'+
                '<li class="by_user">'+
                    '<a href="#" title=""><img src="images/users/37/'+$('#quser').text()+'.jpg" alt="" /></a>'+
                    '<div class="messageArea">'+
                        '<span class="aro"></span>'+
                        '<div class="infoRow">'+
                            '<span class="name" id="qname_'+data+'"><strong>'+$('#qnick').text()+'</strong> says:</span>'+
                            '<span class="time">NEW <a onclick="openflag(\''+data+'\',\'2\',\'0\')"><img src="images/icons/usual/icon-flag.png"></a></span>'+
                            '<div class="clear"></div>'+
                        '</div>'+$('#msgbox').val()+
                        ///GALL
                        '<div id="addpics_'+data+'" style="margin-top:10px; width:100%;">'+galsal+'</div>'+
                        '<div class="clear"></div>'+
                        '<div class="enterMessage">'+
                            '<input type="text" name="enterMessage"  onkeydown="if (event.keyCode == 13) addcomment(\''+data+'\');" placeholder="Reply to post..." id="msgbox_'+data+'" style="padding: 10px 45px 10px 10px;" />'+
                            '<div class="sendBtn">'+
                                '<!--<a href="#" title="" class="attachPhoto"></a>'+
                                '<a href="#" title="" class="attachLink"></a>-->'+
                            '</div>'+    
                        '</div>'+
                    '</div>'+
                    '<div class="clear"></div>'+
                '</li></ul>'+
                '<div class="divider"><span></span></div>';

            $('#lesmesg').prepend(msgr);
            $('#msgbox').val('');

            //imgal
            $("a.c_"+data).fancybox({
                'cyclic': true,
                'hideOnContentClick': true,
                'speedIn'       :   600, 
                'speedOut'      :   200,
                'showNavArrows' :   true,
                'closeBtn'   : true,
                'closeClick' : true,
                'overlayShow'   :   false
            });

            //we clear up the pics collection
            coll = [];

            //we  put the gallery back at its place
            $('#addpics').prependTo('#lesmesg');

        }
    });

}


//msg flagging
$('#diaflag').dialog({
    autoOpen: false,
    width: 600,
    modal: true,
    buttons: {
        "Yes, flag this message": function () {
            $.post('clases/streamFlag.php', { qmsgid:q_fobject, qcodeschool:$('#qescuelacode').text(), qtype:q_ftype, qrespid:q_respid }, function(data) {
                if (data == 'ok'){

                    if (q_ftype == '2'){
                        $('#msg_'+q_fobject).fadeOut("slow", function(){ $(this).remove();  });
                    } else if (q_ftype == '1'){
                        $('#resp_'+q_respid).fadeOut("slow", function(){ $(this).remove();  });
                    }
                    $.jGrowl('The message has been flagged for review');
                    $('#diaflag').dialog("close");
                }
            });
        },
        "Cancel": function () {
            $(this).dialog("close");
        }
    }
});
function openflag(obj,type,qrespid){
    console.log('Gonna flag msg:'+obj+' type:'+type+' respid:'+qrespid);
    q_fobject = obj;
    q_ftype = type;
    q_respid = qrespid;
    $('#diaflag').dialog('open');
}


//modal wait
/*
$('#diawait').dialog({
    autoOpen: false,
    width: 600,
    modal: true,
    closeOnEscape: false,
    open: function(event, ui) { $(".ui-dialog-titlebar-close", ui.dialog || ui).hide(); }
)};
*/

var uploader = new plupload.Uploader();
//PICS
function setpl(obj){

    uploader.destroy();
    //init de plupload
    uploader = new plupload.Uploader({
        runtimes : 'html5',
        browse_button: obj,
        max_file_size : '20mb',
        multi_selection : true,
        /*unique_names : true,*/    
        url: '../clases/uploadFiles.php?qusercode='+$('#quser').text()+'&qcodetareas=0&qcodeschool='+$('#qescuelacode').text()+'&r='+ran(1,5000),
        filters : [
                {title : "Image files", extensions : "gif,GIF,jpg,jpeg,png,PNG,JPG,JPEG"}
            ],
        resize : {width : 1200, height : 900, quality : 86}
    });
    uploader.init();


    uploader.bind('FilesAdded', function(up, files) {
      var html = '';
      var html1 = '';
      plupload.each(files, function(file) {
        tcount += 1;

        html1 += '<div id="imgal_'+file.id+'" class="imgal"><ul id="filelist" class="filesDown"><li class="currentFile" style="margin:0;" id="'+tcount+'">'
            +'<div class="fileProcess">'
            +'<img src="images/elements/loaders/10s.gif" alt="" class="loader" />'
            +'<strong>' + file.name + '</strong>'
            +'<!--<div class="fileProgress" id="fprog_'+file.id+'">'
            +'<span>0Kb of '+plupload.formatSize(file.size)+'</span> - <span>0KB/sec</span>'
            +'</div>-->'           
            +'<div class="contentProgress" id="pcon_'+file.id+'"><div class="barG tipN" title="0%" id="'+file.id+'_prog"></div></div>'
            +'</div>'
        +'</li></ul></div>';

        //html += '<li id="' + file.id + '">' + file.name + ' (' + plupload.formatSize(file.size) + ') <b></b></li>';
      });

      $('#addpics').append(html1);
      $('.tipN').tipsy({gravity: 'n',fade: true, html:true});
      //auto start
      uploader.start();
    });

    uploader.bind('UploadProgress', function(up, file) {
        var speed2 = parseInt(uploader.total.bytesPerSec/1024);
       // $('#fprog_'+file.id).html('<span>'+Math.round(uploader.total.loaded/1024)+'Kb out of '+Math.round(uploader.total.size/1024)+'Kb</span> - <span>'+speed2+'Kb/sec</span>');
        $('#'+file.id+'_prog').attr('title',file.percent+'%');
        //console.log('POR: '+file.percent);
        var perc = Math.round( (file.percent * $('#pcon_'+file.id).width())/100 );
        $('#'+file.id+'_prog').width(perc+'px');
    });


    uploader.bind('Error', function(up, err) {
      //document.getElementById('console').innerHTML += "\nError #" + err.code + ": " + err.message;
      if (err.code == '-600'){
        $.jGrowl('ERROR: ¡Archivo demasiado grande!, el peso máximo es 20MB');
      } else if (err.code == '-200'){
        $.jGrowl('ERROR: Porfavor sube hasta tres archivos a la vez');
      } else {
        $.jGrowl('ERROR: ' + err.code + ": " + err.message);
      }
      
    });

    uploader.bind('FileUploaded', function(up, file, res) {

        //parsing json:
        var obj2 = eval(res);

        console.log(res);
        

        var reto = JSON.parse(obj2.response);
        //console.log('DATO 3.6.1: isimg '+reto['isimg']);

        //we change png into jpg
        var newfn = reto['new'].replace('.png','.jpg');

        var justcodo = reto['new'].split('.');

        console.log('TRYING TO REPLACE CONTENT IN: imgal_'+file.id);

        //en este caso sobreescribo el contenido del li
        var fileok = '<a href="files/'+$('#qescuelacode').text()+'/'+newfn+'" data-namo="COCO_'+justcodo[0]+'" id="prev_'+justcodo[0]+'" target="_blank"><img class="imgalin" src="files/'+$('#qescuelacode').text()+'/120/'+newfn+'"></a>'
        
        $('#imgal_'+file.id).html(fileok);
        
        //we add top the list of new images to save
        coll.push(reto['new']);
        
        console.log('THIS IS AN IMAGE!!!, setting up fancybox to prev_'+justcodo[0]+' COL:'+coll.length);
        $("#prev_"+justcodo[0]).fancybox({ 'hideOnContentClick': true });

            

        $.jGrowl('El archivo '+file.name+' se subió correctamente');
        
    });
}

//trigger function
function fireup(obj){
    //console.log('Trying to change PL to 1 '+obj);
    setpl(obj);
}

//on init let's setup all the galleries
$('[id^="msg_"]').each(function(index){

    var qid = $(this).attr('id').split('_');
    //$("a.c_"+data).fancybox({

    //console.log('Trying to setup fancybox on: '+qid[1]);
    
    $("a.c_"+qid[1]).fancybox({
        'cyclic': true,
        'hideOnContentClick': true,
        'speedIn'       :   600, 
        'speedOut'      :   200,
        'showNavArrows' :   true,
        'closeBtn'   : true,
        'closeClick' : true,
        'overlayShow'   :   false
    });
});

//delete image (id del objeto, filename)
//this is for the images that are already on DB
function picdel(qid,qfile,qtyper){
    console.log('Tratando de borrar '+qfile+'  de la faz de la tierra');
    $.post('clases/streamDelPic.php', { qid:qid, qfile:qfile, quser:$('#quser').text(), qtype:qtyper, qcodeschool:$('#qescuelacode').text() }, function(data) {
        if (data == 'ok'){
            $('#gi_'+ext(qfile,0)).fadeOut(400, function(){
                $('#gi_'+ext(qfile,0)).remove();
            });
        }
    });
}