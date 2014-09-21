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
	"sAjaxSource": 'clases/admin/students.php',
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
    	sName: "nombre"
    },
    {
    	sName: "apellidos"
    },
    {
    	sName: "direccion"
    },
    {
    	sName: "telefono"
    },
    {
    	sName: "email"
    },
    {
    	sName: "nacimiento"
    },
    {
        "mData": null,
        "fnRender": function (oObj) {
	        //alert(JSON.stringify(oObj.aData));
	        //alert(oObj.aData.ADMINID)
	        return "<a href='editState?id=" + $(nRow).attr('id') + "'>Edit</a>";
	    }
    }] 

}).makeEditable({
    sUpdateURL: "clases/admin/students_update.php",
    sAddURL: "clases/admin/students_add.php",
    sDeleteURL: "clases/admin/students_delete.php",
    fnOnAdded: function(){ 	
		$.jGrowl('Registro agregado.');
	},
	fnOnEditing: function(){ 	
		$.jGrowl('Registro actualizado.');
	},
	fnOnDeleted: function(){ 	
		$.jGrowl("Registro eliminado.");
	}
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

