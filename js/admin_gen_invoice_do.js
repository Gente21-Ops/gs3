
console.log('ADMIN_GEN_INVOICE_DO LOADED 1853');

Number.prototype.formatMoney = function(c, d, t){
var n = this, 
    c = isNaN(c = Math.abs(c)) ? 2 : c, 
    d = d == undefined ? "." : d, 
    t = t == undefined ? "," : t, 
    s = n < 0 ? "-" : "", 
    i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "", 
    j = (j = i.length) > 3 ? j % 3 : 0;
   return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
 };

//saving fiscal data
$( "#sendo" ).click(function(e) {
	console.log('Getting info...');
	//al click escondemos el botón para evitar doble click
	$( "#sendo" ).attr("disabled", "disabled");
	$( "#sendo" ).hide();
	
	$.post( "clases/admin/savefiscal.php", { 
		name: $('#name').val(), 
		dom_rfc: $('#dom_rfc').val(),
		dom_calle: $('#dom_calle').val(),
		dom_ext: $('#dom_ext').val(),
		dom_col: $('#dom_col').val(),
		dom_loc: $('#dom_loc').val(),
		dom_mun: $('#dom_mun').val(),
		dom_ref: $('#dom_ref').val(),
		dom_estado: $('#dom_estado').val(),
		dom_pais: $('#dom_pais').val(),
		dom_cp: $('#dom_cp').val(),
		code: $('#qcode').text() },

		function( data ) {
			//$.jGrowl(data);
			if (data == '1'){
				$.jGrowl($('#savedo').html());
				$( "#sendo" ).show();
				$( "#sendo" ).removeAttr("disabled");
			} else {
				$.jGrowl("ERROR: "+data);
			}
			
			
		});
	e.preventDefault();
});
//----------------FORMA DE DATOS TERMINA------------------//



//----------------ADDING ITEMS COMIENZA------------------//
var ic = 1;


function additemo(){

	var itemo = '<div class="formRow fluid" id="itemo_'+ic+'" data-index="'+ic+'">'+
	    '<span class="grid4">'+
	        '<input type="text" id="i_'+ic+'_desc" data-enco="no" value="" placeholder="'+$('#p_desc').text()+'"  class="tipS" onblur="revdesc(\''+ic+'\');" />'+
	    '</span>'+
	    
	    '<span class="grid1">'+
	        '<input type="text" id="i_'+ic+'_cant" value="1" placeholder="'+$('#p_cant').text()+'" onblur="revalo(\''+ic+'\');" />'+
	    '</span>'+
	    
	    '<span class="grid2">'+
	        '<input type="text" id="i_'+ic+'_uni" value="0.00" placeholder="'+$('#p_uni').text()+'" onblur="revalo(\''+ic+'\');" />'+
	    '</span>'+

	    '<span class="grid1">'+
	        '<input type="text" id="i_'+ic+'_late" value="0" placeholder="'+$('#p_late').text()+'"  onblur="revalo(\''+ic+'\');" />'+
	    '</span>'+

	    '<span class="grid1">'+
	        '<input type="text" id="i_'+ic+'_beca" value="0" placeholder="'+$('#p_disc').text()+'" onblur="revalo(\''+ic+'\');" />'+
	    '</span>'+

	    '<span class="grid2">'+
	        '<input type="text" id="i_'+ic+'_prix" value="0.00" placeholder="'+$('#p_dprix').text()+'" disabled />'+
	    '</span>'+

	    '<span class="grid1">'+
	        '<td class="tableActs" align="center">'+
	            '<a href="javascript:void(0);" class="tablectrl_small bDefault tipS" onclick="killitemo(\''+ic+'\');" title="'+$('#p_kill').text()+'"><span class="iconb" data-icon="&#xe136;"></span></a>'+
	        '</td>'+
	    '</span>'+
	'</div>';

	console.log('Adding itemo with id:'+ic);
	$('#icont').append(itemo);

	//focus
	$("#i_"+ic+"_desc").focus();

	calc();
 	ic += 1;
}

function revdesc(qid){
	//console.log('datos 64');
	$('#i_'+qid+'_desc').attr('data-enco', btoa(unescape(encodeURIComponent($('#i_'+qid+'_desc').val() ))) );
}

function killitemo(qid){
	$('#itemo_'+qid).hide('slow', function(){ $('#itemo_'+qid).remove(); calc(); });	
	return false;
}


function calc(){

	var to = 0;
	var i;
	$('[id^="itemo_"]').each(function() {
		i = $(this).attr('data-index');
		to +=  Number( $('#i_'+i+'_prix').val().replace(/[^\d.]/g, "") );
		//console.log('Not parsed : '+$('#i_'+i+'_prix').val());
	});
	//console.log('Calculating : '+to);

	var im = (to * 0.16);

	$('#telltotal').html('SUBTOTAL: <strong>$'+to.formatMoney(2, '.', ',')+
		'</strong><br>IVA: <strong>$'+im.formatMoney(2, '.', ',')+
		'</strong><br>TOTAL: <strong>$'+(im + to).formatMoney(2, '.', ',')+'</strong>');
}

function getitems(){
	//recalc
	calc();

	var i;
	var laso = "";

	$('[id^="itemo_"]').each(function() {
		i = $(this).attr('data-index');
		var qdesc = $('#i_'+i+'_desc').attr('data-enco');
		var qcant = $('#i_'+i+'_cant').val();
		var quni = $('#i_'+i+'_uni').val();
		var qprix = $('#i_'+i+'_prix').val();
		laso += qdesc+'^'+qcant+'^'+quni+'^'+qprix+'~';
	});
	laso =  laso.substring(0, laso.length - 1);

	return laso;
}

//----------------ADDING ITEMS TERMINA------------------//


//tooltips
//$('.tipS').tipsy({gravity: 's',fade: true, html:true});

//mask percentage
//$(".maskPct").mask("99%");

//note if new user
$(".nNote").click(function() {
	$(this).fadeTo(200, 0.00, function(){ //fade
		$(this).slideUp(200, function() { //slide up
			$(this).remove(); //then remove from the DOM
		});
	});
});	



//----------------REVALO COMIENZA------------------//


function revalo(qid){
	//console.log('Calculating id: '+qid);
	var valo = 0;
	valo = parseFloat($('#i_'+qid+'_cant').val()) *
	( parseFloat($('#i_'+qid+'_uni').val()) + 
		parseFloat($('#i_'+qid+'_late').val()) -
		 parseFloat($('#i_'+qid+'_beca').val()) );
	$('#i_'+qid+'_prix').val(valo.formatMoney(2, '.', ','));

	calc();
}


//calcular al inicio
calc();

//----------------REVALO TERMINA------------------//


$('#formWait').dialog({
	closeOnEscape: false,
   	open: function(event, ui) { $(".ui-dialog-titlebar-close").hide(); },
    autoOpen: false,
    modal: true,
    width: 700
    /*,
    buttons: {
        "Cancelar": function () {
            $(this).dialog("close");
        }
    }*/
});


$('#sendof').click(function (e) {


	$.post( "clases/genpdf.php", {

		d_emisor: $('#p_emi').text(), d_rec:$('#p_rec').text(), d_items:getitems() },

		function( data ) {
			//exito
			if (data == '1'){
				//$.jGrowl('Se generó la factura exitosamente');
				$( "#sendof" ).show();
				$( "#sendof" ).removeAttr("disabled");

				var butts = 'La factura se generó exitosamente, qué desea hacer? <ul class="middleNavR">'+
		            '<li><a href="#" title="Descargar PDF / XML" class="tipN"><img src="images/icons/middlenav/ico_down.png" alt="" /></a></li>'+
		            '<li><a href="#" title="Imprimir" class="tipN" id="i_printo"><img src="images/icons/middlenav/ico_print.png" alt="" /></a></li>'+
		            '<li><a href="#" title="Enviar factura por correo" class="tipN"><img src="images/icons/middlenav/ico_email.png" alt="" /></a></li>'+
		        '</ul><br>'+
		        '<input type="submit" id="closo" class="buttonS bBlue" value="CERRAR" />';
			        
			    $('#formWait').dialog('open');

			    //wait for the timbrador
			    $('#waitInner').html(butts);

			    //set butts starts------------------------/////////
			    $('#i_printo').click(function() {
			    	getitems();
			    	/*
				  	$('#efo').show().printElement({
					    overrideElementCSS:[
					       'css/f.css', 
					       { href:'css/f.css',media:'print'}
					    ]
					});
					*/
				});

				$('#closo').click(function() {
				  $('#formWait').dialog('close');
				  return false;
				});
				//set butts ends-------------------------/////////



			} else {
				$.jGrowl("ERROR: "+data);
			}
			
			
		});
	e.preventDefault();
	return false;	
	
	
});