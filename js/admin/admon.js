var loadme;
$(window).on("load", function(){

	//EDITABLE
	oTable = $('#dTable').dataTable({
		
		"bJQueryUI": false,
		"bAutoWidth": false,
		"sPaginationType": "full_numbers",
		"sDom": '<"H"fl>t<"F"ip>',
		"sAjaxSource": 'clases/admin/admon.php',
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
        sUpdateURL: "clases/admin/admon_update.php",
        sAddURL: "clases/admin/admon_add.php",
        sDeleteURL: "clases/admin/admon_delete.php"
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
/*
	$("#dTable tbody").click(function(event) {
		
		var who = $(this).closest('table tbody tr').
		$('tbody tr td:first-child').each(function (){
			$(this).closest('table tbody tr').addClass('thisRow');		
			
			if ($(this).hasClass('thisRow')) {
				console.log('selected!!!');
				$(this).closest('table tbody tr').addClass('thisRow');
			} else {
				$(this).closest('table tbody tr').removeClass('thisRow');
			}
			
		});
		$(event.target.parentNode).addClass('checked');
	});	
*/
 
	$("#dTable tbody").on('click',function(event) {
		console.log('chido');
		$("#dTable tbody tr").removeClass('thisRow');		
		$(this).addClass('thisRow');
	});

});