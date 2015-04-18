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

GL.consol('q estudiante: '+$('#qestudiante').text);

//EDITABLE
oTable = $('.dTable').dataTable({
	
	"bJQueryUI": false,
	"bAutoWidth": false,
	"sPaginationType": "full_numbers",
	"sDom": '<"H"fl>t<"F"ip>',
	"sAjaxSource": 'clases/admin/admin_parents.php?qestudiante='+$('#qestudiante').text(),
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
    },
    {
    	sName: "apellidos"
    },
    {
    	sName: "correo"
    },
    {
    	sName: "datos"
    }] 

}).makeEditable({
    sUpdateURL: "clases/admin/parents_update.php",
    sAddURL: "clases/admin/parents_add.php",
    sDeleteURL: "clases/admin/parents_delete.php"
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

function openPoptareas(qid){
    selectedID = qid;
    GL.getter('clases/getUser.php',{ qnewid:qid },'json',newgot);
    $('.on_off :checkbox, .on_off :radio').iButton({
        labelOn: "",
        labelOff: "",
        enableDrag: false 
    });
    //GL.consol('el id es: '+selectedID);
    function newgot(myidgot) {
        //console.log("myidgot");
        //console.log("hola:"+myidgot['qNombre']);
        document.getElementById('qNombre').value = myidgot['qNombre']; 
        document.getElementById('qEmail').value = myidgot['qEmail']; 

        //GL.consol('el status '+myidgot['qStatus']);

        nomUser = myidgot['qNombre'];
        emailUser = myidgot['qEmail'];
        //$('#mod_respuesta').dialog('open');

        sendEmail(qid,nomUser,emailUser);
    }

    

    return false;
}

function sendEmail(qid,nomUser,emailUser){
    $('#mod_email').dialog('open');
    $('#mod_email').dialog({
        autoOpen: true, 
        width: 400,
        modal: true,
        hide: { effect: "fade", duration: 200 },
        buttons: {
            "Enviar correo": function () {
                //$.blockUI();        
                //GL.consol('chido');        
                /*var qRemitente = document.getElementById('qRemitente').value;
                var qNombre = document.getElementById('qNombre').value;
                var qEmail = document.getElementById('qEmail').value;
                var qEmailRemitente = document.getElementById('qEmailRemitente').value;
                var qAsunto = document.getElementById('qAsunto').value;
                var qMensaje = document.getElementById('qMensaje').innerHTML;*/

                var qRemitente = $("#qRemitente").val();
                var qNombre = $("#qNombre").val();
                var qEmail = $("#qEmail").val();
                var qEmailRemitente = $("#qEmailRemitente").val();
                var qAsunto = $("#qAsunto").val();
                var qMensaje = $("#qMensaje").val();

                //GL.consol("chido: "+qMensaje);
                
                $.post( 'clases/sendEmail.php', {
                    remitente: qRemitente,
                    nombre: qNombre,
                    email: qEmail,
                    emailRemitente: qEmailRemitente,
                    asunto: qAsunto,
                    mensaje: qMensaje
                },
                    function(rdata){
                    	//GL.consol("dest: "+qEmail);
                    	//GL.consol("remit: "+qEmailRemitente);
                        if (rdata == '1'){
                            if (qid){
                                $.jGrowl($('#mailSent').text());
                            } else {
                                $.jGrowl($('#mailNotSent').text());
                            }
                        } else {
                            $.jGrowl($('#mailSent').text());
                        }
                        $.unblockUI();

                });
                
                $(this).dialog("close");
            },
            "Cancelar": function () {
                $(this).dialog("close");
            }
        }
    });
}
