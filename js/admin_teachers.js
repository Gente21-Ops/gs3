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
	"sAjaxSource": 'clases/admin/teachers.php',
	"fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
		$(nRow).attr('id', aData[0]);
		return nRow;
	},
	aoColumns: [{
        sName: "idUsers",
        bSearchable: false,
        bVisible: false
    },
    {
        sName: "apellidos"
    },
    {
        sName: "nombre"
    },  
    {
        sName: "direccion"
    },
    {
        sName: "telefono"
    },
    {
        sName: "e_mail"
    },
    {
        sName: "buts"
    }] 


}).makeEditable({
    sUpdateURL: "clases/admin/teachers_update.php",
    sAddURL: "clases/admin/teachers_add.php",
    sDeleteURL: "clases/admin/teachers_delete.php"
});



//select on click
$("div.dyn2 > table > tbody > tr").click(function(){
	alert('chido');
    $(this).closest('table tbody tr').addClass('thisRow');
});

