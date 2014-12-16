//global namespace declaration
var GL = {};

GL.userdata = {};
GL.emoticons = {
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
        "(y)":"Thumbs-Up.png",
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
        "(nerd)":"Nerd.png",
        "(meh)":"Not-Amused.png"
      };

//localStorage (604800000 = 7 days in ms)
GL.oldmsg = 604800000;

//global function for simple loading
function assignme(url,target){
	console.log('Trying to load: clases/'+url);
	var cach = Math.floor(Math.random()*8000);
	//let's check if url has params (cache killer goes at the end)
	var newurl = '';
	var pars = url.split('?');
	if (pars.length >= 2){
		console.log('PARSL: '+pars.length+')');
		newurl = url + '&c='+cach;
	} else {
		newurl = url + '?c='+cach;
	}
	$( "#"+target ).load('clases/'+newurl, function(response, status, xhr) {
		//exit
		if (xhr.status == '302'){
			window.location = "main2.php"
		}
		//console.log('LOAD STATUS: ' + xhr.status + " " + xhr.statusText)
		// Update the title and content.
		var pageData = url.split('.')[0];
		// Create a new history item.
		history.pushState(pageData, 'TITULILLO', newurl);

		//console.log('>>LOADED FROM ASSIGNME:'+newurl+' wil get class: js/'+pageData+'.js PAGEDATA:'+pageData);

		//let's load the processing js
		$.getScript( 'js/'+pageData+'.js?cual='+cach, function() {
			console.log('JS LOADED: js/'+pageData+'.js?cual='+cach);			
		});
	});
}

window.addEventListener("popstate", function(e) {
	//we get the last part
	var urlo = location.pathname.split('/');
	console.log('TRYING TO RELOAD FROM: '+urlo[urlo.length - 1]);
    assignme(urlo[urlo.length - 1]);
});

function removeactive(url){
	console.log('REMOVING ACTIVE CLASS');
	var listItems = $("#navo li a");
	listItems.each(function(idx, a) {
		$(a).removeClass( "active" );
	});
	$("a[href='"+url+"']").addClass( "active" );
}

$(function() {

	//======INIT==============//
	assignme('students_msgs','content');  

	//------------------------GLOBAL ERROR OUTPUT
	GL.consol = function(msg){
		if ( window.console && window.console.log ) {
			console.log(msg);
		} else {
			//alert(msg);
		}
	}

	//------------------------GLOBAL ERROR OUTPUT
	GL.clearo = function(msg){
		if ( window.clear ) {
			console.clear();
			GL.consol('console cleared');
		} else {
			//alert(msg);
		}
	}

	//------------------------GETTER/SETTER
	GL.getter = function(url,params,datatype,callback){
		GL.consol('Trying to get data from '+url+' with request parameters:');
		GL.consol(params);
		$.ajax({
			url: url+'?'+GL.now(),
			type: 'POST',
			data: params,
			async: true,
			dataType: datatype,
			success: function(ladata){
				GL.consol('Returned info:');
				GL.consol(ladata);
				callback(ladata);
			},
			error: function(xhr, status, error) {
			  var err = xhr.responseText;
			  GL.consol(err.Message+' | '+url+' | ');
			  //GL.consol('ERROR: '+err); 
			  callback(err);
			}
		});
	} 

	//------------------------RANDOM NUMBER GENERATOR
	GL.rando = function(num){
		return Math.floor(Math.random() * num) + 1;
	}

	//------------------------GLOBAL USER DATA
	//I would like to know who am I, thank you very much
	/* THE MSG SYSTEM IS DOING THIS
    GL.getter('clases/ui/getmyadata.php',{},'json',returnData);
    function returnData(param) {
    	GL.userdata = param;
    }
    */

    //------------------------TIMESTAMP
	GL.now = function(num){
		return Date.now();
	}

    //-----------------------TODAY'S DATE + TIME
	GL.todaytime = function(num){
		var d = new Date(), month = d.getMonth()+1, day = d.getDate(), h = d.getHours(), m = d.getMinutes(), s = d.getSeconds();
    	return d.getFullYear()+'/'+(month<10 ? '0' : '')+month+'/'+(day<10 ? '0' : '')+day+' '+h+':'+m+':'+s;
	}

	//-----------------------TODAY'S DATE
	GL.today = function(num){
		var d = new Date(), month = d.getMonth()+1, day = d.getDate(); 
    	return d.getFullYear()+'/'+(month<10 ? '0' : '')+month+'/'+(day<10 ? '0' : '')+day;
	}

	//-----------------------CHAT TIME
	GL.mytime = function(){
	    var currentdate = new Date(); 
	    var datetime = "@ " + currentdate.getDate() + "/"
	        + (currentdate.getMonth()+1)  + "/" 
	        + currentdate.getFullYear() + " - "  
	        + currentdate.getHours() + ":"  
	        + currentdate.getMinutes() + ":" 
	        + currentdate.getSeconds();
	    return datetime;
	}
	GL.mytimefromepoch = function(epoch){
		var nomiliseconds = String(epoch).substring(0, String(epoch).length - 3);
		//GL.consol('Remaking time from epoch: '+nomiliseconds);
	    return '@ '+moment.unix(parseInt(nomiliseconds)).format('DD-MM-YYYY HH:mm:ss');
	}

	//-----------------------MICROTIME
	GL.microtime = function(){
	    var seconds = new Date() / 1000;
	    return Math.ceil(seconds);
	}

	//-----------------------TRUNCATES A STRING
	GL.trunkme = function(texto,lenghto){
		var trimmedString = texto.substr(0, lenghto);
		trimmedString = trimmedString.substr(0, Math.min(trimmedString.length, trimmedString.lastIndexOf(" ")))
	    return trimmedString;
	}

	/*----LOCAL CHAT FUNCTIONS STARTS----*/
	GL.ch_savedata = function(timestamp,senderid,recipientid,text){
		//GL.consol('Saving data here =D , SENDER:'+senderid+' RECIPIENT:'+recipientid+' ME:'+GL.userdata.coder);

		//who am i talking to? <-Prevents that I'm labeling a message as being sent to myself
		var talkingto = senderid;
		if (recipientid != GL.userdata.coder){
			talkingto = recipientid;
		}

		//is recipient defined?
		if (String(recipientid) != '0'){
			//check if this object exists
			//GL.consol('Writting data...');
			var whoisit = 'c_'+talkingto+'_'+GL.userdata.coder;
			if (localStorage.getItem(whoisit) === null) {
				//this is absolutely necesary, we must enclose the result on an array the first time we use it
				var a = [];
				a.push({ 'tim': timestamp, 'sid': senderid, 'rid': recipientid, 'txt': text });
				localStorage.setItem(whoisit, JSON.stringify(a));
			} else {
				//GL.consol('Object found! appending data...');
				var retrievedObject = localStorage.getItem(whoisit);
				//before saving the new uo the new object let's clear up old ones
				var chido = ch_deleteold(JSON.parse(retrievedObject));
				//add new MSG
				chido.push({ 'tim': timestamp, 'sid': senderid, 'rid': recipientid, 'txt': text });
				//save to local
				localStorage.setItem(whoisit, JSON.stringify(chido));
			}
		} else {
			//GL.consol('No recipient selected');
			$.jGrowl('You have not selected a recipient XD', {
                /*header: 'Important',*/
                life: 5000,
                position: 'bottom-right',
                easing: 'swing'
            });
		}			
	}
	GL.ch_getdata = function(senderid,recipientid){
		var talkingto = 'c_'+recipientid+'_'+GL.userdata.coder;
		//if the LSO doesn't have my id as a rpefix I will return nothing
		var retrievedObject = localStorage.getItem(talkingto);
		var allmsgs = JSON.parse(retrievedObject);
		return allmsgs;
	}
	function ch_deleteold(allmsgs){
	    //GL.oldmsg
	    var timo = GL.now();
	    var newob = [];
		//we rebuild the MSGS		
	    for (var key in allmsgs) {
			//if difference in time is lower than olmsg we save the msg again
			if ( (timo - allmsgs[key].tim) < GL.oldmsg ){
				newob.push({ 'tim': allmsgs[key].tim, 'sid': allmsgs[key].sid, 'rid': allmsgs[key].rid, 'txt': allmsgs[key].txt });
			}			
		}
		//we return the new cleaned up msg stream		
		return newob;
	}
	/*-----LOCAL CHAT FUNCTIONS ENDS-----*/

    //----- USER HOVER --------//
  // $("#elusero").tipsy({html: true, gravity: $.fn.tipsy.autoNS });
   $("#elusero").tipsy({
   		gravity: 'nw',
   		fade: true,
   		html:true
   	});

	//===== File manager =====//	
	
	$().ready(function() {
		var elf = $('#fileManager').elfinder({
			// lang: 'ru',             // language (OPTIONAL)
			url : 'php/connector.php'  // connector URL (REQUIRED)
		}).elfinder('instance');			
	});	
	
	
	//===== ShowCode plugin for <pre> tag =====//

	$('.code').sourcerer('js html css php'); // Display all languages
	
	
	//===== Left navigation styling =====//
	
	$('.subNav li a.this').parent('li').addClass('activeli');


	//===== Login pic hover animation =====//
	
	$(".loginPic").hover(
		function() { 
		
		$('.logleft, .logback').animate({left:10, opacity:1},200); 
		$('.logright').animate({right:10, opacity:1},200); },
		
		function() { 
		$('.logleft, .logback').animate({left:0, opacity:0},200);
		$('.logright').animate({right:0, opacity:0},200); }
	);
	
	
	//===== Image gallery control buttons =====//
	
	$(".gallery ul li").hover(
		function() { $(this).children(".actions").show("fade", 200); },
		function() { $(this).children(".actions").hide("fade", 200); }
	);
	
	

	$( ".acInventario" ).autocomplete({
	source: '/gs3b/clases/general/arrayInventario.php',
	minLength: 0,
	});	

	
	//===== Sortable columns =====//
	
	$("table").tablesorter();
	
	
	//===== Resizable columns =====//
	
	$("#resize, #resize2").colResizable({
		liveDrag:true,
		draggingClass:"dragging" 
	});
	
	
	//===== Bootstrap functions =====//
	
	// Loading button
    $('#loading').click(function () {
        var btn = $(this)
        btn.button('loading')
        setTimeout(function () {
          btn.button('reset')
        }, 3000)
      });
	
	// Dropdown
	$('.dropdown-toggle').dropdown();
	
	



	//===== Fancybox =====//
	
	$(".lightbox").fancybox({
	'padding': 2
	});
	


	//===== Time picker =====//
	
	$('.timepicker').timeEntry({
		show24Hours: true, // 24 hours format
		showSeconds: true, // Show seconds?
		spinnerImage: 'images/elements/ui/spinner.png', // Arrows image
		spinnerSize: [19, 26, 0], // Image size
		spinnerIncDecOnly: true // Only up and down arrows
	});
	

	//===== Usual validation engine=====//

	$("#usualValidate").validate({
		rules: {
			firstname: "required",
			minChars: {
				required: true,
				minlength: 3
			},
			maxChars: {
				required: true,
				maxlength: 6
			},
			mini: {
				required: true,
				min: 3
			},
			maxi: {
				required: true,
				max: 6
			},
			range: {
				required: true,
				range: [6, 16]
			},
			emailField: {
				required: true,
				email: true
			},
			urlField: {
				required: true,
				url: true
			},
			dateField: {
				required: true,
				date: true
			},
			digitsOnly: {
				required: true,
				digits: true
			},
			enterPass: {
				required: true,
				minlength: 5
			},
			repeatPass: {
				required: true,
				minlength: 5,
				equalTo: "#enterPass"
			},
			customMessage: "required",
			topic: {
				required: "#newsletter:checked",
				minlength: 2
			},
			agree: "required"
		},
		messages: {
			customMessage: {
				required: "Bazinga! This message is editable",
			},
			agree: "Please accept our policy"
		}
	});
	
	
	//===== Validation engine =====//
	
	$("#validate").validationEngine();

	
	//===== iButtons =====//
	
	$('.on_off :checkbox, .on_off :radio').iButton({
		labelOn: "",
		labelOff: "",
		enableDrag: false 
	});
	
	$('.yes_no :checkbox, .yes_no :radio').iButton({
		labelOn: "On",
		labelOff: "Off",
		enableDrag: false
	});
	
	$('.enabled_disabled :checkbox, .enabled_disabled :radio').iButton({
		labelOn: "Enabled",
		labelOff: "Disabled",
		enableDrag: false
	});
	
	
	
	//===== Notification boxes =====//
	
	$(".nNote").click(function() {
		$(this).fadeTo(200, 0.00, function(){ //fade
			$(this).slideUp(200, function() { //slide up
				$(this).remove(); //then remove from the DOM
			});
		});
	});	
	
	
	//===== Animate current li when closing button clicked =====//
	
	$(".remove").click(function() {
		$(this).parent('li').fadeTo(200, 0.00, function(){ //fade
			$(this).slideUp(200, function() { //slide up
				$(this).remove(); //then remove from the DOM
			});
		});
	});	
	
	
	
	//===== Check all checbboxes =====//
	
	$(".titleIcon input:checkbox").click(function() {
		var checkedStatus = this.checked;
		$("#checkAll tbody tr td:first-child input:checkbox").each(function() {
			this.checked = checkedStatus;
				if (checkedStatus == this.checked) {
					$(this).closest('.checker > span').removeClass('checked');
					$(this).closest('table tbody tr').removeClass('thisRow');
				}
				if (this.checked) {
					$(this).closest('.checker > span').addClass('checked');
					$(this).closest('table tbody tr').addClass('thisRow');
				}
		});
	});	
	
	$(function() {
    $('#checkAll tbody tr td:first-child input[type=checkbox]').change(function() {
        $(this).closest('tr').toggleClass("thisRow", this.checked);
		});
	});



	
	//===== WYSIWYG editor =====//
	
	$("#editor").cleditor({
		width:"100%", 
		height:"250px",
		bodyStyle: "margin: 10px; font: 12px Arial,Verdana; cursor:text",
		useCSS:true
	});
	
	
	//===== Dual select boxes =====//
	
	$.configureBoxes();


	//===== Chosen plugin =====//
		
	$(".select").chosen(); 
	
	
	//===== Autotabs. Inline data rows =====//

	$('.onlyNums input').autotab_magic().autotab_filter('numeric');
	$('.onlyText input').autotab_magic().autotab_filter('text');
	$('.onlyAlpha input').autotab_magic().autotab_filter('alpha');
	$('.onlyRegex input').autotab_magic().autotab_filter({ format: 'custom', pattern: '[^0-9\.]' });
	$('.allUpper input').autotab_magic().autotab_filter({ format: 'alphanumeric', uppercase: true });
	
	
	//===== Masked input =====//
	
	$.mask.definitions['~'] = "[+-]";
	$(".maskDate").mask("99/99/9999",{completed:function(){alert("Callback when completed");}});
	$(".maskPhone").mask("(999) 999-9999");
	$(".maskPhoneExt").mask("(999) 999-9999? x99999");
	$(".maskIntPhone").mask("+33 999 999 999");
	$(".maskTin").mask("99-9999999");
	$(".maskSsn").mask("999-99-9999");
	$(".maskProd").mask("a*-999-a999", { placeholder: " " });
	$(".maskEye").mask("~9.99 ~9.99 999");
	$(".maskPo").mask("PO: aaa-999-***");
	$(".maskPct").mask("99%");
	
	
	//===== Tags =====//	
		
	$('.tags').tagsInput({width:'100%'});
	
	
	//===== Input limiter =====//
	
	$('.lim').inputlimiter({
		limit: 100,
		boxId: 'limitingtext',
		boxAttach: false
	});
	
	
	//===== Placeholder =====//
	
	$('input[placeholder], textarea[placeholder]').placeholder();
	
	
	//===== Autogrowing textarea =====//
	
	$('.auto').elastic();
	$('.auto').trigger('update');


	//===== Full width sidebar dropdown =====//
	
	$('.fulldd li').click(function () {
		$(this).children("ul").slideToggle(150);
	});
	$(document).bind('click', function(e) {
		var $clicked = $(e.target);
		if (! $clicked.parents().hasClass("has"))
		$('.fulldd li').children("ul").slideUp(150);
	});
	
	
	//===== Top panel search field =====//
	
	$('.userNav a.search').click(function () {
		$('.topSearch').fadeToggle(150);
	});
	
	
	//===== 2 responsive buttons (320px - 480px) =====//
	
	$('.iTop').click(function () {
		$('#sidebar').slideToggle(100);
	});
	
	$('.iButton').click(function () {
		$('.altMenu').slideToggle(100);
	});

	
	//===== Animated dropdown for the right links group on breadcrumbs line =====//
	
	$('.breadLinks ul li').click(function () {
		$(this).children("ul").slideToggle(150);
	});
	$(document).bind('click', function(e) {
		var $clicked = $(e.target);
		if (! $clicked.parents().hasClass("has"))
		$('.breadLinks ul li').children("ul").slideUp(150);
	});
	
	

	
	//===== Tabs =====//
		
	$.fn.contentTabs = function(){ 
	
		$(this).find(".tab_content").hide(); //Hide all content
		$(this).find("ul.tabs li:first").addClass("activeTab").show(); //Activate first tab
		$(this).find(".tab_content:first").show(); //Show first tab content
	
		$("ul.tabs li").click(function() {
			$(this).parent().parent().find("ul.tabs li").removeClass("activeTab"); //Remove any "active" class
			$(this).addClass("activeTab"); //Add "active" class to selected tab
			$(this).parent().parent().find(".tab_content").hide(); //Hide all tab content
			var activeTab = $(this).find("a").attr("href"); //Find the rel attribute value to identify the active tab + content
			$(activeTab).show(); //Fade in the active content
			return false;
		});
	
	};
	$("div[class^='widget']").contentTabs(); //Run function on any div with class name of "Content Tabs"


	
	oTable2 = $('.dTable2').dataTable({
		"bJQueryUI": false,
		"bAutoWidth": false,
		"sPaginationType": "full_numbers",
        "bProcessing": true,
        "bServerSide": true,

        "sAjaxSource": "/gstest/clases/general/inventario.php",
        "aoColumns": [
	        /*ID*/	
	        	{ 
	        		"bSearchable": false,
				  	"bVisible":    false 
				},
		    /*Nombre*/    	null,
		    /*Descripcion*/ null,
		    /*Cantidad*/    null,
		    /*Valor*/    	null,
	        /*Borrar*/
	        	{
	            	"mData": null,
	            	"sWidth": "80px",
	            	"sClass": "center",
	            	"bSortable": false,
	            	"sDefaultContent": "",
	                "aTargets": [0],
	                "fnCreatedCell" : function(nTd, sData, oData, iRow, iCol){
	                    var b = $('<a href="#" class="buttonM bDefault" id="dialog_openBorrar">Borrar</a>');
	                    b.button();
	                    b.on('click',function(){
	                    	//alert(oData[0]);
	                    	$('#dialogBorrar').dialog({
						        autoOpen: true,
						        width: 400,
						        buttons: {
						            "Aceptar": function () {
						            	$('#borrarform').submit();
						            	$.post("clases/dbinteraction.php", { qtable:$('#qtable').val(), qid:oData[0], qtype:$('#qaction').val(), qcolumna:'idInventario', qdata:"0" }, function(qr){
								            //alert('Registro borrado.');
								            //window.location = "inventario.php";
								            if (parseInt(qr) == 1){
								                return false;
								                //return true;
								            } else {
								                return false;
								            }
								        });
						                $(this).dialog("close");
						            },
						            "Cancelar": function () {
						                $(this).dialog("close");
						            }
						        }
						    });


	       					return false;
	                    });
	                    $(nTd).empty();
	                    $(nTd).prepend(b);
	                }
	            },
	            {
	            	"mData": null,
	            	"sWidth": "120px",
	            	"sClass": "center",
	            	"bSortable": false,
	            	"sDefaultContent": "",
	                "aTargets": [0],
	                "fnCreatedCell" : function(nTd, sData, oData, iRow, iCol){
	                    var b = $('<a href="#" class="buttonM bDefault" id="dialog_openBorrar">Editar</a>');
	                    b.button();
	                    b.on('click',function(){
	                    	//alert(oData[0]);
	                    	$('#dialogBorrar').dialog({
						        autoOpen: true,
						        width: 400,
						        buttons: {
						            "Aceptar": function () {
						            	$('#borrarform').submit();
						            	seen = [];
				                        $.post("clases/dbinteraction.php", { qtable:$('#qtable').val(), qdata:JSON.stringify($('form').serializeObject()), qtype:$('#qaction').val(), qid:oData[0], qkey:'idBanks' }, function(qr){

				                            //alert('seee');
				                            if (parseInt(qr) == 1){
				                                //alert('Registro actualizado.');
				                                //window.location = "banks.php";
				                                return false;
				                            } else {
				                                var err = qr.split('ˆ');
				                                alert(err[1]);
				                                return false;
				                            }

				                        });
						                $(this).dialog("close");
						            },
						            "Cancelar": function () {
						                $(this).dialog("close");
						            }
						        }
						    });


	       					return false;
	                    });
	                    $(nTd).empty();
	                    $(nTd).prepend(b);
	                }
	            }
        ]


        
	});



	//===== Dynamic table toolbars =====//		
	
	$('#dyn .tOptions').click(function () {
		$('#dyn .tablePars').slideToggle(200);
	});	
	
	$('#dyn2 .tOptions').click(function () {
		$('#dyn2 .tablePars').slideToggle(200);
	});	
	
	
	$('.tOptions').click(function () {
		$(this).toggleClass("act");
	});
	

	//== Adding class to :last-child elements ==//
		
	$(".subNav li:last-child a, .formRow:last-child, .userList li:last-child, table tbody tr:last-child td, .breadLinks ul li ul li:last-child, .fulldd li ul li:last-child, .niceList li:last-child").addClass("noBorderB")

	
	//===== Add classes for sub sidebar detection =====//
	
	if ($('div').hasClass('secNav')) {
		$('#sidebar').addClass('with');
		//$('#content').addClass('withSide');
	}
	else {
		$('#sidebar').addClass('without');
		$('#content').css('margin-left','100px');//.addClass('withoutSide');
		$('#footer > .wrapper').addClass('fullOne');
		};


	//===== Collapsible elements management =====//
	
	$('.exp').collapsible({
		defaultOpen: 'current',
		cookieName: 'navAct',
		cssOpen: 'subOpened',
		cssClose: 'subClosed',
		speed: 200
	});

	$('.opened').collapsible({
		defaultOpen: 'opened,toggleOpened',
		cssOpen: 'inactive',
		cssClose: 'normal',
		speed: 200
	});
	
	$('.closed').collapsible({
		defaultOpen: '',
		cssOpen: 'inactive',
		cssClose: 'normal',
		speed: 200
	});
	
	
	//===== Accordion =====//		
	
	$('div.menu_body:eq(0)').show();
	$('.acc .whead:eq(0)').show().css({color:"#2B6893"});
	
	$(".acc .whead").click(function() {	
		$(this).css({color:"#2B6893"}).next("div.menu_body").slideToggle(200).siblings("div.menu_body").slideUp("slow");
		$(this).siblings().css({color:"#404040"});
	});



	//===== Breadcrumbs =====//
	
	$('#breadcrumbs').xBreadcrumbs();
	
	

	//===== User nav dropdown =====//		
	
	$('a.leftUserDrop').click(function () {
		$('.leftUser').slideToggle(200);
	});
	$(document).bind('click', function(e) {
		var $clicked = $(e.target);
		if (! $clicked.parents().hasClass("leftUserDrop"))
		$(".leftUser").slideUp(200);
	});
	
	
	//===== Tooltips =====//

	$('.tipN').tipsy({gravity: 'n',fade: true, html:true});
	$('.tipS').tipsy({gravity: 's',fade: true, html:true});
	$('.tipW').tipsy({gravity: 'w',fade: true, html:true});
	$('.tipE').tipsy({gravity: 'e',fade: true, html:true});
	
	
	


	//===== jQuery UI dialog =====//
	
    $('#dialog').dialog({
        autoOpen: false,
        width: 400,
        buttons: {
            "Gotcha": function () {
                $(this).dialog("close");
            },
            "Cancel": function () {
                $(this).dialog("close");
            }
        }
    });
    // Dialog Link
    $('#dialog_open').click(function () {
        $('#dialog').dialog('open');
        return false;
    });
	

    //Dialog Inventario BORRAR
    $('#dialog_openBorrar').click(function () {
        $('#dialogBorrar').dialog('open');
        return false;
    });


	// Dialog
    $('#formDialog').dialog({
        autoOpen: false,
        width: 400,
        buttons: {
            "Nice stuff": function () {
                $(this).dialog("close");
            },
            "Cancel": function () {
                $(this).dialog("close");
            }
        }
    });
	// Dialog Link
    $('#formDialog_open').click(function () {
        $('#formDialog').dialog('open');
        return false;
    });


    // Dialog INVENTARIO Agregar
    $('#formDialogInventario').dialog({
        autoOpen: false,
        width: 400,
        buttons: {
            "Agregar": function () {
            	$('#addaccountsform').submit();
                $(this).dialog("close");
            },
            "Cancelar": function () {
                $(this).dialog("close");
            }
        }
    })
    // Dialog Link INVENTARIO Agregar
    $('#formDialogInventario_open').click(function () {
        $('#formDialogInventario').dialog('open');
        return false;
    });
	


	// Dialog
    $('#customDialog').dialog({
        autoOpen: false,
        width: 650,
        buttons: {
            "Very cool!": function () {
                $(this).dialog("close");
            },
            "Cancel": function () {
                $(this).dialog("close");
            }
        }
    });
	
    // Dialog Link
    $('#customDialog_open').click(function () {
        $('#customDialog').dialog('open');
        return false;
    });

	
	
	//===== Vertical sliders =====//
	
	$( "#eq > span" ).each(function() {
		// read initial values from markup and remove that
		var value = parseInt( $( this ).text(), 10 );
		$( this ).empty().slider({
			value: value,
			range: "min",
			animate: true,
			orientation: "vertical"
		});
	});
	
	
	//===== Modal =====//
	
    $('#dialog-modal').dialog({
		autoOpen: false, 
		width: 400,
		modal: true,
		buttons: {
				"Aceptar": function() {
					$( this ).dialog( "close" );
				}
			}
		});	
    $('#modal_open').click(function () {
        $('#dialog-modal').dialog('open');
        return false;
    });
	
    $('#no-session').dialog({
		autoOpen: false, 
		width: 400,
		modal: true,
		buttons: {
				"Yep!": function() {
					$( this ).dialog( "close" );
				}
			}
		});
    $('#modal_open').click(function () {
        $('#no-session').dialog('open');
        return false;
    });

	
	//===== jQuery UI stuff =====//
	
	// default mode
	$('#progress1').anim_progressbar();
	
	// from second #5 till 15
	var iNow = new Date().setTime(new Date().getTime() + 5 * 1000); // now plus 5 secs
	var iEnd = new Date().setTime(new Date().getTime() + 15 * 1000); // now plus 15 secs
	$('#progress2').anim_progressbar({start: iNow, finish: iEnd, interval: 1});
	
	// Progressbar
    $("#progress").progressbar({
        value: 80
    });
	
    // Modal Link
    $('#modal_link').click(function () {
        $('#dialog-message').dialog('open');
        return false;
    });



	//===== Add class on #content resize. Needed for responsive grid =====//
	
	$('#content').resize(function () {
	  var width = $(this).width();
		if (width < 769) {
			$(this).addClass('under');
		}
		else { $(this).removeClass('under') }
	}).resize(); // Run resize on window load
	
	
	//===== Button for showing up sidebar on iPad portrait mode. Appears on right top =====//
				
	$("ul.userNav li a.sidebar").click(function() { 
		$(".secNav").toggleClass('display');
	});


	//===== Form elements styling =====//
	
	$("select, .check, .check :checkbox, input:radio, input:file").uniform();


/*

*/
	
});

	
