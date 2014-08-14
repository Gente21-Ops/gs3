var loadme;
$(window).on("load", function(){


	//EDITABLE
	oTable = $('.dTable').dataTable({
		
		"bJQueryUI": false,
		"bAutoWidth": false,
		"sPaginationType": "full_numbers",
		"sDom": '<"H"fl>t<"F"ip>',
		"sAjaxSource": 'clases/admin/parciales.php',
		"fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
			$(nRow).attr('id', aData[0]);
			return nRow;
		},
		aoColumns: [{
            "sName": "idParciales",
            "bSearchable": false,
			"bVisible": false
        },
        {
        	"sName": "nombre"
        },  
        {
        	"sName": "descripcion"
        },
        {
        	"sName": "abierto"
        },
        {
        	"sName": "limite_pago"
        },
        {
        	"sName": "esparcial"
        }] 
 

	}).makeEditable({
        sUpdateURL: "clases/admin/parciales_update.php",
        sAddURL: "clases/admin/parciales_add.php",
        sDeleteURL: "clases/admin/parciales_delete.php",
        "aoColumns": [
        	null,
        	null,
        	null,
        	null,
        	{
	            type: 'select',
	            onblur: 'submit',
	            data: "{'1':'Si','0':'No'}"
            }
        ]
    });

    // Datepicker
	$('#limite_pago').datepicker({
	    inline: true,
	    showOtherMonths:true,
	    dateFormat: 'yy-mm-dd'
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