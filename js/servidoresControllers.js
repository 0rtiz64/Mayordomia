$(document).ready(function () {
    $("input:submit").click(function () {
        return false;
    });
});

//VALIDACION EMPTY INPUT//


$("#inputNombreRegister").on('focusout',function () {validarInput("inputNombreRegister","divDatosGeneralesHeader",1);});
$("#inputIdentidadRegister").on('focusout',function () {validarInput("inputIdentidadRegister","divDatosGeneralesHeader",1);});
$("#inputGeneroRegister").on('focusout',function () {validarInput("inputGeneroRegister","divDatosGeneralesHeader",1)});
$("#inputFechaNacimientoRegister").on('focusout',function () {validarInput("inputFechaNacimientoRegister","divDatosGeneralesHeader",2);});

$("#inputDireccionRegister").on('focusout',function () {validarInput("inputDireccionRegister","divDomicilioHeader",1)});
$("#inputTransporteRegister").on('focusout',function () {validarInput("inputTransporteRegister","divDomicilioHeader",1)});
$("#inputCivilRegister").on('focusout',function () {validarInput("inputCivilRegister","divDomicilioHeader",2)});

function validarInput(input,header,watch) {
    var campo = $("#"+input).val();
    if(campo.trim().length==""){
        $("#"+input).css("border-color", "#a94442");
        $("#"+header).css("background-color", "#a94442");
        alertify.error("CAMPO VACIO");
        return false;
    }else{
        $("#"+input).css("border-color", "#28A745");
        if(watch ==1){
            $("#"+header).css("background-color","#424242");
        }else{
            $("#"+header).css("background-color","#28A745");
        }
    }
};

//VALIDACION EMPTY INPUT//