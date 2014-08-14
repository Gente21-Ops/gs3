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
	
	"bJQueryUI": false,
	"bAutoWidth": false,
	"sPaginationType": "full_numbers",
	"sDom": '<"H"fl>t<"F"ip>',
	"sAjaxSource": 'clases/admin/parents.php',
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
    	sName: "nombre"
    },
    {
    	sName: "apellidos"
    },
    {
    	sName: "telefono"
    },
    {
    	sName: "email"
    },
    {
    	sName: "idUsers"
    }] 

}).makeEditable({
    sUpdateURL: "clases/admin/parents_update.php",
    sAddURL: "clases/admin/parents_add.php",
    sDeleteURL: "clases/admin/parents_delete.php"
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

