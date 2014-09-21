
console.log('ADMIN_GEN_INVOICE LOADED 934');

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
oTable = $('#dTable').dataTable({
	
	"bJQueryUI": false,
	/*"bRetrieve": true,*/
	"bAutoWidth": false,
	"sPaginationType": "full_numbers",
	"sDom": '<"H"fl>t<"F"ip>',
	"sAjaxSource": 'clases/admin/admin_gen_invoice.php?m='+$('#qmonth').text()+'&y='+$('#qyear').text(),
	"oLanguage": {
        "sUrl": qlen
    },
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
    	sName: "telefono"
    },
    {
    	sName: "e_mail"
    },
    {
    	sName: "direccion"
    }] 

})


//forma de num de tel
$(".maskPhone").mask("(999) 999-9999");


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
/*
$("#dTable tbody").click(function(event) {
	
	var who = $(this).closest('table tbody tr').
	$('tbody tr td:first-child').each(function (){
		$(this).closest('table tbody tr').addClass('thisRow');		
		
		if ($(this).hasClass('thisRow')) {
			console.log('selected!!!');
			$(this).closest('table tbody tr').addClass('thisRow');
		} else {
			$(this).closest('table tbody tr').removeClass('thisRow');
		}
		
	});
	$(event.target.parentNode).addClass('checked');
});	
*/

/*
$("#dTable tbody").on('click',function(event) {
	console.log('chido');
	$("#dTable tbody tr").removeClass('thisRow');		
	$(this).addClass('thisRow');
});
*/
