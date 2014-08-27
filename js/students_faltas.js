
console.log('STUDENTS_FALTAS LOADED 934');

//localization (solo cuando hay calendario de UI)
var qlen = '';
if ($('#qlango').text() == 'es'){
	qlen = "js/datatablesloc/dataTables.spanish.txt";
} else if ($('#qlango').text() == 'en'){
	qlen = "js/datatablesloc/dataTables.english.txt";
} else if ($('#qlango').text() == 'fr'){
	qlen = "js/datatablesloc/dataTables.francais.txt";
}




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
