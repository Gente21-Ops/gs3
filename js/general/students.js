var loadme;
$(window).on("load", function(){


	//EDITABLE
	oTable = $('.dTable').dataTable({
		
		"bJQueryUI": false,
		"bAutoWidth": false,
		"sPaginationType": "full_numbers",
		"sDom": '<"H"fl>t<"F"ip>',
		"sAjaxSource": 'clases/students.php',
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

	}).makeEditable({
        sUpdateURL: "clases/admin/students_update.php",
        sAddURL: "clases/admin/students_add.php",
        sDeleteURL: "clases/admin/students_delete.php"
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