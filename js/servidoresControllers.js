$(document).ready(function () {
    $("input:submit").click(function () {
        return false;
    });
});

//VALIDACION EMPTY INPUT//
/*

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
        alert(validados);
    }
};
*/
//VALIDACION EMPTY INPUT//

function validarDatosGenerales() {
    if($("#inputNombreRegister").val().trim().length ==""){
        $("#inputNombreRegister").css("border-color", "#a94442");
        $("#divDatosGeneralesHeader").css("background-color", "#a94442");
        alertify.error("CAMPO VACIO");
        return false;
    }else{
        $("#inputNombreRegister").css("border-color", "#28A745");
        $("#divDatosGeneralesHeader").css("background-color","#424242");

        if($("#inputIdentidadRegister").val().trim().length ==""){
            $("#inputIdentidadRegister").css("border-color", "#a94442");
            $("#divDatosGeneralesHeader").css("background-color", "#a94442");
            alertify.error("CAMPO VACIO");
            return false;

        }else{
            $("#inputIdentidadRegister").css("border-color", "#28A745");
            $("#divDatosGeneralesHeader").css("background-color","#424242");

            if ($("#inputGeneroRegister").val().trim().length ==""){
                $("#inputGeneroRegister").css("border-color", "#a94442");
                $("#divDatosGeneralesHeader").css("background-color", "#a94442");
                alertify.error("CAMPO VACIO");
                return false;
            }else{
                $("#inputGeneroRegister").css("border-color", "#28A745");
                $("#divDatosGeneralesHeader").css("background-color","#424242");

                if($("#inputFechaNacimientoRegister").val().trim().length==""){
                    $("#inputFechaNacimientoRegister").css("border-color", "#a94442");
                    $("#divDatosGeneralesHeader").css("background-color", "#a94442");
                    alertify.error("CAMPO VACIO");
                    return false;
                }else {
                    $("#inputFechaNacimientoRegister").css("border-color", "#28A745");
                    $("#divDatosGeneralesHeader").css("background-color","#28A745");
                }
            }// FIN GENERO
        } // FIN IDENTIDAD
    }// FIN NOMBRE
}

function validarDatosDomicilio() {
    if($("#inputDireccionRegister").val().trim().length ==""){
        $("#inputDireccionRegister").css("border-color", "#a94442");
        $("#divDomicilioHeader").css("background-color", "#a94442");
        alertify.error("CAMPO VACIO");
        return false;
    }else{
        $("#inputDireccionRegister").css("border-color", "#28A745");
        $("#divDomicilioHeader").css("background-color","#424242");

        if($("#inputTransporteRegister").val().trim().length ==""){
            $("#inputTransporteRegister").css("border-color", "#a94442");
            $("#divDomicilioHeader").css("background-color", "#a94442");
            alertify.error("CAMPO VACIO");
            return false;

        }else{
            $("#inputTransporteRegister").css("border-color", "#28A745");
            $("#divDomicilioHeader").css("background-color","#424242");

            if($("#inputTel1Register").val().trim().length==""){
                $("#inputTel1Register").css("border-color", "#a94442");
                $("#divDomicilioHeader").css("background-color", "#a94442");
                alertify.error("CAMPO VACIO");
                return false;
            }else{
                $("#inputTel1Register").css("border-color", "#28A745");
                $("#divDomicilioHeader").css("background-color","#424242");

                if ($("#inputCivilRegister").val().trim().length ==""){
                    $("#inputCivilRegister").css("border-color", "#a94442");
                    $("#divDomicilioHeader").css("background-color", "#a94442");
                    alertify.error("CAMPO VACIO");
                    return false;
                }else{
                    $("#inputCivilRegister").css("border-color", "#28A745");
                    $("#divDomicilioHeader").css("background-color","#28A745");

                }
            }
        }
    }
}
function cancelarRegister() {
    $("#divDatosGeneralesHeader").css("background-color","#424242");
    $("#divDomicilioHeader").css("background-color","#424242");
    $("#divIglesiaHeader").css("background-color","#424242");
    $("#divEducacionHeader").css("background-color","#424242");
    $("#divLaboralHeader").css("background-color","#424242");
    $("#divExpedienteHeader").css("background-color", "#424242");




    $("#inputNombreRegister").val("").css("border-color", "#CCCCCC");
    $("#inputIdentidadRegister").val("").css("border-color", "#CCCCCC");
    document.getElementById('inputGeneroRegister').value="";
    $("#inputGeneroRegister").css("border-color", "#CCCCCC");
    $("#inputFechaNacimientoRegister").val("").css("border-color", "#CCCCCC");
    $("#inputTipoSangreRegister").val("").css("border-color", "#CCCCCC");

    $("#inputDireccionRegister").val("").css("border-color", "#CCCCCC");
    $("#inputReferenciaRegister").val("").css("border-color", "#CCCCCC");
    $("#inputTipoCasaRegister").val("").css("border-color", "#CCCCCC");
    $("#inputTransporteRegister").val("").css("border-color", "#CCCCCC");
    $("#inputTel1Register").val("").css("border-color", "#CCCCCC");
    $("#inputTel2Register").val("").css("border-color", "#CCCCCC");
    $("#inputCorreoRegister").val("").css("border-color", "#CCCCCC");
    document.getElementById('inputCivilRegister').value="";
    $("#inputCivilRegister").css("border-color", "#CCCCCC");
    $("#inputConyugueRegister").val("").css("border-color", "#CCCCCC");
    $("#inputHijosRegister").val("").css("border-color", "#CCCCCC");

    $("#inputFechaConversionRegister").val("").css("border-color", "#CCCCCC");
    $("#inputFechaIglesiaRegister").val("").css("border-color", "#CCCCCC");
    document.getElementById('inputBautismoEsRegister').value="";
    $("#inputBautismoEsRegister").css("border-color", "#CCCCCC");
    $("#inputFechaReconciliacionRegister").val("").css("border-color", "#CCCCCC");
    $("#inputFechaBautismoAguasRegister").val("").css("border-color", "#CCCCCC");
    $("#inputFechaCoberturaRegister").val("").css("border-color", "#CCCCCC");
    document.getElementById('inputPromocionCorderitosRegister').value="";
    $("#inputPromocionCorderitosRegister").css("border-color", "#CCCCCC");
    $("#inputAreasRegister").val("").css("border-color", "#CCCCCC");
    $("#inputPromocionMayordomiaRegister").val("").css("border-color", "#CCCCCC");
    $("#inputExpedienteRegister").val("").css("border-color", "#CCCCCC");

    $("#inputNivelEducativoRegister").val("").css("border-color", "#CCCCCC");
    $("#inputProfesionRegister").val("").css("border-color", "#CCCCCC");
    $("#inputHabilidadesRegister").val("").css("border-color", "#CCCCCC");

    $("#inputEstadLaboralRegister").val("").css("border-color", "#CCCCCC");
    $("#inputEmpresaRegister").val("").css("border-color", "#CCCCCC");
    $("#inputPuestoRegister").val("").css("border-color", "#CCCCCC");
    $("#inputTelEmpresaRegister").val("").css("border-color", "#CCCCCC");
    $("#inputHorarioRegister").val("").css("border-color", "#CCCCCC");

    document.getElementById('inputCarnetRegister').value="";
    $("#inputCarnetRegister").css("border-color", "#CCCCCC");
    $("#inputVigenciaCarnetRegister").val("").css("border-color", "#CCCCCC");
    $("#inputFechaGestionRegister").val("").css("border-color", "#CCCCCC");
    $("#inputFechaEntregaRegister").val("").css("border-color", "#CCCCCC");
    $("#inputNombreCarnetEntregaRegister").val("").css("border-color", "#CCCCCC");
    $("#inputInicioMayordomiaRegister").val("").css("border-color", "#CCCCCC");
    document.getElementById('inputEquipoRegister').value="";
    $("#inputEquipoRegister").css("border-color", "#CCCCCC");
    document.getElementById('inputCargoRegister').value="";
    $("#inputCargoRegister").css("border-color", "#CCCCCC");
    document.getElementById('inputEstadoRegister').value="";
    $("#inputEstadoRegister").css("border-color", "#CCCCCC");
    $("#inputObservacionesRegister").val("").css("border-color", "#CCCCCC");
    $("#registradoPorRegister").val("").css("border-color", "#CCCCCC");
}

function registrarServidor() {
    var nombreRegister = $("#inputNombreRegister").val().toUpperCase();
    var identidadRegister = $("#inputIdentidadRegister").val().toUpperCase();
    var generoRegister = document.getElementById('inputGeneroRegister').value;
    var fechaNacimientoRegister = $("#inputFechaNacimientoRegister").val().toUpperCase();
    var tipoSangreRegister = $("#inputTipoSangreRegister").val().toUpperCase();

    var direccionRegister = $("#inputDireccionRegister").val().toUpperCase();
    var referenciaRegister = $("#inputReferenciaRegister").val().toUpperCase();
    var tipoCasaRegister = $("#inputTipoCasaRegister").val().toUpperCase();
    var transporteRegister = $("#inputTransporteRegister").val().toUpperCase();
    var tel1Register = $("#inputTel1Register").val().toUpperCase();
    var tel2Register = $("#inputTel2Register").val().toUpperCase();
    var correoRegister = $("#inputCorreoRegister").val().toUpperCase();
    var civilRegister = document.getElementById('inputCivilRegister').value;
    var conyugueRegister = $("#inputConyugueRegister").val().toUpperCase();
    var hijosRegister = $("#inputHijosRegister").val().toUpperCase();


    var fechaConvercionRegister = $("#inputFechaConversionRegister").val().toUpperCase();
    var fechaIglesiaRegister = $("#inputFechaIglesiaRegister").val().toUpperCase();
    var bautismoEspirituSantoRegister = document.getElementById('inputBautismoEsRegister').value;
    var fechaReconciliacionRegister = $("#inputFechaReconciliacionRegister").val().toUpperCase();
    var fechaBautismoAguasRegister = $("#inputFechaBautismoAguasRegister").val().toUpperCase();
    var fechaCoberturaRegister = $("#inputFechaCoberturaRegister").val().toUpperCase();
    var promocionCorderitosRegister = document.getElementById('inputPromocionCorderitosRegister').value;
    var areasRegister = $("#inputAreasRegister").val().toUpperCase();
    var promocionMayordomiaRegister = $("#inputPromocionMayordomiaRegister").val().toUpperCase();
    var expedienteRegister = $("#inputExpedienteRegister").val().toUpperCase();


   // var nivelEducativoRegister = document.getElementById('inputNivelEducativoRegister').value;
    var nivelEducativoRegister =$("#inputNivelEducativoRegister").val();
    var profesionRegister = $("#inputProfesionRegister").val().toUpperCase();
    var habilidadesRegister = $("#inputHabilidadesRegister").val().toUpperCase();

    var estadoLaboralRegister = $("#inputEstadLaboralRegister").val().toUpperCase();
    var empresaRegister = $("#inputEmpresaRegister").val().toUpperCase();
    var puestoRegister = $("#inputPuestoRegister").val().toUpperCase();
    var telefonoEmpresaRegister = $("#inputTelEmpresaRegister").val().toUpperCase();
    var horarioRegister = $("#inputHorarioRegister").val().toUpperCase();

    var carnetRegister = document.getElementById('inputCarnetRegister').value;
    var fechaVigenciaRegister = $("#inputVigenciaCarnetRegister").val().toUpperCase();
    var fechaGestionRegister = $("#inputFechaGestionRegister").val().toUpperCase();
    var fechaEntregaRegister = $("#inputFechaEntregaRegister").val().toUpperCase();
    var nombreCarnetRegister = $("#inputNombreCarnetEntregaRegister").val().toUpperCase();
    var fechaInicioMayordomiaRegister = $("#inputInicioMayordomiaRegister").val().toUpperCase();
    var equipoServicioRegister = document.getElementById('inputEquipoRegister').value;
    var cargoRegister = document.getElementById('inputCargoRegister').value;
    var estadoRegister =document.getElementById('inputEstadoRegister').value;
    var observacionesRegister = $("#inputObservacionesRegister").val().toUpperCase();
    var registradoPorRegister = $("#registradoPorRegister").val().toUpperCase();


    if($("#inputNombreRegister").val().trim().length ==""){
        $("#inputNombreRegister").css("border-color", "#a94442");
        $("#divDatosGeneralesHeader").css("background-color", "#a94442");
        alertify.error("CAMPO VACIO");
        return false;
    }else{
        $("#inputNombreRegister").css("border-color", "#28A745");
        $("#divDatosGeneralesHeader").css("background-color","#424242");

        if($("#inputIdentidadRegister").val().trim().length ==""){
            $("#inputIdentidadRegister").css("border-color", "#a94442");
            $("#divDatosGeneralesHeader").css("background-color", "#a94442");
            alertify.error("CAMPO VACIO");
            return false;

        }else{
            $("#inputIdentidadRegister").css("border-color", "#28A745");
            $("#divDatosGeneralesHeader").css("background-color","#424242");

            if ($("#inputGeneroRegister").val().trim().length ==""){
                $("#inputGeneroRegister").css("border-color", "#a94442");
                $("#divDatosGeneralesHeader").css("background-color", "#a94442");
                alertify.error("CAMPO VACIO");
                return false;
            }else{
                $("#inputGeneroRegister").css("border-color", "#28A745");
                $("#divDatosGeneralesHeader").css("background-color","#424242");

                if($("#inputFechaNacimientoRegister").val().trim().length==""){
                    $("#inputFechaNacimientoRegister").css("border-color", "#a94442");
                    $("#divDatosGeneralesHeader").css("background-color", "#a94442");
                    alertify.error("CAMPO VACIO");
                    return false;
                }else {
                    $("#inputFechaNacimientoRegister").css("border-color", "#28A745");
                    $("#divDatosGeneralesHeader").css("background-color","#28A745");

                    if($("#inputDireccionRegister").val().trim().length ==""){
                        $("#inputDireccionRegister").css("border-color", "#a94442");
                        $("#divDomicilioHeader").css("background-color", "#a94442");
                        alertify.error("CAMPO VACIO");
                        return false;
                    }else{
                        $("#inputDireccionRegister").css("border-color", "#28A745");
                        $("#divDomicilioHeader").css("background-color","#424242");

                        if($("#inputTransporteRegister").val().trim().length ==""){
                            $("#inputTransporteRegister").css("border-color", "#a94442");
                            $("#divDomicilioHeader").css("background-color", "#a94442");
                            alertify.error("CAMPO VACIO");
                            return false;

                        }else{
                            $("#inputTransporteRegister").css("border-color", "#28A745");
                            $("#divDomicilioHeader").css("background-color","#424242");

                            if($("#inputTel1Register").val().trim().length==""){
                                $("#inputTel1Register").css("border-color", "#a94442");
                                $("#divDomicilioHeader").css("background-color", "#a94442");
                                alertify.error("CAMPO VACIO");
                                return false;
                            }else{
                                $("#inputTel1Register").css("border-color", "#28A745");
                                $("#divDomicilioHeader").css("background-color","#424242");

                                if ($("#inputCivilRegister").val().trim().length ==""){
                                    $("#inputCivilRegister").css("border-color", "#a94442");
                                    $("#divDomicilioHeader").css("background-color", "#a94442");
                                    alertify.error("CAMPO VACIO");
                                    return false;
                                }else{
                                    $("#inputCivilRegister").css("border-color", "#28A745");
                                    $("#divDomicilioHeader").css("background-color","#28A745");

                                                                if($("#inputEquipoRegister").val().trim().length ==""){
                                                                    $("#inputEquipoRegister").css("border-color", "#a94442");
                                                                    $("#divExpedienteHeader").css("background-color", "#a94442");
                                                                    alertify.error("CAMPO VACIO");
                                                                    return false;
                                                                }else {
                                                                    $("#inputEquipoRegister").css("border-color", "#28A745");
                                                                    $("#divExpedienteHeader").css("background-color", "#424242");

                                                                    if($("#inputCargoRegister").val().trim().length ==""){
                                                                        $("#inputCargoRegister").css("border-color", "#a94442");
                                                                        $("#divExpedienteHeader").css("background-color", "#a94442");
                                                                        alertify.error("CAMPO VACIO");
                                                                        return false;
                                                                    }else{
                                                                        $("#inputCargoRegister").css("border-color", "#28A745");
                                                                        $("#divExpedienteHeader").css("background-color", "#28A745");

                                                                        if($("#registradoPorRegister").val().trim().length ==""){
                                                                            $("#registradoPorRegister").css("border-color", "#a94442");
                                                                            $("#divExpedienteHeader").css("background-color", "#a94442");
                                                                            alertify.error("CAMPO VACIO");
                                                                            return false;
                                                                        }else {
                                                                            $("#registradoPorRegister").css("border-color", "#28A745");
                                                                            $("#divExpedienteHeader").css("background-color", "#28A745");
                                                                        }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }// FIN GENERO
        } // FIN IDENTIDAD
    }// FIN NOMBRE

    var miJson = [{
        "nombre": nombreRegister,
        "identidad": identidadRegister,
        "genero": generoRegister,
        "fechaNacimiento": fechaNacimientoRegister,
        "tipoSangre": tipoSangreRegister,
        "direccion": direccionRegister,
        "referencia": referenciaRegister,
        "tipoCasa": tipoCasaRegister,
        "transporte": transporteRegister,
        "tel1": tel1Register,
        "tel2": tel2Register,
        "correo": correoRegister,
        "civil": civilRegister,
        "conyugue": conyugueRegister,
        "hijos": hijosRegister,
        "fechaConversion": fechaConvercionRegister,
        "fechaIglesia": fechaIglesiaRegister,
        "bautismoEspirituSanto": bautismoEspirituSantoRegister,
        "fechaRecocnciliacion": fechaReconciliacionRegister,
        "fechaBautismoAguas": fechaBautismoAguasRegister,
        "fechaCobertura": fechaCoberturaRegister,
        "promocionCorderitos": promocionCorderitosRegister,
        "areas": areasRegister,
        "promocionMayordomia":promocionMayordomiaRegister,
        "expedienteMayordomia":expedienteRegister,
        "nivelEducativo":nivelEducativoRegister,
        "profesion":profesionRegister,
        "habilidades":habilidadesRegister,
        "estadoLaboral":estadoLaboralRegister,
        "empresa":empresaRegister,
        "puesto":puestoRegister,
        "telefonoEmpresa":telefonoEmpresaRegister,
        "horario":horarioRegister,
        "carnet":carnetRegister,
        "fechaVigencia":fechaVigenciaRegister,
        "fechaGestion":fechaGestionRegister,
        "fechaEntrega":fechaEntregaRegister,
        "nombreCarnet":nombreCarnetRegister,
        "fechaInicioMayordomia":fechaInicioMayordomiaRegister,
        "equipo":equipoServicioRegister,
        "cargo":cargoRegister,
        "estado":estadoRegister,
        "observaciones":observacionesRegister
    }];
    console.log(miJson);
    var url = 'php/servidoresRegister.php';

    if(fechaIglesiaRegister.trim().length ==""){
        console.log("FECHA CONVERSION VACIA");
        fechaIglesiaRegister = "1970-01-01";
    };

if(fechaConvercionRegister.trim().length ==""){
    console.log("FECHA CONVERSION VACIA");
    fechaConvercionRegister = "1970-01-01";
};

if(fechaIglesiaRegister.trim().length ==""){
    fechaConvercionRegister = "1970-01-01";
}

    if(fechaReconciliacionRegister.trim().length ==""){
        fechaReconciliacionRegister= "1970-01-01";
    }

    if(fechaBautismoAguasRegister.trim().length ==""){
        fechaBautismoAguasRegister= "1970-01-01";
    }

    if(fechaCoberturaRegister.trim().length ==""){
        fechaCoberturaRegister= "1970-01-01";
    }

    if(fechaVigenciaRegister.trim().length ==""){
        fechaVigenciaRegister= "1970-01-01";
    }

    if(fechaGestionRegister.trim().length ==""){
        fechaGestionRegister= "1970-01-01";
    }

    if(fechaEntregaRegister.trim().length ==""){
        fechaEntregaRegister= "1970-01-01";
    }

    if(fechaInicioMayordomiaRegister.trim().length ==""){
        fechaInicioMayordomiaRegister= "1970-01-01";
    }

    if(estadoRegister.trim().length ==""){
        estadoRegister=1;
    }







    $.ajax({
        type:'POST',
        url:url,
        data: {
            phpNombre: nombreRegister,
            phpIdentidad: identidadRegister,
            phpGenero: generoRegister,
            phpFechaNacimiento: fechaNacimientoRegister,
            phpTipoSangre: tipoSangreRegister,
            phpDireccion: direccionRegister,
            phpReferencia: referenciaRegister,
            phpTipoCasa: tipoCasaRegister,
            phpTransporte: transporteRegister,
            phpTel1: tel1Register,
            phpTel2: tel2Register,
            phpCorreo: correoRegister,
            phpCivil: civilRegister,
            phpConyugue: conyugueRegister,
            phpHijos: hijosRegister,
            phpFechaConversion: fechaConvercionRegister,
            phpFechaIglesia: fechaIglesiaRegister,
            phpBautismoEspirituSanto: bautismoEspirituSantoRegister,
            phpFechaReconciliacion: fechaReconciliacionRegister,
            phpFechaBautismoAguas: fechaBautismoAguasRegister,
            phpFechaCobertura: fechaCoberturaRegister,
            phpPromocionCorderitos: promocionCorderitosRegister,
            phpAreas: areasRegister,
            phpPromocionMayordomia: promocionMayordomiaRegister,
            phpExpedienteMayordomia: expedienteRegister,
            phpNivelEducativo: nivelEducativoRegister,
            phpProfesion: profesionRegister,
            phpHabilidades: habilidadesRegister,
            phpEstadoLaboral: estadoLaboralRegister,
            phpEmpresa: empresaRegister,
            phpPuesto: puestoRegister,
            phpTelefonoEmpresa: telefonoEmpresaRegister,
            phpHorario: horarioRegister,
            phpCarnet: carnetRegister,
            phpFechaVigencia: fechaVigenciaRegister,
            phpFechaGestion: fechaGestionRegister,
            phpFechaEntrega: fechaEntregaRegister,
            phpNombreCarnet: nombreCarnetRegister,
            phpFechaInicioMayordomia: fechaInicioMayordomiaRegister,
            phpEquipo: equipoServicioRegister,
            phpCargo: cargoRegister,
            phpEstado: estadoRegister,
            phpObservaciones: observacionesRegister,
            phpRegistradoPor: registradoPorRegister,
        },
        success: function (datos) {
           //SUCCESS

            if(datos == 0){
                alertify.error("IDENTIDAD YA REGISTRADA");
                return false;
            }else{
                alertify.success("REGISTRO GUARDADO");
                cancelarRegister();
                console.log("REGISTRADO "+datos+ " FECHA INPUT:" + fechaConvercionRegister);
                return false;
            }

        }
    });
    return false;
}


