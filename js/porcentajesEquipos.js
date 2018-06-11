
$(document).ready(function () {
    $("input:submit").click(function () {
        return false;
    });

});

function porcentajesEquipos() {
    var url = 'php/porcentajes.php';
    var datoUno = 1;
    $.ajax({
        type:'POST',
        url:url,
        data:{datoUno: datoUno},
        success: function(datos){
$('#listaPorcentajesEquipos').html(datos);

            return false;
        }
    });

    return false;
}