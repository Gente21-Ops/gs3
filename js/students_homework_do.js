
console.log('STUDENTS_HOMEWORK_DO LOADED');

function ran(min,max){
    return Math.floor(Math.random()*(max-min+1)+min);
}

var tcount = 0;
var delfile = '';
var delobj = '';

//----PREVIOUS STEPS STARTS-----//
//check extension
function openFile(file) {
    var extension = file.substr( (file.lastIndexOf('.') +1) );
    switch(extension) {
        case 'gif':
        case 'GIF':
        case 'jpg':
        case 'jpeg':
        case 'JPG':
        case 'JPEG':
        case 'PNG':
        case 'png':
            return true;
    }
};
//check prev
function cprev(ela) {
    if (ela.indexOf("prev_") != -1){
        return true;
    }
};

//at start we set fancybox and setdel on all the pictures when we load
$( "ul#filelist li a" ).each(function( index, element ) {
    var li = $(element);

        var refo = li.attr("href");
        var namo = li.attr("data-namo");
        var ido = li.attr("id");

        //only get the data if it's prev_, otherwise will get the incorrect A        
        if (cprev(ido) == true){
            //fancybox
            if (openFile(refo) == true){
                li.fancybox({ 'hideOnContentClick': true });
            }

            //para borrar solo tomamos el nombre del archivo, no todo el path
            //esto sirve para cuando se jala de la DB, si no pues no
            var fonly = refo.split('/');    

            //setdel
            setdel(tcount,fonly[fonly.length - 1],namo);

            //por cada item subimos la cuenta del tcount
            tcount += 1;
        }
    
});
//----PREVIOUS STEPS ENDS-----//




$('#mod_wys').dialog({
    autoOpen: false, 
    width: 800,
    modal: true,
    hide: { effect: "fade", duration: 200 },
    buttons: {
        "Guardar": function() {
            $.post('clases/student/students_homework_do_simplesave.php', { qsimpleanswer:$('#editor').val(), qcodetareas:$('#qcodetareas').text() }, function(data) {

                var response = '<li class="by_user">'+
                    '<a href="#" title=""><img src="images/users/37/'+$('#qusercode').text()+'.jpg" alt=""></a>'+
                    '<div class="messageArea">'+
                        '<span class="aro"></span>'+
                        '<div class="infoRow">'+
                            '<span class="name">Respuesta de <strong>'+$('#qnick').text()+'</strong></span>'+
                            '<span class="time">'+$('#qansweredtime').text()+'</span>'+
                            '<div class="clear"></div>'+
                        '</div>'+$('#editor').val()+
                    '</div>'+
                    '<div class="clear"></div>'+
                '</li>';

                if (parseInt(data) == 1){
                    //$.jGrowl($('#savedo').html());
                    $('#larespuesta').html(response).show('slow');
                    $.jGrowl('Tu respuesta fue guarda. <br>No olvides completar la tarea!');
                    $('#mod_wys').dialog( "close" );
                } else {
                    $.jGrowl('Problema al guardar');
                    $('#mod_wys').dialog( "close" );
                }

            });
            
        },
        "Cancelar": function() {
            $( this ).dialog( "close" );
        }
    }
});

//show editor
$('#simpleanswer').click(function () {
    $('#mod_wys').dialog('open');
    
    return false;
});

//NOTA: no parece buena idea correr el edito hasta que no se abra la ventana
//pero falla si no se hace así
//editor
$("#editor").cleditor({
    width:"772", 
    height:"250px",
    bodyStyle: "margin: 10px; font: 12px Arial,Verdana; cursor:text",
    useCSS:true,
    controls:     // controls to add to the toolbar
          "bold italic underline strikethrough subscript superscript | font size " +
          "| color highlight removeformat | bullets numbering | "+
          "alignleft center alignright justify | undo redo | " +
          "rule link unlink | cut copy paste pastetext",
    bodyStyle: "margin:4px; font:10pt Arial,Verdana; cursor:text"
});


//new doc
$('#mod_pad').dialog({
    autoOpen: false, 
    width: 400,
    modal: true,
    hide: { effect: "fade", duration: 200 },
    buttons: {
        "Generar nuevo documento": function() {

            //let's first check that the document exists on GS
            $.post('clases/general/padCheck.php', { qpadname:$('#qpadname').val() }, function(rdata) {

                if (parseInt(rdata) != 0){
                    //alert('EL PAD YA EXISTE: '+rdata);

                    $.jGrowl('ABRIENDO EL DOCUMENTO EXISTENTE...');
                    assignme('students_pad?qcode='+rdata,'content');
                    $('#mod_pad').dialog( "close" );

                } else {
                    console.log('No existe el PAD!, se va a crear uno nuevo: '+rdata);

                    
                    $.post('clases/general/padCreate.php', { qpadname:$('#qpadname').val(), qpadtext:$('#qpadtext').val() }, function(pdata) {
                        var presp = pdata.split('ˆ');
                        if (presp[0] == '0'){
                            $.jGrowl('ERROR: '+presp[1]);
                            $('#mod_pad').dialog( "close" );
                        } else {
                            //console.log('NO SE ENCONTRÓ: '+pdata);                            
                            console.log('SUCCESS: '+presp[1]);                            
                            $.jGrowl('ESPERA UN MOMENTO MIENTRAS SE GENERA EL DOCUMENTO...');
                            assignme('students_pad?qcode='+presp[1],'content');
                            $('#mod_pad').dialog( "close" );
                            
                        }
                    });
                }

            });
            
        },
        "Cancelar": function() {
            $( this ).dialog( "close" );
        }
    }
});

$('#newpad').click(function () {
    $('#mod_pad').dialog('open');
    return false;
});


//----------------CHANGE PICTURE COMIENZA------------------//
//init de plupload
var uploader = new plupload.Uploader({
    runtimes : 'html5',
    browse_button: 'browse',
    dragdrop:true,
    drop_element : 'jalo',
    max_file_size : '20mb',
    /*chunk_size : '1mb',*/
    /*multipart: true,*/
    multi_selection : true,
    /*unique_names : true,*/    
    url: 'clases/uploadFiles.php?qusercode='+$('#qusercode').text()+'&qcodetareas='+$('#qcodetareas').text()+'&qcodeschool='+$('#qcodeschool').text()+'&r='+ran(1,5000),
    filters : [
            {title : "Image files", extensions : "gif,GIF,jpg,jpeg,png,PNG,JPG,JPEG,doc,docx,xlsx,ppt,pptx,pdf,bmp,mp3,mkv,avi,mpeg,flv,mov,torrent,csv,zip,rar,gzip,odt,ods,odp"}
        ],
    resize : {width : 1200, height : 900, quality : 86}
});
uploader.init();

uploader.bind('FilesAdded', function(up, files) {
  var html = '';
  var html1 = '';
  plupload.each(files, function(file) {
    tcount += 1;

    html1 += '<li class="currentFile" id="'+tcount+'">'
        +'<div class="fileProcess">'
        +'<img src="images/elements/loaders/10s.gif" alt="" class="loader" />'
        +'<strong>' + file.name + '</strong>'
        +'<div class="fileProgress" id="fprog_'+file.id+'">'
        +'<span>0Kb of '+plupload.formatSize(file.size)+'</span> - <span>0KB/sec</span>'
        +'</div>'           
        +'<div class="contentProgress" id="pcon_'+file.id+'"><div class="barG tipN" title="0%" id="'+file.id+'_prog"></div></div>'
        +'</div>'
    +'</li>';

    //html += '<li id="' + file.id + '">' + file.name + ' (' + plupload.formatSize(file.size) + ') <b></b></li>';
  });

  $('#filelist').append(html1);
  $('.tipN').tipsy({gravity: 'n',fade: true, html:true});
  //document.getElementById('filelist').innerHTML += html;
  //auto start
  uploader.start();
});

uploader.bind('UploadProgress', function(up, file) {
    var speed2 = parseInt(uploader.total.bytesPerSec/1024);
    $('#fprog_'+file.id).html('<span>'+Math.round(uploader.total.loaded/1024)+'Kb out of '+Math.round(uploader.total.size/1024)+'Kb</span> - <span>'+speed2+'Kb/sec</span>');
    $('#'+file.id+'_prog').attr('title',file.percent+'%');
    //console.log('POR: '+file.percent);
    var perc = Math.round( (file.percent * $('#pcon_'+file.id).width())/100 );
    //$('#fprog_'+file.id).html('%: '+file.percent+' WIDTHO:'+$('#pcon_'+file.id).width()+' WDECONT:'+perc);
    
    //hay un bug en el animate de jquery (en la versión que estamos usando)
    //$('#'+file.id+'_prog').animate({width: file.percent+'%'});
    $('#'+file.id+'_prog').width(perc+'px');

  //document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";
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
    console.log('HOLA '+res);

    var reto = JSON.parse(obj2.response);
    //console.log('DATO 3.6.1: isimg '+reto['isimg']);

    //we change png into jpg
    var newfn = reto['new'].replace('.png','.jpg');

    //en este caso sobreescribo el contenido del li
    var fileok = '<span class="fileSuccess"></span>'+file.name+' <span class="righto">'
    +'<a href="files/'+$('#qcodeschool').text()+'/'+newfn+'" data-namo="'+file.name+'" id="prev_'+tcount+'" target="_blank"><span class="icos-inbox" style="padding:0; margin-right:10px;"></span></a> '
    +'<a href="#" id="delo_'+tcount+'"><span class="icos-trash" style="padding:0; margin-right:0px;"></span></a></span>';
    $('#'+tcount).html(fileok);

    //if content is image we create a preview
    if (reto['isimg'] == '1'){
        console.log('THIS IS AN IMAGE!!!, setting up fancybox...');
        $("#prev_"+tcount).fancybox({ 'hideOnContentClick': true });
    }

    //setdel(file.id,reto['new'],file.name); 
    setdel(tcount,reto['new'],file.name);    

    $.jGrowl('El archivo '+file.name+' se subió correctamente');
    
});

function setdel(qobj,qfile,qname){

    console.log('-- SETTING DEL FOR OBJ : '+qobj);
    
    $('#delo_'+qobj).click(function () {

        console.log('INTENTANDO OBTENER DATOS DE: #delo_'+qobj);
        //ahora si asignamos
        var prevfile = $('#prev_'+qobj).attr('href').split('/');
        if (prevfile.length > 1){
            delfile = prevfile[prevfile.length - 1];
        } else {
            delfile = $('#prev_'+qobj).attr('href');
        }
        
        delobj = qobj;

        console.log('QUERIENDO BORRAR ARCHIVO: '+qfile+' - delfile:'+delfile+' - qobj:'+delobj);

        //al click vamos a tomar los datos desde el objeto y meterlos en memoria, para que la asignación sea correcta
        $('#deltexto').html('El archivo: <strong>'+$('#prev_'+qobj).attr('data-namo')+'</strong>('+delfile+')<br>será eliminado permanentemente');
        $('#mod_del').dialog('open');
        return false;
    });
}

//del file
$('#mod_del').dialog({
    autoOpen: false, 
    width: 550,
    modal: true,
    hide: { effect: "fade", duration: 200 }, //put the fade effect
    buttons: {
        "Aceptar": function() {

            //let's first check that the document exists on GS
            
            $.post('clases/delFile.php', { qdelfile:delfile }, function(ddata) {

                if (parseInt(ddata) != 0){
                    //we kill the li
                    $("#"+delobj).fadeOut( "slow", function() {
                        $("#"+delobj).remove();
                    });
                    console.log('Trying to remove object1: '+delobj);

                    $.jGrowl('El archivo se borró correctamente');
                } else {
                    $.jGrowl('Problema al borrar el archivo');
                }
                $('#mod_del').dialog( "close" );

            });
            
            
        },
        "Cancelar": function() {
            $( this ).dialog( "close" );
        }
    }
});


//----------------CHANGE PICTURE TERMINA------------------//