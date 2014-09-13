var loadme;
console.log('Test 7738');

//EDITABLE
oTable = $('#dTable').dataTable({
	"oLanguage": {
        sEmptyTable: "No hay información por el momento.",
        sZeroRecords: "No hay información por el momento."
    },
	"bJQueryUI": false,
	"bAutoWidth": false,
	"sPaginationType": "full_numbers",
	"dom": 'Rlfrtip',
	"bStateSave": true,
	"sDom": '<"H"fl>t<"F"ip>',
	"sAjaxSource": 'clases/parent/parents_data_faltas.php?qparcial='+$('#qparcial').text()+'&qestudiante='+$('#qestudiante').text(),
	"fnInitComplete": function(oSettings, json) {
      $.unblockUI();
    },
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
    	sName: "qcalif"
    }] 

});

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
	"sAjaxSource": 'clases/parent/parents_data_grades.php?qparcial='+$('#qparcial').text()+'&qestudiante='+$('#qestudiante').text(),
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
    	sName: "qcalif"
    }] 

});

$( ".midtermpicker" ).on('change', function (e) {
	$.blockUI();

	var optionSelected = $("option:selected", this);
    var valueSelected = this.value;

    var selects = document.getElementById("studentpicker");
	var selectedValue = selects.options[selects.selectedIndex].value;

	assignme('parents_data.php?qparcial='+valueSelected+'&qestudiante='+selectedValue,'content'); return false;
});

$( ".studentpicker" ).on('change', function (e) {
	$.blockUI();

	var selects = document.getElementById("midtermpicker");
	var selectedValue = selects.options[selects.selectedIndex].value;

	var optionSelected = $("option:selected", this);
    var valueSelected = this.value;

	assignme('parents_data.php?qparcial='+selectedValue+'&qestudiante='+valueSelected,'content'); return false;
});
