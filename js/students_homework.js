
console.log('STUDENTS_HOMEWORK LOADED');
var loadme;

//localization
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
	"sAjaxSource": 'clases/student/students_homework.php',
	"oLanguage": {
        "sUrl": qlen
    },
	"fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
		$(nRow).attr('id', aData[0]);
		return nRow;
	},
	aoColumns: [{
        sName: "idTareas",
        bSearchable: false,
		bVisible: false
    },
    {
    	sName: "nombre"
    },
    {
    	sName: "fecha"
    },  
    {
    	sName: "fechaEntrega"
    },
    {
    	sName: "qmatname"
    },
    {
    	sName: "qstatus"
    }] 

});



oTable = $('#dTable_done').dataTable({
	
	"bJQueryUI": false,
    /*"bRetrieve": true,*/
	"bAutoWidth": false,
	"sPaginationType": "full_numbers",
	"sDom": '<"H"fl>t<"F"ip>',
	"sAjaxSource": 'clases/student/students_homework_done.php',
	"oLanguage": {
        "sUrl": qlen
    },
	"fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
		$(nRow).attr('id', aData[0]);
        return nRow;
	},
    /*
    "fnCreatedRow": function( nRow, aData, iDataIndex ) {        
        $('[id^=bu_]').click(function(ev){
            assignme($(this).attr('data-url'));            
            ev.preventDefault();
        });
        alert( 'DataTables has finished its initialisation. 2208' );
    },
    */
	aoColumns: [{
        sName: "idTareas",
        bSearchable: false,
		bVisible: false
    },
    {
    	sName: "nombre"
    },
    {
    	sName: "fecha"
    },  
    {
    	sName: "fechaEntrega"
    },
    {
    	sName: "qmatname"
    },
    {
    	sName: "qgrade"
    }] 

});





//esta no es una tabla editable
/*
.makeEditable({
    sUpdateURL: "clases/admin/students_update.php",
    sAddURL: "clases/admin/students_add.php",
    sDeleteURL: "clases/admin/students_delete.php",
    fnOnDeleting: function (tr, id, fnDeleteRow) {
        //jConfirm('Please confirm that you want to delete row with id ' + id, 'Confirm Delete', function (confirmed) {
        jConfirm($('#deldialog').html(), $('#deltitle').html(), function (confirmed) {
            if (confirmed) {
                fnDeleteRow(id);
            }
        });
        return false;
    }
});
*/


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
