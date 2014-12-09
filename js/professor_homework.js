console.log('ADMIN_GRUPOS SE PRESENTA 1657');
var loadme;

//localization (solo cuando hay calendario de UI)
var qlen = '';
if ($('#qlango').text() == 'es'){
	qlen = "js/datatablesloc/dataTables.spanish.txt";
} else if ($('#qlango').text() == 'en'){
	qlen = "js/datatablesloc/dataTables.english.txt";
} else if ($('#qlango').text() == 'fr'){
	qlen = "js/datatablesloc/dataTables.francais.txt";
}

//EDITABLE
oTable = $('.dTable').dataTable({
	"oLanguage": {
        sEmptyTable:     "No hay información por el momento.",
        sZeroRecords: "No hay información por el momento."
    },
	"bJQueryUI": false,
	"bAutoWidth": false,
	"sPaginationType": "full_numbers",
	"sDom": '<"H"fl>t<"F"ip>',
	"sAjaxSource": 'clases/profesor/professor_homework.php?qgroupid='+$('#groupid').text(),
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
    	sName: "titulo"
    },
    {
    	sName: "creado"
    },
    {
    	sName: "fecha"
    },
    {
    	sName: "fechaEntrega"
    }] 

}).makeEditable({
    sAddURL: "clases/profesor/homework_add.php",
    sDeleteURL: "clases/profesor/homework_delete.php",
    sUpdateURL: "clases/profesor/homework_update.php",
    fnOnAdded: function(){ 	
		$.jGrowl('Registro agregado.');
	},
	fnOnDeleted: function(){ 	
		$.jGrowl("Registro eliminado.");
	},
	fnOnEdited: function(){ 	
		$.jGrowl("Registro actualizado.");
	}
});



//NON-EDITABLE
/*
oTable = $('.dTable').dataTable({      
	"bJQueryUI": false,
	"bAutoWidth": false,
	"sPaginationType": "full_numbers",
	"sDom": '<"H"fl>t<"F"ip>',
	"sAjaxSource": 'clases/students.php'
});
*/

//select on click
$("div.dyn2 > table > tbody > tr").click(function(){
	alert('chido');
    $(this).closest('table tbody tr').addClass('thisRow');
});

