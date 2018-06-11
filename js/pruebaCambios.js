
$(document).ready(function () {
    $("input:submit").click(function () {
        return false;
    })


});


function miEditarOvejas(recibo) {
    $('#formularioModal')[0].reset();
    $("#MensajeModal").empty();
    var url = 'php/editarOvejaIntegrada.php';
    $.ajax({
        type:'POST',
        url:url,
        data:'phpRecibo='+recibo,
        success: function(valores){
            var datos = eval(valores);

            $('#identidadInputMod').val(datos[0]);
            $('#nombreInputMod').val(datos[1]);
            $('#celInputMod').val(datos[2]);
            $('#telInputMod').val(datos[3]);
            $('#inputArea1Mod').val(datos[4]);
            $('#inputArea2Mod').val(datos[5]);
            $('#inputArea3Mod').val(datos[6]);
            $('#inputArea4Mod').val(datos[7]);
            $('#inputArea5Mod').val(datos[8]);
            $('#idInputMod').val(datos[9]);
            $('#fijoInputMod').val(datos[10]);


            $('#scrollingModalModificar').modal({
                show:true,
                backdrop:'static'
            });
            return false;
        }
    });
    return false;
}