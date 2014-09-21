$(document).ready(function() {

	$("#selectReq").change(function() {
		//alert('Changed to: '+$( "#selectReq" ).val());
		$( "#paymethod" ).attr('action', $("#selectReq").val());
		//get id 
		var elid = $("#selectReq").val().split('_');
		$( "#qidbank" ).val(elid[2]);
	});

});