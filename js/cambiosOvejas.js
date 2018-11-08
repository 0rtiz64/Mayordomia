
$(document).ready(function () {
    $('#nombreOveja').focus;
    $("input:submit").click(function () {
        return false;
    })

});

$('#nombreOveja').on('keyup',function () {
var nombre = $('#nombreOveja').val().toUpperCase();

    var url = 'php/cambiosOvejasConsultarTabla.php';

    $.ajax({
        type:'POST',
        url:url,
        data:'nombre='+nombre,
        success: function(datos){
            $('#tablaRegistros').html(datos);
        }
    });
    return false;

});
