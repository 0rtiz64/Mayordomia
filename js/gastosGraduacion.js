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
                $("#togaTallaSelectModalPago").val(talla);

            }
        }
    });
    return false;

}

$("#inputBusquedaNombreGastosGraduacion").on('keyup',function () {
 var nombre =$("#inputBusquedaNombreGastosGraduacion").val().toUpperCase();
 var url= 'php/buscarGastosGraduacionPorNombre.php';

 if(nombre.trim().length  ==""){
     $("#tagDatosInput").val("");
     $("#resultados").fadeOut(400);

     return false;
 }
    $.ajax({
        type:'POST',
        url:url,
        data:'phpNombre='+nombre,
        success: function(datos){
            //SUCCESS
            if(datos == 2){
                $("#tagDatosInput").val("");
                swal("TAG INVALIDO", "NO ENCONTRADO O NO PERTENECE A ESTA PROMOCION", "error");
                $("#resultados").fadeOut(400);
                return false;
            }else{
                $("#tagDatosInput").val("");
                $("#resultados").fadeIn(400).html(datos);
                var talla =  document.getElementById("tallaDetalle").value;
                $("#togaTallaSelect").val(talla);
                $("#togaTallaSelectModalPago").val(talla);

            }
        }
    });
});

$("#tagDatosInput").on('focusin',function () {
    $("#inputBusquedaNombreGastosGraduacion").val("");
});

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
        },error: function () {
            swal({
                title: "ERROR",
                text: "¡SIN CONEXION CON EL SERVIDOR!",
                icon: "warning",
                dangerMode: true
            });
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
            $("#togaTallaSelectModalPago").val(nuevaTalla);
            return false;
        }
    });
}

function cambioTallaModalPago() {
    var idIntegrante = $("#idIntegranteInput").val();
    var nuevaTalla = document.getElementById('togaTallaSelectModalPago').value;
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
            document.getElementById('togaTallaSelect').value= nuevaTalla;
            console.log(datos);

            return false;
        }
    });
}

function enviarAColaPrint(idDetallePago,fecha) {
    $("#datoReciboAImprimir").html("IMPRIMIR RECIBO - "+fecha);
    $("#idDetallePagoEnCola").val(idDetallePago);

}

function imprimirRecibo() {
    var idDetallePago = $("#idDetallePagoEnCola").val();
    var url = 'php/buscarDatosParaRecibo.php';

    if(idDetallePago.trim().length==""){
        swal({
            title: "ERROR",
            text: "¡DEBES SELECCIONAR UN RECIBO!",
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

    //CREAR AJAX PARA CONSULTAR DATOS DEL RECIBO
    $.ajax({
        type:'POST',
        url:url,
        data:{
            phpIdDetallePago: idDetallePago

        },
        success: function(datos){
           //ENVIAR A IMPRIMIR;
            var data = eval(datos);
            console.log("PROMOCION: "+data[0]+" FECHA: "+data[1]+" NUMERO RECIBO: "+data[2]+" NOMBRE: "+data[3]+" EXPEDIENTE: "+data[4]+" EQUIPO"+data[5]+" VALOR: "+data[6]+" TIPO PAGO: "+data[7]+" SALDO ANTERIOR: "+data[8]+" SALDO ACTUAL: "+data[9]);
            var promocion = data[0];
            var fecha = data[1];
            var numRecibo = data[2];
            var nombre = data[3];
            var expediente = data[4];
            var equipo = data[5];
            var valor = data[6];
            var tipo = data[7];
            var saldoAnterior = data[8];
            var saldoActual = data[9];
            var urlenviar = 'php/reciboGastosGraduacion.php?promocion='+promocion+'&fecha='+fecha+'&numRecibo='+numRecibo+'&nombre='+nombre+'&expediente='+expediente+'&equipo='+equipo+'&valor='+valor+'&tipo='+tipo+'&anterior='+saldoAnterior+'&actual='+saldoActual;
            enviarImprimir(urlenviar);
            return false;
        }
    });
}

function enviarImprimir(urlRecibida) {
    var pop = window.open(urlRecibida);
    pop.print();
}


