var loadme;
$(window).on("load", function(){


	//EDITABLE
	oTable = $('.dTable').dataTable({
		
		"bJQueryUI": false,
		"bAutoWidth": false,
		"sPaginationType": "full_numbers",
		"sDom": '<"H"fl>t<"F"ip>',
		"sAjaxSource": 'clases/admin/descuentos.php',
		"fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
			$(nRow).attr('id', aData[0]);
			return nRow;
		},
		aoColumns: [{
            sName: "idDescuentos",
            bSearchable: false,
			bVisible: false
        },
        {
        	sName: "name"
        },
        {
        	sName: "percent"
        },  
        {
        	sName: "recurrent"
        },
        {
        	sName: "idParciales"
        }] 

	}).makeEditable({
        sUpdateURL: "clases/admin/descuentos_update.php",
        sAddURL: "clases/admin/descuentos_add.php",
        sDeleteURL: "clases/admin/descuentos_delete.php"
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