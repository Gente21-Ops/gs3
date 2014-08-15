var loadme;
console.log('Test 903');

var rando = Math.floor(Math.random() * 6000) + 1;

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
	"sDom": '<"H"fl>t<"F"ip>',
	"sAjaxSource": 'clases/profesor/professor_takelist.php?qidgrupo='+$('#qidgrupo').text()+'&qday='+$('#qday').text()+'&qmonth='+$('#qmonth').text()+'&qyear='+$('#qyear').text(),
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
					$.jGrowl(name+' '+last+' '+$('#t_present').text()+' '+$('#qmonth').text()+'-'+$('#qday').text()+'-'+$('#qyear').text());
				} else {
					$.jGrowl(name+' '+last+' '+$('#t_notpresent').text()+' '+$('#qmonth').text()+'-'+$('#qday').text()+'-'+$('#qyear').text());
				}
			} else {
				$.jGrowl(name+' '+last+' '+$('#t_present').text()+' '+$('#qmonth').text()+'-'+$('#qday').text()+'-'+$('#qyear').text());
			}
	});
}

function missedday(qiduser1,qname1,qlast1){
	if ($('#che_'+qiduser1).prop('checked')){
		setmissed(qiduser1,true,qname1,qlast1);
	} else {
		setmissed(qiduser1,false,qname1,qlast1);
	}	
}