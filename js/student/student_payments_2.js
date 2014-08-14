$(document).ready(function() {
	
	$("#elpbut").click(function() {
		$('#bankdata').show().printElement();
	});

	function password(length, special){
		var iteration = 0;
		var password = "";
		var randomNumber;
		if(special == undefined)
		{
		  var special = false;
		}
		while(iteration < length)
		{
			randomNumber = (Math.floor((Math.random() * 100)) % 94) + 33;
			if(!special)
			{
				if ((randomNumber >=33) && (randomNumber <=47)) { continue; }
				if ((randomNumber >=58) && (randomNumber <=64)) { continue; }
				if ((randomNumber >=91) && (randomNumber <=96)) { continue; }
				if ((randomNumber >=123) && (randomNumber <=126)) { continue; 
			}
		}
		iteration++;
		password += String.fromCharCode(randomNumber);
		}
		return password;
	}

	//QR
	var draw_qrcode = function(text, typeNumber, errorCorrectLevel) {
		document.write(create_qrcode(text, typeNumber, errorCorrectLevel) );
	};

	var create_qrcode = function(text, typeNumber, errorCorrectLevel, table) {

		var qr = qrcode(typeNumber || 4, errorCorrectLevel || 'M');
		qr.addData(text);
		qr.make();

	//	return qr.createTableTag();
		return qr.createImgTag();
	};

	var update_qrcode = function() {
		var text = document.getElementById('msg').value.
		replace(/^[\s\u3000]+|[\s\u3000]+$/g, '');
		document.getElementById('qr').innerHTML = create_qrcode(text);
	};

	//QR INIT
	update_qrcode();

	function logo(text){
		alert(text);
	}

	//puupload
	var uploader = new plupload.Uploader({
	    runtimes : 'html5,html4,flash,silverlight',
	    drop_element : 'jalo',
	    container : 'container',
	    browse_button : 'elubut',
	    max_file_size : '20mb',
	    unique_names : true,
		multi_selection : false,	    
	    url : 'clases/uploadPicsReceipts.php',
	    flash_swf_url : 'js/plupload/js/plupload.flash.swf',
	    silverlight_xap_url : 'js/plupload/js/plupload.silverlight.xap',
	    filters : [
	        {title : "Image files", extensions : "jpg,jpeg,gif,png,PNG,JPG,JPEG"}
	    ],
	    resize : {width : 1200, height : 900, quality : 65}
	});

	uploader.bind('Init', function(up, params)
	{
		//alert("INIT Uploaderup6fix RUN:"+params.runtime);
		
	});
	
	uploader.init();
	
	uploader.bind('FilesAdded', function(up, files)
	{	
		$('#cuenta').show();
		///THIS CHANGES THE WIDTH AND HEIGHT DINAMYCALY
		uploader.start();
		up.refresh(); // Reposition Flash/Silverlight
	});

	uploader.bind('UploadProgress', function(up, file)
	{
		$('#bar10').attr('title',file.percent+"%");
		$('#filo').text(file.name);
		$('#sizo').text(file.loaded+' / '+file.size);
		$('#speedo').text(up.total.bytesPerSec+'KB/s');
		//$('#' + file.id + " b").html(file.percent + "%");
	});

	uploader.bind('Error', function(up, err)
	{
		logo("Error code: " + err.code);
		logo("Error: " + err.message);
		logo("Error file: " + err.file.name);
		up.refresh(); // Reposition Flash/Silverlight
	});

	uploader.bind('FileUploaded', function(up, file) {
		$('#cuenta').hide('slow');
		var language = $("#language").html();
		var qcucode = $("#qcucode").text();
		var newpicode = password(16);
		var newimg = file.target_name.toLowerCase(file.target_name);
		
		newimg = newimg.replace('png','jpg');
		newimg = newimg.replace('jpeg','jpg');

		//confirm payment
		sendpay(qcucode,file.target_name);

	});
	
	uploader.bind('UploadComplete', function(file)
	{
        //logo('All images have been uploaded: '+file.target_name);            
    });


function sendpay(eltoko,elimago,elcodeuser){
	$.post("clases/student/setPayment.php", { token:eltoko, image:elimago }, function(returno) {
	  if (parseInt(returno) == 1){
	  	//alert('Payment completed');

	  	$('#dialog').dialog('open');

	  } else {
	  	alert('Payment problem, please contact the site\'s administrator');
	  }
	})
}



$('#dialog').dialog({
    autoOpen: false,
    width: 400,
    modal: true,
    buttons: {
        " OK ": function () {
            //$(this).dialog("close");
            window.location.href = "student_payments";
        }
    }
});


});