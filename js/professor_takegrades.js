var loadme;
console.log('Test 649');

var rando = Math.floor(Math.random() * 6000) + 1;
var elano = new Date().getFullYear();

//EDITABLE
oTable = $('#dTable').dataTable({
	
	"bJQueryUI": false,
	"bAutoWidth": false,
	"fnInitComplete": function(oSettings, json) {
		$('.on_off :checkbox, .on_off :radio').iButton({
			labelOn: "",
			labelOff: "",
			enableDrag: false 
		});
		console.log('Se inicializó');
    },
	"sPaginationType": "full_numbers",
	"dom": 'Rlfrtip',
	"bStateSave": true,
	"sDom": '<"H"fl>t<"F"ip>',
	"sAjaxSource": 'clases/profesor/professor_takegrades.php?qidgrupo='+
		$('#qidgrupo').text()+
		'&qidmat='+$('#qidmat').text(),
	"fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
		$(nRow).attr('id', aData[0]);
		return nRow;
	},
	aoColumns: [{
        sName: "qiduser",
        bSearchable: false,
		bVisible: false
    },
     {
    	sName: "qapellidos"
    },
     {
    	sName: "qnombre"
    },
    {
    	sName: "qidgrupos"
    }] 

});

function setmissed(qiduser,asist,name,last){
	$.blockUI();
	$.post( 'clases/profesor/asistio.php?rando='+rando, {
		qasistio: asist,
		qiduser: qiduser,
		qidmateria: $('#qidmat').text(),
		qidgrupo: $('#qidgrupo').text(),
		qdate: $('#qyear').text()+'-'+$('#qmonth').text()+'-'+$('#qday').text(),
	},
		function(rdata){
			if (rdata == '1'){
				if (asist){
					$.jGrowl(name+' '+last+'<br>'+$('#t_present').text()+' '+$('#qmonth').text()+'-'+$('#qday').text()+'-'+$('#qyear').text());
				} else {
					$.jGrowl(name+' '+last+'<br>'+$('#t_notpresent').text()+' '+$('#qmonth').text()+'-'+$('#qday').text()+'-'+$('#qyear').text());
				}
			} else {
				$.jGrowl(name+' '+last+' '+$('#t_present').text()+' '+$('#qmonth').text()+'-'+$('#qday').text()+'-'+$('#qyear').text());
			}
			$.unblockUI();
	});
}

function missedday(qiduser1,qname1,qlast1){
	if ($('#che_'+qiduser1).prop('checked')){
		setmissed(qiduser1,true,qname1,qlast1);
	} else {
		setmissed(qiduser1,false,qname1,qlast1);
	}	
}

$.datepicker.regional[$('#qlang')];
$( ".datepicker" ).datepicker({ 
	defaultDate: +7,
	showOtherMonths:true,
	autoSize: true,
	appendText: '(yyyy-mm-dd)',
	dateFormat: 'yy-mm-dd',
	onSelect: function(dateText) {
    	$(this).change();
    },
	changeMonth: true,
  	changeYear: true,
  	yearRange: '1930:'+elano,  	
}).change(function() {
	//window.location.href = "index.php?date=" + this.value;
	var dater = this.value.split('-');
	assignme('professor_takelist.php?qcode='+$('#qidgrupo').text()+'&qmat='+$('#qidmat').text()+'&y='+dater[0]+'&m='+dater[1]+'&d='+dater[2],'content'); return false;
});