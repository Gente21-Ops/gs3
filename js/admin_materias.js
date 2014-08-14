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
	"sAjaxSource": 'clases/admin/materias.php',
	"fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
		$(nRow).attr('id', aData[0]);
		return nRow;
	},
	aoColumns: [{
        sName: "idMaterias",
        bSearchable: false,
		bVisible: false
    },
    {
    	sName: "nombre"
    }] 

}).makeEditable({
    sUpdateURL: "clases/admin/materias_update.php",
    sAddURL: "clases/admin/materias_add.php",
    sDeleteURL: "clases/admin/materias_delete.php"
});


//EDITABLE
oTable = $('.dTableDctos').dataTable({
	
	"bJQueryUI": false,
	"bAutoWidth": false,
	"sPaginationType": "full_numbers",
	"sDom": '<"H"fl>t<"F"ip>',
	"sAjaxSource": 'clases/admin/parciales.php',
	"fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
		$(nRow).attr('id', aData[0]);
		return nRow;
	},
	aoColumns: [{
        sName: "idParciales",
        bSearchable: false,
		bVisible: false
    },
    {
    	sName: "nombre"
    },
    {
    	sName: "descripción"
    },
    {
    	sName: "abierto"
    },
    {
    	sName: "limite_pago"
    },
    {
    	sName: "esparcial"
    }] 

}).makeEditable({
    sUpdateURL: "clases/admin/parciales_update.php",
    sAddURL: "clases/admin/parciales_add.php",
    sDeleteURL: "clases/admin/parciales_delete.php"
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

