$(document).ready(function () {
    $("input:submit").click(function () {
        return false;
    });

});


$('#Equipo').click(function () {
    $('#listPast').hide(100);
    $('#listadodPast').hide(200);

    $('#pastPorEquipo').show(200);
    $('#listEquipo').show(100);
});


$('#listado').click(function () {


    var url = 'php/listarPastoreadoresTodos.php';
var dato = 0;
    $.ajax({
        type:'POST',
        url:url,
        data: {
            phpDato: dato
        },
        success: function (tabla) {
            $('#pastPorEquipo').hide(200);
            $('#listEquipo').hide(100);

            $('#listPast').show(100);
            $('#listadodPast').show(200);
            $('#tablaListadoPastoreadoresTodos').html(tabla);
            return false;
        }
    });
    return false;
});

function deshabilitarPastoreador(idPast) {

    var url = 'php/deshabilitarPast.php';
    $.ajax({
        type:'POST',
        url:url,
        data: {
            phpId: idPast
        },
        success: function (tabla) {
            $('#tablaListadoPastoreadoresTodos').html(tabla);
            return false;
        }
    });
    return false;
}





