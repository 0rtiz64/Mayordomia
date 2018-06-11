
$(document).ready(function () {
    $("input:submit").click(function () {
        return false;
    });

});


//MARCACION AUTOMATICA INICIO
function marcacionAuto() {
    var identidadjs = $('#marcacionAutoInput').val();
    var url = "php/marcacionesAuto.php";

    if(identidadjs.trim().length == ""){
        $('#marcacionAutoInput').focus();
        return false;
    }else{

    }


    $.ajax({
        type:'POST',
        url : url,
        data :
            {identidad:identidadjs},
        success:function (datos) {
            var valores= eval(datos);

            $('#tablaDatos').html(valores[0]).show(300);
            $('#ovejasDiv').html(valores[1]);
            $('#pastDiv').html(valores[2]);
            $('#lidDiv').html(valores[3]);
            $('#marcacionAutoInput').val("");
            porcentajesEquipos();
            return false;
        }
    });
    return false;
};

//MARCACION AUTOMATICA FINAL


//MARCACION MANUL INICIO

//ABRIR MODAL
$('#buscarBoton').on('click',function(){
    $('#ModalInputName').val("");
    $('#ModalInputName').focus;
    $("#agrega-personas").empty();

    $('#scrollingModal').modal({
        show:true,
        backdrop:'static'
    });
});

//BUSCAR INTEGRANTE CON MODAL
$('#ModalInputName').on('keyup',function(){
    var dato = $('#ModalInputName').val();
    var url = 'php/buscar_persona.php';
    $.ajax({
        type:'POST',
        url:url,
        data:'nombrePersona='+dato,
        success: function(datos){
            $('#agrega-personas').html(datos);
        }
    });
    return false;
});


//COPIAR IDENTIDAD DE MODAL A INPUT
function Mostrar(idnum){

    $('#scrollingModal').modal('toggle');
    $("#marcacionManualInput").val(idnum);
    //alert('Numero de identidad recibio es : '+);
}


//TOMAR LA ASISTENCIA
function marcarManual(){

    var num_identidad = $('#marcacionManualInput').val();

    if(num_identidad.trim().length == ""){
        $('#marcacionManualInput').focus();
        return false;
    }else{

    }


    var url = 'php/cambios.php';

    $.ajax({
        type:'POST',
        url:url,
        data:{IDENTIDAD1: num_identidad},
        success: function(datos){
            var valores= eval(datos);

            $('#tablaDatos').html(valores[0]).show(300);
            $('#ovejasDiv').html(valores[1]);
            $('#pastDiv').html(valores[2]);
            $('#lidDiv').html(valores[3]);
            $('#marcacionManualInput').val("");
            porcentajesEquipos();
            return false;
        }
    });

    return false;

}

//ASISTENCIA MANUAL FIN


//ASISTENCIA PROVICIONAL INICIO

function marcacionProvicional() {
    var idIntegrante =$('#marcacionProvicionalInput').val();
    var url  = 'php/marcacionProvicional.php';

    if(idIntegrante.trim().length==""){
        $('#divInputProvicional').addClass('has-error');
        alertify.error('CAMPO VACIO');
        return false;
    }else{
        $('#divInputProvicional').removeClass('has-error');
        $('#divInputProvicional').addClass('has-success');
    }
    $.ajax({
        type:'POST',
        url : url,
        data :
            {idIntegrantePhp:idIntegrante},
        success:function (datos) {
            var valores= eval(datos);

            $('#tablaDatos').html(valores[0]).show(300);
            $('#ovejasDiv').html(valores[1]);
            $('#pastDiv').html(valores[2]);
            $('#lidDiv').html(valores[3]);
            $('#marcacionProvicionalInput').val("");
            porcentajesEquipos();

            return false;
        }
    });
    return false;


}

//ASISTENCIA PROVICIONAL FINAL
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

