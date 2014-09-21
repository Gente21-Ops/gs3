console.log('professor grupos se presenta');
var loadme;

//EDITABLE
oTable = $('#dTable').dataTable({
	
	"bJQueryUI": false,
	"bAutoWidth": false,
	"sPaginationType": "full_numbers",
	"sDom": '<"H"fl>t<"F"ip>',
	"sAjaxSource": 'clases/profesor/profesor_groups.php',
	"fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
		$(nRow).attr('id', aData[0]);
		return nRow;
	},
	aoColumns: [{
        sName: "idGrupos",
        bSearchable: false,
		bVisible: false
    },
     {
    	sName: "qnombre"
    },
     {
    	sName: "qmatnom"
    },
    {
    	sName: "qasist"
    }] 

});



