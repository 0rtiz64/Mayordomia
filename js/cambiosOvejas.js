
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

function modalEditarEnlazado(idIntegrante) {
alert(idIntegrante);
}


function modalEditarNoEnlazado(idIntegrante) {
    var url = 'php/cambiosOvejasConsultarModal.php';
    var enlazado = 2;
    $.ajax({
        type:'POST',
        url:url,
        data:{
            phpIdIntegrante:idIntegrante,
            phpEnlazado:enlazado
        },

        success: function(datos){
          //SUCCCESS ABRIR MODAL ASIGANAR DATOS;
            var res = eval(datos);
            $('#modalEditarOvejaSinEnlazar').modal({
                show:true,
                backdrop:'static'
            });//FIN ABRIR MODAL

        }
    });
    return false;

}



function impresiones(idIntegrante) {

    if($('#btn'+idIntegrante).hasClass('cerrado')== true){
        $('#btn'+idIntegrante).animate({height:'33px',width:'33px'},100);
        $('#c1'+idIntegrante).removeClass('collapse').show(200);
        $('#c2'+idIntegrante).removeClass('collapse').show(200);
        $('#c3'+idIntegrante).removeClass('collapse').show(200);
        $('#btn'+idIntegrante).removeClass('cerrado');
        $('#btn'+idIntegrante).addClass('abierto');
    }else{
        if($('#btn'+idIntegrante).hasClass('abierto')== true){
            $('#c1'+idIntegrante).removeClass('collapse').hide(200);
            $('#c2'+idIntegrante).removeClass('collapse').hide(200);
            $('#c3'+idIntegrante).removeClass('collapse').hide(200);
            $('#btn'+idIntegrante).removeClass('abierto');
            $('#btn'+idIntegrante).addClass('cerrado');
        }
    }


}
