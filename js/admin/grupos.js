var loadme;
$(window).on("load", function(){


	//EDITABLE
	oTable = $('.dTable').dataTable({
		
		"bJQueryUI": false,
		"bAutoWidth": false,
		"sPaginationType": "full_numbers",
		"sDom": '<"H"fl>t<"F"ip>',
		"sAjaxSource": 'clases/admin/grupos.php',
		"fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
			$(nRow).attr('id', aData[0]);
			return nRow;
		},
		aoColumns: [{
            sName: "idGrupos",
            bSearchable: false,
			bVisible: false
        },
        {
        	sName: "nombre"
        }] 

	}).makeEditable({
        sUpdateURL: "clases/admin/grupos_update.php",
        sAddURL: "clases/admin/grupos_add.php",
        sDeleteURL: "clases/admin/grupos_delete.php"
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

});