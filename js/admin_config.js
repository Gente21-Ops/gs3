
console.log('STUDENTS_CONFIG LOADED 810');

//----------------FORMA DE DATOS COMIENZA------------------//
//form stuff
$(".maskPhone").mask("(999) 999-9999");
$.datepicker.regional[$('#qlang')];
$( ".datepicker" ).datepicker({ 
	defaultDate: +7,
	showOtherMonths:true,
	autoSize: true,
	appendText: '(yyyy-mm-dd)',
	dateFormat: 'yy-mm-dd',
	changeMonth: true,
  	changeYear: true,
  	yearRange: '1930:2014'  	
});

//saving logic
$( "#sendo" ).click(function(e) {
	//al click escondemos el botón para evitar doble click
	$( "#sendo" ).attr("disabled", "disabled");
	$( "#sendo" ).hide();
	
	$.post( "clases/admin/admin_config.php", { 
		name: $('#name').val(), 
		last: $('#last').val(),
		nick: $('#nick').val(),
		//address: $('#address').val(),
		calle_num: $('#calle_num').val(),
		colonia: $('#colonia').val(),
		zip_code: $('#zip_code').val(),
		municipio: $('#municipio').val(),
		estado: $('#estado').val(),
		tel: $('#tel').val(),
		email: $('#email').val(),
		birth: $('#birth').val(),
		code: $('#code').val() }, 
		function( data ) {
			//el callback de php debe regresar un 1 (significa que todo fue ok)
			if (Number(data) == '1'){
				$.jGrowl($('#savedo').html());
				$( "#sendo" ).show();
				$( "#sendo" ).removeAttr("disabled");
			} else {
				$.jGrowl($('#qerror').html());
			}
		});
	e.preventDefault();
});
//----------------FORMA DE DATOS TERMINA------------------//



//----------------CHANGE PICTURE COMIENZA------------------//
//init de plupload
var uploader = new plupload.Uploader({
	runtimes : 'html5',
	browse_button: 'browser', // this can be an id of a DOM element or the DOM element itself
	//drop_element : 'jalo',
	max_file_size : '20mb',
	multi_selection : false,
	url: '../clases/uploadPics.php?qcode='+$('#code').val(),
	filters : [
	        {//title : "Image files", extensions : "jpg,jpeg,png,PNG,JPG,JPEG"}
	        title : "Image files", extensions : "jpg,jpeg,JPG,JPEG"}
	    ],
	resize : {width : 1200, height : 900, quality : 86}
});
uploader.init();

uploader.bind('FilesAdded', function(up, files) {
  var html = '';
  var html1 = '';
  plupload.each(files, function(file) {

  	html1 = '<li class="currentFile" id="'+file.id+'">'
  		+'<div class="fileProcess">'
	    +'<img src="images/elements/loaders/10s.gif" alt="" class="loader" />'
	    +'<strong>' + file.name + '</strong>'
	    +'<div class="fileProgress">'
	    +'<span>9.1 of '+plupload.formatSize(file.size)+'</span> - <span>243KB/sec</span> - <span>1 min</span>'
	    +'</div>'	        
	    +'<div class="contentProgress"><div class="barG tipN" title="61%" id="'+file.id+'_prog"></div></div>'
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
	$('#'+file.id+'_prog').attr('title',file.percent+'%');
	//console.log('POR: '+file.percent);
	$('#'+file.id+'_prog').animate({width: file.percent+'%'});
  //document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";
});


uploader.bind('Error', function(up, err) {
  //document.getElementById('console').innerHTML += "\nError #" + err.code + ": " + err.message;
  $.jGrowl('ERROR: ' + err.code + ": " + err.message);
});

uploader.bind('FileUploaded', function(up, file, res) {

	//en este caso sobreescribo el contenido del li
	var fileok = '<span class="fileSuccess"></span>'+file.name+'<span class="remove"></span>';
	$('#'+file.id).html(fileok);

	//THIS DOESN'T WORK
	/*
	$(".remove").click(function() {
		$(this).parent('li').fadeTo(200, 0.00, function(){ //fade
			$(this).slideUp(200, function() { //slide up
				$(this).remove(); //then remove from the DOM
			});
		});
	});
	*/

    $('#elusero').attr('src', $('#elusero').attr('src')+'?'+Math.random()).show('slow');
    $('#elusero320').attr('src', $('#elusero320').attr('src')+'?'+Math.random()).show('slow');
    $('#elusero').attr('original-title', "<img src='images/users/320/"+$('#quser').text()+".jpg?m="+Math.random()+"' style='width:200px; height:200px;'>");
    $.jGrowl($('#qimgchanged').html());
});

//----------------CHANGE PICTURE TERMINA------------------//



//----------------STATS COMIENZA------------------//
$("#progress").progressbar({ value: 80  });
$("#progress1").progressbar({ value: 20  });
//----------------STATS TERMINA------------------//
