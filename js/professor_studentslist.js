
console.log('PROFESRO_STUDENTSLIST 715');


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
	"sAjaxSource": 'clases/profesor/professor_studentslist.php?qgroupid='+$('#groupid').val(),
	"oLanguage": {
        "sUrl": qlen
    },
	"fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
		$(nRow).attr('id', aData[0]);
        return nRow;
	},
	aoColumns: [
    {
    	sName: "qidgrupo",
    	bSearchable: false,
		bVisible: false
    },
    {
    	sName: "qgruponame"
    },
    {
    	sName: "qidgrupo"
    },
    {
    	sName: "qidgrupo"
    }] 

});



//función para activar compartición de archivo
/*
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
*/