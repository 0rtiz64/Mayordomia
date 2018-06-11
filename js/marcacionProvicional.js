
$(document).ready(function () {
    $("input:submit").click(function () {
        return false;
    });

});


function marcacionProvicionalActivar() {
    var idIntegrante =$('#inputMarcacionProvicional').val();
    var url  = 'php/marcacionProvicional.php';

    if(idIntegrante.trim().length==""){
        $('#divInputProvicional').addClass('has-error');
        alertify.error('CAMPO VACIO');
        return false;
    }else{
        $('#divInputProvicional').removeClass('has-error');
        $('#divInputProvicional').addClass('has-success');
    }
    $.ajax({
        type:'POST',
        url : url,
        data :
            {idIntegrantePhp:idIntegrante},
        success:function (datos) {
            var datosProcesados = eval(datos);
            $('#resultado1').html(datosProcesados[0]).show(300).delay('2500').hide('200');
            $('#cantidadActual').html(datosProcesados[1]).show(300);
            $('#inputMarcacionProvicional').val("");


            return false;
        }
    });
    return false;


}