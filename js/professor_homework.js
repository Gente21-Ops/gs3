console.log('PROFESSOR HOMEWORK SE PRESENTA 0712');
var loadme;

//localization (solo cuando hay calendario de UI)
var qlen = '';
if ($('#qlang').text() == 'es'){
	qlen = "js/datatablesloc/dataTables.spanish.txt";
} else if ($('#qlango').text() == 'en'){
	qlen = "js/datatablesloc/dataTables.english.txt";
} else if ($('#qlango').text() == 'fr'){
	qlen = "js/datatablesloc/dataTables.francais.txt";
}
console.log(qlen);

//new task date
$.datepicker.regional[$('#qlang')];
$( ".datepicker1" ).datepicker({ 
    defaultDate: +7,
    showOtherMonths:true,
    autoSize: true,
    appendText: '(yyyy-mm-dd)',
    dateFormat: 'yy-mm-dd',
    onSelect: function(dateText) {
        $(this).change();
    }   
}).change(function() {
    //window.location.href = "index.php?date=" + this.value;
    var dater = this.value.split('-');
    //assignme('professor_takelist.php?qcode='+$('#qidgrupo').text()+'&qmat='+$('#qidmat').text()+'&y='+dater[0]+'&m='+dater[1]+'&d='+dater[2],'content'); return false;
});

//EDITABLE
oTable = $('.dTable').dataTable({
	"oLanguage": {
        sEmptyTable:     "No hay información por el momento.",
        sZeroRecords: "No hay información por el momento."
    },
	"bJQueryUI": false,
	"bAutoWidth": false,
	"sPaginationType": "full_numbers",
	"sDom": '<"H"fl>t<"F"ip>',
	"sAjaxSource": 'clases/profesor/professor_homework.php?qgroupid='+$('#groupid').text(),
	"fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
		$(nRow).attr('id', aData[0]);
		return nRow;
	},
	aoColumns: [{
        sName: "idtareas",
        bSearchable: false,
		bVisible: false
    },
    {
    	sName: "nombre"
    },
    {
    	sName: "descripcion"
    },
    {
    	sName: "fechaEntrega"
    },
    {
    	sName: "editar"
    },
    {
    	sName: "revisar"
    }] 

}).makeEditable({
sAddURL: "clases/profesor/homework_add.php",
sDeleteURL: "clases/profesor/homework_delete.php",
sUpdateURL: "clases/profesor/homework_update.php",
fnOnAdded: function(){     
        $.jGrowl('Registro agregado.');
    },
    fnOnDeleted: function(){    
        $.jGrowl("Registro eliminado.");
    },
    fnOnEdited: function(){     
        $.jGrowl("Registro actualizado.");
    }
});



//select on click
$("div.dyn2 > table > tbody > tr").click(function(){
    $(this).closest('table tbody tr').addClass('thisRow');
});

