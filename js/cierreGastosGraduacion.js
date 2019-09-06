$(document).ready(function () {
    $("input:submit").click(function () {
        return false;
    });
});

$("#inputFechaCierre").on('focusout',function () {
    var fecha = $("#inputFechaCierre").val();
    var url = 'php/cierreGastosGraduacion.php';

    $.ajax({
        type:'POST',
        url:url,
        data:{
            phpFecha: fecha
        },
        success: function(datos){
            //SUCCESS
            $("#resultadoCierreGastosGraduacion").fadeIn(300).html(datos);

            return false;
        }
    });
});

function cierreHoy() {
    var fecha = new Date();
    var url = 'php/cierreGastosGraduacion.php';
    $.ajax({
        type:'POST',
        url:url,
        data:{
            phpFecha: fecha
        },
        success: function(datos){
            //SUCCESS
            $("#resultadoCierreGastosGraduacion").fadeIn(300).html(datos);

            return false;
        }
    });
}

function imprimirReporte() {
    var fecha = $("#fechaImprimirReciboReporteGastosGraduacion").val();
    var urlImprimir = 'php/reciboReporteGastosGraduacion.php?fecha='+fecha;
    var pop = window.open(urlImprimir);
    pop.print();
}