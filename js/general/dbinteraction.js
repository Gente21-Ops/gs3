$(window).load(function() {
    //////////////////////////////////////

    $.fn.serializeObject = function()
    {
       var o = {};
       var a = this.serializeArray();
       $.each(a, function() {
           if (o[this.name]) {
               if (!o[this.name].push) {
                   o[this.name] = [o[this.name]];
               }
               o[this.name].push(this.value || '');
           } else {
               o[this.name] = this.value || '';
           }
       });
       return o;
    };

    //solo cambiar este parámetro si cambia el nombre de la forma
    var qform = 'addaccountsform';
    $('#'+qform).submit(function() {

       // alert('sending...');

        $.post("/gs3b/clases/dbinteraction.php", { qtable:$('#qtable').val(), qdata:JSON.stringify($('#'+qform).serializeObject()), qtype:$('#qaction').val() }, function(qr){

            //alert('seee');
            if (parseInt(qr) == 1){
                alert('chido...');
                window.location = "/gs3b/inventario.php";
            } else {
                alert('nel...');
                var err = qr.split('ˆ');
                alert(err[1]);
            }

        });
        return false;
    });

});