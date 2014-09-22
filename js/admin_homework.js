
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
	"sAjaxSource": 'clases/admin/admin_homework.php?qestudiante='+$('#qestudiante').text(),
	"oLanguage": {
        "sUrl": qlen
    },
    "fnInitComplete": function(oSettings, json) {
      $.unblockUI();
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
	"sAjaxSource": 'clases/admin/admin_homework_done.php?qestudiante='+$('#qestudiante').text(),
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
