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

    if(tipoPago == 3){
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