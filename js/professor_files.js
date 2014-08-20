
console.log('ADMIN_STUDENTS_A LOADED 715');

//localization (solo cuando hay calendario de UI)
var qlen = '';
if ($('#qlango').text() == 'es'){
	qlen = "js/datatablesloc/dataTables.spanish.txt";
} else if ($('#qlango').text() == 'en'){
	qlen = "js/datatablesloc/dataTables.english.txt";
} else if ($('#qlango').text() == 'fr'){
	qlen = "js/datatablesloc/dataTables.francais.txt";
}

var isInitialized = false;
//EDITABLE
oTable = $('#dTable').on("init", function() {

		$('.on_off :checkbox').iButton({
			labelOn: "",
			labelOff: "",
			enableDrag: false 
		});
		console.log('DTABLE INITED');
	 
	}).dataTable({
	
	"bJQueryUI": false,
	"bRetrieve": true,
	"bAutoWidth": false,
	"sPaginationType": "full_numbers",
	"sDom": '<"H"fl>t<"F"ip>',
	"sAjaxSource": 'clases/student/student_files.php',
	"oLanguage": {
        "sUrl": qlen
    },
	"fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
		$(nRow).attr('id', aData[0]);
        return nRow;
	},
	aoColumns: [
    {
    	sName: "pathe",
    	bSearchable: false,
		bVisible: false
    },
    {
    	sName: "name"
    },
    {
    	sName: "qnombre"
    },  
    {
    	sName: "code"
    },
    {
    	sName: "patho"
    },
    {
    	sName: "qpublic"
    }] 

}).makeEditable({
    sDeleteURL: "clases/delFileOk.php",
    fnOnDeleting: function (tr, id, fnDeleteRow) {
        //jConfirm('Please confirm that you want to delete row with pathe ' + id, 'Confirm Delete', function (confirmed) {
        jConfirm('¿Está seguro que desea borrar el archivo?', 'Confirmar borrado', function (confirmed) {
            if (confirmed) {
                fnDeleteRow(id);
            }
        });
        return false;
    }
});

	/*.makeEditable({
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
});*/


//función para activar compartición de archivo
function setshared(qid,patho){

	function set(isset){
		console.log('SETEANDO '+qid+' con el patho:'+patho+' isset:'+isset);
		$.post('clases/student/setshared.php', { qpatho:patho, yesno:isset }, function(data) {
			if (parseInt(data) == '1'){
				$.jGrowl('Cambió la configuración de compartido');
			} else {
				$.jGrowl('Problema al guardar');
			}
		})
	}

	if ($('#check'+qid).prop('checked') == true){
		set(1);
	} else {
		set(0);
	}
}