
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
	"oLanguage": {
        sEmptyTable:     "No hay información por el momento.",
        sZeroRecords: "No hay información por el momento."
    },
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
	"oLanguage": {
        sEmptyTable:     "No hay información por el momento.",
        sZeroRecords: "No hay información por el momento."
    },
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


