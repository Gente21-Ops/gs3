console.log('PROFESSOR HOMEWORK SE PRESENTA 0634');
var loadme;
var tcount = 0;
var delfile = '';
var delobj = '';

//localization (solo cuando hay calendario de UI)
var qlen = '';
if ($('#qlang').text() == 'es'){
	qlen = "js/datatablesloc/dataTables.spanish.txt";
} else if ($('#qlango').text() == 'en'){
	qlen = "js/datatablesloc/dataTables.english.txt";
} else if ($('#qlango').text() == 'fr'){
	qlen = "js/datatablesloc/dataTables.francais.txt";
}
console.log(qlen);

//new task date
$.datepicker.regional[$('#qlang')];
$( ".datepicker1" ).datepicker({ 
    defaultDate: +7,
    showOtherMonths:true,
    autoSize: true,
    dateFormat: 'yy-mm-dd',
    onSelect: function(dateText) {
        $(this).change();
    }   
}).change(function() {
    //window.location.href = "index.php?date=" + this.value;
    var dater = this.value.split('-');
    //assignme('professor_takelist.php?qcode='+$('#qidgrupo').text()+'&qmat='+$('#qidmat').text()+'&y='+dater[0]+'&m='+dater[1]+'&d='+dater[2],'content'); return false;
});

//EDITABLE
oTable = $('.dTable').dataTable({
	"oLanguage": {
        sEmptyTable:     "No hay información por el momento.",
        sZeroRecords: "No hay información por el momento."
    },
	"bJQueryUI": false,
	"bAutoWidth": false,
	"sPaginationType": "full_numbers",
	"sDom": '<"H"fl>t<"F"ip>',
	"sAjaxSource": 'clases/profesor/professor_homework.php?qgroupid='+$('#groupid').text(),
	"fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
		$(nRow).attr('id', aData[0]);
		return nRow;
	},
	aoColumns: [{
        sName: "idtareas",
        bSearchable: false,
		bVisible: false
    },
    {
    	sName: "nombre"
    },
    {
    	sName: "descripcion"
    },
    {
    	sName: "fechaEntrega"
    },
    {
    	sName: "editar"
    },
    {
    	sName: "revisar"
    }] 

}).makeEditable({
sAddURL: "clases/profesor/homework_add.php",
sDeleteURL: "clases/profesor/homework_delete.php",
sUpdateURL: "clases/profesor/homework_update.php",
fnOnAdded: function(){     
        $.jGrowl('Registro agregado.');
    },
    fnOnDeleted: function(){    
        $.jGrowl("Registro eliminado.");
    },
    fnOnEdited: function(){     
        $.jGrowl("Registro actualizado.");
    }
});

//select on click
$("div.dyn2 > table > tbody > tr").click(function(){
    $(this).closest('table tbody tr').addClass('thisRow');
});

//----------------UPLOAD FILES STARTS------------------//
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
    console.log('HOLA '+res);

    var reto = JSON.parse(obj2.response);

    //we change png into jpg
    var newfn = reto['new'].replace('.png','.jpg');

    //en este caso sobreescribo el contenido del li
    var fileok = '<span class="fileSuccess"></span>'+file.name+' <span class="righto">'
    +'<a href="files/'+$('#qcodeschool').text()+'/'+newfn+'" data-namo="'+file.name+'" id="prev_'+tcount+'" target="_blank"><span class="icos-inbox" style="padding:0; margin-right:10px;"></span></a> '
    +'<a href="#" id="delo_'+tcount+'"><span class="icos-trash" style="padding:0; margin-right:0px;"></span></a></span>';
    $('#filelist').html(fileok);

    //if content is image we create a preview
    if (reto['isimg'] == '1'){
        console.log('THIS IS AN IMAGE!!!, setting up fancybox...');
        $("#prev_"+tcount).fancybox({ 'hideOnContentClick': true });
    }

    setdel(tcount,reto['new'],file.name);    

    $.jGrowl('El archivo '+file.name+' se subió correctamente');
    
});
//----------------UPLOAD FILES ENDS------------------//

function setdel(qobj,qfile,qname){

    GL.consol('-- SETTING DEL FOR OBJ : '+qobj);
    GL.consol(arguments);
    /*
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
*/
}

/*
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
*/