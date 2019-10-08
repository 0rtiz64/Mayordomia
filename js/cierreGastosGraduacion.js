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


$("#inputFechaCierre2").on('focusout',function () {
    var fecha1 = $("#inputFechaCierre").val();
    var fecha2 = $("#inputFechaCierre2").val();
    var url = 'php/cierreGastosGraduacionRango.php';

    $.ajax({
        type:'POST',
        url:url,
        data:{
            phpFecha1: fecha1,
            phpFecha2: fecha2
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

function  imprimirReporteRango() {
    var fecha = $("#fechaImprimirReciboReporteGastosGraduacion").val();
    var fecha2 = $("#inputFechaCierre2").val();
    var urlImprimir = 'php/reciboReporteGastosGraduacionRango.php?fecha='+fecha+'&fecha2='+fecha2;
    var pop = window.open(urlImprimir);
    pop.print();
}