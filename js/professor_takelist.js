var loadme;
console.log('Test 903');
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



function missedday(qiduser){
	console.log('Cambiando dia del user:'+qiduser+' Coman mejillones!!!');
}