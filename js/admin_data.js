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
	"sAjaxSource": 'clases/admin/admin_data.php?qgrupo='+$('#qgrupo').text(),
	"fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
		$(nRow).attr('id', aData[0]);
		return nRow;
	},
	aoColumns: [{
        sName: "idUser",
        bSearchable: false,
		bVisible: false
    },
     {
    	sName: "nombre"
    },
     {
    	sName: "apellido"
    },
     {
    	sName: "califs"
    }] 

});

$( ".grouppicker" ).on('change', function (e) {
	$.blockUI();

	var optionSelected = $("option:selected", this);
    var valueSelected = this.value;

	assignme('admin_data.php?qgrupo='+valueSelected,'content'); return false;
});
