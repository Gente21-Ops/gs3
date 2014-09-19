var loadme;
console.log('Test 7738');

//EDITABLE
oTable2 = $('#dTable2').dataTable({
	"oLanguage": {
        sEmptyTable:     "No hay información por el momento.",
        sZeroRecords: "No hay información por el momento."
    },
	"bJQueryUI": false,
	"bAutoWidth": false,
	"sPaginationType": "full_numbers",
	"dom": 'Rlfrtip',
	"bStateSave": true,
	"sDom": '<"H"fl>t<"F"ip>',
	"fnInitComplete": function(oSettings, json) {
      $.unblockUI();
    },
	"sAjaxSource": 'clases/admin/admin_faltas.php?qparcial='+$('#qparcial').text()+'&qestudiante='+$('#qestudiante').text(),
	"fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
		$(nRow).attr('id', aData[0]);
		return nRow;
	},
	aoColumns: [{
        sName: "qidmateria",
        bSearchable: false,
		bVisible: false
    },
     {
    	sName: "qmateria"
    },
     {
    	sName: "qfaltas"
    }] 

});

$( ".midtermpicker" ).on('change', function (e) {
	$.blockUI();

	var optionSelected = $("option:selected", this);
    var valueSelected = this.value;

	assignme('admin_faltas.php?qparcial='+valueSelected+'&qestudiante='+$('#qestudiante').text(),'content'); return false;
});