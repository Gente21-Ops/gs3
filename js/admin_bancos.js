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
	"sAjaxSource": 'clases/admin/bancos.php',
	"fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
		$(nRow).attr('id', aData[0]);
		return nRow;
	},
	aoColumns: [{
        sName: "idBancos",
        bSearchable: false,
		bVisible: false
    },
    {
    	sName: "nombre"
    },
    {
    	sName: "proveedor"
    }] 

}).makeEditable({
    sUpdateURL: "clases/admin/bancos_update.php",
    sAddURL: "clases/admin/bancos_add.php",
    sDeleteURL: "clases/admin/bancos_delete.php"
});


//EDITABLE
oTable = $('.dTableDctos').dataTable({
	
	"bJQueryUI": false,
	"bAutoWidth": false,
	"sPaginationType": "full_numbers",
	"sDom": '<"H"fl>t<"F"ip>',
	"sAjaxSource": 'clases/admin/descuentos.php',
	"fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
		$(nRow).attr('id', aData[0]);
		return nRow;
	},
	aoColumns: [{
        sName: "idDescuentos",
        bSearchable: false,
		bVisible: false
    },
    {
    	sName: "name"
    },
    {
    	sName: "precent"
    },
    {
    	sName: "recurrent"
    },
    {
    	sName: "idParciales"
    }] 

}).makeEditable({
    sUpdateURL: "clases/admin/descuentos_update.php",
    sAddURL: "clases/admin/descuentos_add.php",
    sDeleteURL: "clases/admin/descuentos_delete.php"
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

