$(document).ready(function () {
    $("input:submit").click(function () {
        return false;
    });

});

function verDetalles() {
    $("#abonos").hide(300);
    $("#detalles").show(300);
}

function regresar() {
    $("#detalles").hide(300);
    $("#abonos").show(300);
}

function cerrarCard() {
    $("#resultados").fadeOut(400);
}

function openModalPago(){
    $('#modalPago').modal({
        show:300,
        backdrop:'static',

    });//FIN ABRIR MODAL

}

$('#modalPago').on('hidden.bs.modal', function (e) {
    $("#inputTipoPago").val("");
    $("#inputValorPago").val("");
    $("#divValorPago").removeClass('has-error has-success');
    $("#divTipoPago").removeClass('has-error has-success');
    $("#inputValorPago").removeClass('Readonly').removeAttr( "readonly");
});

function buscarDatos() {
    var id = $("#tagDatosInput").val();
    var url = 'php/buscarDatosGastosGraduacion.php';
    $.ajax({
        type:'POST',
        url:url,
        data:'phpIdIntegrante='+id,
        success: function(datos){
            //SUCCESS

            if(datos == 2){
                $("#tagDatosInput").val("");
                swal("TAG INVALIDO", "NO ENCONTRADO O NO PERTENECE A ESTA PROMOCION", "error");
                $("#resultados").fadeOut(400);
                return false;
            }else{
                $("#tagDatosInput").val("");
                $("#resultados").fadeOut(400).fadeIn(400).html(datos);
                var talla =  document.getElementById("tallaDetalle").value;
                $("#togaTallaSelect").val(talla);

            }

        }
    });
    return false;

}

$("#inputValorPago").on('keyup',function () {
   var idIntegrante = $("#idIntegranteInput").val();
   var valor= $("#inputValorPago").val();
   var tipoPago= $("#inputTipoPago").val();
   var url = "php/validarPago.php";

    $.ajax({
        type:'POST',
        url:url,
        data:{
            phpIdIntegrante: idIntegrante,
            phpValor: valor,
            phpTipoPago: tipoPago
        },
        success: function(datos){
            //SUCCESS
            if(datos == 1){
                swal({
                    title: "ERROR",
                    text: "¡NO PUEDES PAGAR MAS DE LO QUE DEBES!",
                    icon: "warning",
                    dangerMode: true
                });
                $("#inputValorPago").val("");
            }
            return false;
        }
    });
    return false;
});

$("#inputTipoPago").on('change',function () {
    var idIntegrante = $("#idIntegranteInput").val();
    var valor= $("#inputValorPago").val();
    var tipoPago= $("#inputTipoPago").val();
    var url = "php/validarPago.php";

    if(tipoPago == 2){
        $("#inputValorPago").addClass('Readonly').attr('readonly','readonly');
    }else{
        $("#inputValorPago").removeClass('Readonly').removeAttr( "readonly");
        $("#inputValorPago").val("");
    }

    $.ajax({
        type:'POST',
        url:url,
        data:{
            phpIdIntegrante: idIntegrante,
            phpValor: valor,
            phpTipoPago: tipoPago
        },
        success: function(datos){
            //SUCCESS
            if(datos != 1){
                $("#inputValorPago").val(datos);
            }
            return false;
        }
    });
    return false;
return false;
});

function realizarPago() {
    var idIntegrante = $("#idIntegranteInput").val();
    var tipoPago = $("#inputTipoPago").val();
    var valor = $("#inputValorPago").val();
    var url = 'php/realizarPago.php';
    if(tipoPago.trim().length==""){
        $("#divTipoPago").addClass('has-error');
        alertify.error("CAMPO VACIO");
        return false;
    }else{
        $("#divTipoPago").removeClass('has-error');
        $("#divTipoPago").addClass('has-success');
        if(valor.trim().length==""){
            $("#divValorPago").addClass('has-error');
            alertify.error("CAMPO VACIO");
            return false;
        }else{
            $("#divValorPago").removeClass('has-error');
            $("#divValorPago").addClass('has-success');
        }//FIN VALOR
    }// FIN TIPO PAGO

    $.ajax({
        type:'POST',
        url:url,
        data:{
            phpIdIntegrante: idIntegrante,
            phpValor: valor,
            phpTipoPago: tipoPago
        },
        success: function(datos){
            //SUCCESS
            if(datos == 1){
                swal({
                    title: "ERROR",
                    text: "¡NO PUEDES PAGAR MAS DE LO QUE DEBES!",
                    icon: "warning",
                    dangerMode: true
                });
                $("#inputValorPago").val("");
                $("#inputTipoPago").val("");
                $("#inputValorPago").removeClass('Readonly').removeAttr( "readonly");
            }else{
                $("#resultados").fadeOut(400).fadeIn(400).html(datos);
                var talla =  document.getElementById("tallaDetalle").value;
                $("#togaTallaSelect").val(talla);
                $("#inputTipoPago").val("");
                $("#inputValorPago").val("");
                $("#inputValorPago").removeClass('Readonly').removeAttr( "readonly");
                $('#modalPago').modal('toggle');
            }

            return false;
        }
    });
}

function cambioTalla() {
    var idIntegrante = $("#idIntegranteInput").val();
    var nuevaTalla = document.getElementById('togaTallaSelect').value;
    var url = 'php/guardarNuevaTalla.php';
    $.ajax({
        type:'POST',
        url:url,
        data:{
            phpIdIntegrante: idIntegrante,
            phpNuevaTalla: nuevaTalla
        },
        success: function(datos){
            //SUCCESS
            alertify.success("TALLA ACTUALIZADA");
            console.log(datos);
            return false;
        }
    });
}

function enviarAColaPrint(idDetallePago,fecha) {
    $("#datoReciboAImprimir").html("IMPRIMIR RECIBO - "+fecha);
    $("#idDetallePagoEnCola").val(idDetallePago);
    console.log(idDetallePago);
}

function imprimirRecibo() {
    var idDetallePago = $("#idDetallePagoEnCola").val();

    if(idDetallePago.trim().length==""){
        swal({
            title: "ERROR",
            text: "¡DEBES COLOCAR UN RECIBO EN COLA!",
            icon: "warning",
            dangerMode: true
        });
        return false;
    }else{
        swal({
            title: "IMPRIMIENDO",
            text: "¡TRABAJANDO EN IMPRESION!",
            icon: "success",
            dangerMode: true
        });
    }
}


