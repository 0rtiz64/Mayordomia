
$(document).ready(function () {
    $("input:submit").click(function () {
        return false;
    })


});


function reporteAusentes() {
    var fecha=  $('#fechaAusentes').val();
    var url = 'php/ausentes.php';

    if(fecha.trim().length ==""){
        $('#divInputFecha').addClass('has-error');
        alertify.error('CAMPO VACIO');
        return false;
    }else{
        $('#divInputFecha').removeClass('has-error');
        $('#divInputFecha').addClass('has-success');
    }

    $.ajax({
        type:'POST',
        url:url,
        data: {
            phpfecha: fecha
        },
        success: function (datos) {
        $('#tablaAusentes').html(datos);
            return false;
        }
    });
    return false;
}