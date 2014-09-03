var loadme;
console.log('Test 7738');

var rando = Math.floor(Math.random() * 6000) + 1;
var elano = new Date().getFullYear();

//EDITABLE
oTable = $('#dTable').dataTable({
	"oLanguage": {
        "sEmptyTable":     "My Custom Message On Empty Table"
    },
	"bJQueryUI": false,
	"bAutoWidth": false,
	"sPaginationType": "full_numbers",
	"dom": 'Rlfrtip',
	"bStateSave": true,
	"sDom": '<"H"fl>t<"F"ip>',
	"sAjaxSource": 'clases/student/students_data.php?qparcial='+$('#qparcial').text(),
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

$( ".datepicker" ).on('change', function (e) {
	//window.location.href = "index.php?date=" + this.value;
	var optionSelected = $("option:selected", this);
    var valueSelected = this.value;
	assignme('students_data.php?qcode='+$('#qidgrupo').text()+'&qmat='+$('#qidmat').text()+'&qparcial='+valueSelected,'content'); return false;
});
