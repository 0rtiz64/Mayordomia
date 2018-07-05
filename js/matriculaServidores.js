$(document).ready(function () {
    $("input:submit").click(function () {
        return false;
    });
});


$('#generoRegistrar').change(function focus(){
    var civil = document.getElementById("estadoCivilRegistrar").value;
    var genero = document.getElementById("generoRegistrar").value;

    if (civil == "Casado" && genero == "F") {
        $('#ApellidoCasada').toggle('1000');
    }else{
        $('#ApellidoCasada').hide('1000');
    }
});

$('#estadoCivilRegistrar').change(function focus(){
    var civil = document.getElementById("estadoCivilRegistrar").value;
    var genero = document.getElementById("generoRegistrar").value;

    if (civil == "Casado" && genero == "F") {
        $('#ApellidoCasada').toggle('1000');
    }else{
        $('#ApellidoCasada').hide('1000');
    }
});

$('#integradoRegistrar').change(function integrado(){
    var integradoRespuesta = document.getElementById("integradoRegistrar").value;
    if (integradoRespuesta == "Si") {
        $('#areasRegistro').show('1000');
    }else{
        $('#areasRegistro').hide('1000');
    }
});

$('#identidadRegistrar').on('focusout',function () {
    var identidad = $('#identidadRegistrar').val();
    var url ='php/verificarServidor.php';

    $.ajax({
        type:'POST',
        url:url,
        data:'phpIdentidad='+identidad,
        success: function(valores){
       var datos = eval(valores);


if (datos[0]==1){
    $('#ModalEditarServidoresDuplicados').modal({
        show:true,
        backdrop:'static'
    });//FIN ABRIR MODAL
    var encabezazdo = '<h4>EDITAR SERVIDOR</h4>';
    $('#claseModalColor').removeClass('success-bg');
    $('#claseModalColor').addClass('danger-bg');

    $('#btnIngresarModal').hide(200);
    $('#actualizarModal').show(200);
    $('#pdfActualizarModal').show(200);
    $('#tituloModal').html(encabezazdo);
}else {
    if(datos[0]==2){
        $('#ModalEditarServidoresDuplicados').modal({
            show:true,
            backdrop:'static'
        });//FIN ABRIR MODAL
var encabezazdo = '<h4>REGISTRAR SERVIDOR</h4>';
        $('#claseModalColor').removeClass('danger-bg');
        $('#claseModalColor').addClass('success-bg');
        $('#btnIngresarModal').show(200);
        $('#actualizarModal').hide(200);
        $('#pdfActualizarModal').hide(200);
        $('#tituloModal').html(encabezazdo);
    }else{
        return false;
    }
}



            $('#identidadRegistrarModal').val(datos[1]);
            $('#corderitosPromocionRegistrarModal').val(datos[12]);
            $('#estadoCivilRegistrarModal').val(datos[6]);
            $('#generoRegistrarModal').val(datos[7]);
            $('#tranporteRegistrarModal').val(datos[8]);
            $('#NombreRegistroModal').val(datos[2]);
            $('#ApellidoCasadaModal').val(datos[11]);
            $('#fecha_cumpleRegistroModal').val(datos[3]);
            $('#telefono1RegistrarModal').val(datos[4]);
            $('#telefono2RegistrarModal').val(datos[5]);
            $('#direccionRegistrarModal').val(datos[9]);
            $('#cargoModal').val(datos[15]);
            $('#equipoModal').val(datos[14]);
            $('#areasRegistroTextModal').val(datos[10]);

if(datos[13] == 0){
    $('#integradoRegistrarModal').val('No');
}else{
    $('#integradoRegistrarModal').val('Si');
    $('#areasRegistroModal').show(200);
    $('#areasRegistroTextModal').val(datos[10]);

}





            return false;


        }
    });


});


$('#generoRegistrarModal').change(function focus(){
    var civil = document.getElementById("estadoCivilRegistrarModal").value;
    var genero = document.getElementById("generoRegistrarModal").value;

    if (civil == "Casado" && genero == "F") {
        $('#ApellidoCasadaModal').toggle('1000');
    }else{
        $('#ApellidoCasadaModal').hide('1000');
    }
});

$('#estadoCivilRegistrarModal').change(function focus(){
    var civil = document.getElementById("estadoCivilRegistrarModal").value;
    var genero = document.getElementById("generoRegistrarModal").value;

    if (civil == "Casado" && genero == "F") {
        $('#ApellidoCasadaModal').toggle('1000');
    }else{
        $('#ApellidoCasadaModal').hide('1000');
    }
});

$('#integradoRegistrarModal').change(function integrado(){
    var integradoRespuesta = document.getElementById("integradoRegistrarModal").value;
    if (integradoRespuesta == "Si") {
        $('#areasRegistroModal').show('1000');
    }else{
        $('#areasRegistroModal').hide('1000');
    }
});




function  matricularServidor() {
    var promCorderitos = $('#corderitosPromocionRegistrar').val();
    var estadoCivil =document.getElementById("estadoCivilRegistrar").value;
    var genero = document.getElementById("generoRegistrar").value;
    var transporte = document.getElementById("tranporteRegistrar").value;
    var identidad1 = $('#identidadRegistrar').val();
    var nombre1 = $('#NombreRegistro').val();
    var ApeCasada1 = $('#ApellidoCasada').val();
    var fechaCumpleaños = $('#fecha_cumpleRegistro').val();
    var tel1= $('#telefono1Registrar').val();
    var tel2 = $('#telefono2Registrar').val();
    var integradoRes = document.getElementById("integradoRegistrar").value;

    var areas1= $('#areasRegistroText').val();
    var direccion1 = $('#direccionRegistrar').val();

var equipo = document.getElementById('equiposServidores');
var cargo =document.getElementById('cargosServidores');


    var nombre =nombre1.toUpperCase();
    var ApeCasada =ApeCasada1.toUpperCase();
    var direccion =direccion1.toUpperCase();
    var areas =areas1.toUpperCase();
    var identidad =identidad1.toUpperCase();


    var equipo= document.getElementById("equiposServidores").value;
    var cargo= document.getElementById("cargosServidores").value;


    if(identidad.trim().length==""){
        $('#divIdentidad').addClass('has-error');
        alertify.error("IDENTIDAD VACIA");
        return false;
    }else{
        $('#divIdentidad').removeClass('has-error');
        $('#divIdentidad').addClass('has-success');

        if(nombre.trim().length==""){
            $('#divNombre').addClass('has-error');
            alertify.error("NOMBRE VACIO");
            return false;
        }else{
            $('#divNombre').removeClass('has-error');
            $('#divNombre').addClass('has-success');

            if(estadoCivil.trim().length==""){
                $('#divCivil').addClass('has-error');
                alertify.error("ESTADO CIVIL VACIO");
                return false;
            }else{
                $('#divCivil').removeClass('has-error');
                $('#divCivil').addClass('has-success');

                if (genero.trim().length ==""){
                    $('#divGenero').addClass('has-error');
                    alertify.error("GENERO VACIO");
                    return false;
                }else {
                    $('#divGenero').removeClass('has-error');
                    $('#divGenero').addClass('has-success');

                    if(tel1.trim().trim().length==""){
                        $('#divTelefono1').addClass('has-error');
                        alertify.error("TELEFONO 1 VACIO");
                        return false;
                    }else{
                        $('#divTelefono1').removeClass('has-error');
                        $('#divTelefono1').addClass('has-success');
                        if (cargo.trim().length==""){
                            $('#divCargos').addClass('has-error');
                            alertify.error("CARGO VACIO");
                            return false;
                        }else{
                            $('#divCargos').removeClass('has-error');
                            $('#divCargos').addClass('has-success');

                            if(direccion.trim().length==""){
                                $('#divDireccion').addClass('has-error');
                                alertify.error("DIRECCION VACIA");
                                return false;
                            }else{
                                $('#divDireccion').removeClass('has-error');
                                $('#divDireccion').addClass('has-success');
                            }//FIN DIRECCION
                        }// FIN CARGO
                    }// FIN TELEFONO 1
                }// FIN GENERO
            }//FIN ESTADO CIVIL
        }// FIN NOMBRE
    }//FIN IDENTIDAD


    var url = 'php/guardarServidores.php';
    //AJAX INICIO

    $.ajax({
        type:'POST',
        url:url,
        data:{

            phpPromoCordero: promCorderitos,
            phpEstadoCivil: estadoCivil,
            phpGenero:genero,
            phpTransporte: transporte,
            phpIdentidad: identidad,
            phpNombre: nombre,
            phpApeCasada: ApeCasada,
            phpFechaCumpleanos:fechaCumpleaños,
            phpTel1:tel1,
            phpTel2:tel2,
            phpIntegradoRes: integradoRes,
            phpAreas: areas,
            phpDireccion: direccion,
            phpEquipo: equipo,
            phpCargo: cargo


        },
        success: function(datos){

            // $('#formularioRegistro')[0].reset();

            $('#guardado').html(datos).show('1000').delay('2500').hide('200');
            //$('#numeroExpedienteRegistrar').val(newId);

            //abrirEnPestana('php/fichaInscripcion.php?numero='+id);
            $('#btnCarnet').show();
            $('#btnLimpiar').show();
            $('#btnpdf').show();

            return false;


        }
    });
    //AJAX FIN
}

//PDF INICIO
function consultarIdParaPDFModal() {
    var identidad = $('#identidadRegistrarModal').val();
    var url = 'php/buscarUltId.php';
    $.ajax({
        type:'POST',
        url:url,
        data:{

            phpIdentidad:identidad

        },
        success: function(id){


            abrirEnPestanaPDF('php/fichaServidores.php?numero='+id);
            //$('#valorId').val().html(datos);


            return false;


        }
    });

    return false;
}

function consultarIdParaPDF() {
    var identidad = $('#identidadRegistrar').val();
    var url = 'php/buscarUltIdServidores.php';
    $.ajax({
        type:'POST',
        url:url,
        data:{

            phpIdentidad:identidad

        },
        success: function(id){


            abrirEnPestanaPDF('php/fichaServidores.php?numero='+id);
            //$('#valorId').val().html(datos);


            return false;


        }
    });

    return false;
}


function consultarIdParaPDFModal() {
    var identidad = $('#identidadRegistrarModal').val();
    var url = 'php/buscarUltIdServidores.php';
    $.ajax({
        type:'POST',
        url:url,
        data:{

            phpIdentidad:identidad

        },
        success: function(id){


            abrirEnPestanaPDF('php/fichaServidores.php?numero='+id);
            //$('#valorId').val().html(datos);


            return false;


        }
    });

    return false;
}


function abrirEnPestanaPDF(url) {
    var a = document.createElement("a");
    a.target = "_blank";
    a.href = url;
    a.click();
}
//PDF FIN



//LIMPIAR INICIO
function limpiar(){

     $('#corderitosPromocionRegistrar').val("");
    $('#estadoCivilRegistrar').val("");
    $('#generoRegistrar').val("");
    $('#tranporteRegistrar').val("");


     $('#identidadRegistrar').val("");
    $('#NombreRegistro').val("");
    $('#ApellidoCasadaModal').val("");
    $('#fecha_cumpleRegistro').val("");
     $('#telefono1Registrar').val("");
     $('#telefono2Registrar').val("");
     $('#integradoRegistrar').val("");

    $('#areasRegistroText').val("");
    $('#direccionRegistrar').val("");


    document.getElementById('equiposServidores').val("");
    document.getElementById('cargosServidores').val("");



    $('#btnpdf').hide(300);


}
//LIMPIAR FIN




function limpiarModal(){

    $('#corderitosPromocionRegistrarModal').val("");
    $('#estadoCivilRegistrarModal').val("");
    $('#generoRegistrarModal').val("");
    $('#tranporteRegistrarModal').val("");


    $('#identidadRegistrarModal').val("");
    $('#NombreRegistroModal').val("");
    $('#ApellidoCasadaModal').val("");
    $('#fecha_cumpleRegistroModal').val("");
    $('#telefono1RegistrarModal').val("");
    $('#telefono2RegistrarModal').val("");
    $('#integradoRegistrarModal').val("");

    $('#areasRegistroTextModal').val("");
    $('#direccionRegistrarModal').val("");


    document.getElementById('equipoModal').val("");
    document.getElementById('cargoModal').val("");



    $('#btnpdf').hide(300);


}
//LIMPIAR FIN

//INICIA GUARDAR MODAL

function guardarIntegranteComoServidor() {

    var promCorderitos = $('#corderitosPromocionRegistrarModal').val();
    var estadoCivil =document.getElementById("estadoCivilRegistrarModal").value;
    var genero = document.getElementById("generoRegistrarModal").value;
    var transporte = document.getElementById("tranporteRegistrarModal").value;
    var identidad = $('#identidadRegistrarModal').val();
    var nombre1 = $('#NombreRegistroModal').val();
    var ApeCasada1 = $('#ApellidoCasadaModal').val();
    var fechaCumpleanos = $('#fecha_cumpleRegistroModal').val();
    var tel1= $('#telefono1RegistrarModal').val();
    var tel2 = $('#telefono2RegistrarModal').val();
    var integradoRes = document.getElementById("integradoRegistrarModal").value;
    var areas1= $('#areasRegistroTextModal').val();
    var direccion1 = $('#direccionRegistrarModal').val();


    var equipo = document.getElementById('equipoModal').value;
    var cargo= document.getElementById('cargoModal').value;


    var nombre =nombre1.toUpperCase();
    var ApeCasada =ApeCasada1.toUpperCase();
    var direccion =direccion1.toUpperCase();
    var areas =areas1.toUpperCase();



    if(identidad.trim().length==""){
        $('#divIdentidadModal').addClass('has-error');
        $('#alertIdentidadModal').slideDown(200);
        return false;
    }else{
        $('#divIdentidadModal').removeClass('has-error');
        $('#divIdentidadModal').addClass('has-success');
        $('#alertIdentidadModal').slideUp(200);
        if(nombre.trim().length==""){
            $('#divNombreModal').addClass('has-error');
            $('#alertNombreModal').slideDown(200);
            return false;
        }else{
            $('#divNombreModal').removeClass('has-error');
            $('#divNombreModal').addClass('has-success');
            $('#alertNombreModal').slideUp(200);

            if(estadoCivil.trim().length==""){
                $('#divCivilModal').addClass('has-error');
                $('#alertEstadoModal').slideDown(200);
                return false;
            }else{
                $('#divCivilModal').removeClass('has-error');
                $('#divCivilModal').addClass('has-success');
                $('#alertEstadoModal').slideUp(200);

                if(genero.trim().length==""){
                    $('#divGeneroModal').addClass('has-error');
                    $('#alertGeneroModal').slideDown(200);
                    return false;
                }else{
                    $('#divGeneroModal').removeClass('has-error');
                    $('#divGeneroModal').addClass('has-success');
                    $('#alertGeneroModal').slideUp(200);

                    if(tel1.trim().length==""){
                        $('#divTelefono1Modal').addClass('has-error');
                        $('#alertTelefono1Modal').slideDown(200);
                        return false;
                    }else{
                        $('#divTelefono1Modal').removeClass('has-error');
                        $('#divTelefono1Modal').addClass('has-success');
                        $('#alertTelefono1Modal').slideUp(200);

                        if(cargo.trim().length==""){
                            $('#divCargoModal').addClass('has-error');
                            $('#alertCargoModal').slideDown(200);
                            return false;
                        }else{
                            $('#divCargoModal').removeClass('has-error');
                            $('#divCargoModal').addClass('has-success');
                            $('#alertCargoModal').slideUp(200);

                            if(direccion.trim().length==""){
                                $('#divDireccionModal').addClass('has-error');
                                $('#alertDireccionModal').slideDown(200);
                                return false;
                            }else{
                                $('#divDireccionModal').removeClass('has-error');
                                $('#divDireccionModal').addClass('has-success');
                                $('#alertDireccionModal').slideUp(200);
                            }//FIN DIRECCION
                        }// FIN CARGO
                    }// FIN TEL1
                }//FIN GENERO
            }// FIN ESTADO
        }// FIN NOMBRE
    }// FIN IDENTIDAD
//VALIDACION FINAL


    var url = 'php/guardarIntegranteComoServidor.php';
    //AJAX INICIO

    $.ajax({
        type:'POST',
        url:url,
        data:{


            phpPromoCordero: promCorderitos,
            phpEstadoCivil: estadoCivil,
            phpGenero:genero,
            phpTransporte: transporte,
            phpIdentidad: identidad,
            phpNombre: nombre,
            phpApeCasada: ApeCasada,
            phpFechaCumpleanos:fechaCumpleanos,
            phpTel1:tel1,
            phpTel2:tel2,
            phpIntegradoRes: integradoRes,
            phpAreas: areas,
            phpDireccion: direccion,
            phpEquipo: equipo,
            phpCargo: cargo


        },
        success: function(datos){

            // $('#formularioRegistro')[0].reset();
if(datos ==2){
    alertify.error("SERVIDOR YA MATRICULADO");
}else{
    alertify.success("REGISTRO GUARDADO");
    $('#pdfActualizarModal').show(200);
    $('#btnLimpiarModal').show(200);
}




            return false;


        }
    });
    //AJAX FIN




}
//FINALIZA GUARDAR MODAL




function actualizarDatosServidoresModal() {

    var promCorderitos = $('#corderitosPromocionRegistrarModal').val();
    var estadoCivil =document.getElementById("estadoCivilRegistrarModal").value;
    var genero = document.getElementById("generoRegistrarModal").value;
    var transporte = document.getElementById("tranporteRegistrarModal").value;
    var identidad = $('#identidadRegistrarModal').val();
    var nombre1 = $('#NombreRegistroModal').val();
    var ApeCasada1 = $('#ApellidoCasadaModal').val();
    var fechaCumpleanos = $('#fecha_cumpleRegistroModal').val();
    var tel1= $('#telefono1RegistrarModal').val();
    var tel2 = $('#telefono2RegistrarModal').val();
    var integradoRes = document.getElementById("integradoRegistrarModal").value;
    var areas1= $('#areasRegistroTextModal').val();
    var direccion1 = $('#direccionRegistrarModal').val();


    var equipo = document.getElementById('equipoModal').value;
    var cargo= document.getElementById('cargoModal').value;


    var nombre =nombre1.toUpperCase();
    var ApeCasada =ApeCasada1.toUpperCase();
    var direccion =direccion1.toUpperCase();
    var areas =areas1.toUpperCase();


//VALIDACION INICIO

    if(identidad.trim().length==""){
        $('#divIdentidadModal').addClass('has-error');
        $('#alertIdentidadModal').slideDown(200);
        return false;
    }else{
        $('#divIdentidadModal').removeClass('has-error');
        $('#divIdentidadModal').addClass('has-success');
        $('#alertIdentidadModal').slideUp(200);
            if(nombre.trim().length==""){
                $('#divNombreModal').addClass('has-error');
                $('#alertNombreModal').slideDown(200);
                return false;
            }else{
                $('#divNombreModal').removeClass('has-error');
                $('#divNombreModal').addClass('has-success');
                $('#alertNombreModal').slideUp(200);

                    if(estadoCivil.trim().length==""){
                        $('#divCivilModal').addClass('has-error');
                        $('#alertEstadoModal').slideDown(200);
                        return false;
                    }else{
                        $('#divCivilModal').removeClass('has-error');
                        $('#divCivilModal').addClass('has-success');
                        $('#alertEstadoModal').slideUp(200);

                            if(genero.trim().length==""){
                                $('#divGeneroModal').addClass('has-error');
                                $('#alertGeneroModal').slideDown(200);
                                return false;
                            }else{
                                $('#divGeneroModal').removeClass('has-error');
                                $('#divGeneroModal').addClass('has-success');
                                $('#alertGeneroModal').slideUp(200);

                                if(tel1.trim().length==""){
                                    $('#divTelefono1Modal').addClass('has-error');
                                    $('#alertTelefono1Modal').slideDown(200);
                                    return false;
                                }else{
                                    $('#divTelefono1Modal').removeClass('has-error');
                                    $('#divTelefono1Modal').addClass('has-success');
                                    $('#alertTelefono1Modal').slideUp(200);

                                     if(cargo.trim().length==""){
                                         $('#divCargoModal').addClass('has-error');
                                         $('#alertCargoModal').slideDown(200);
                                         return false;
                                     }else{
                                         $('#divCargoModal').removeClass('has-error');
                                         $('#divCargoModal').addClass('has-success');
                                         $('#alertCargoModal').slideUp(200);

                                         if(direccion.trim().length==""){
                                             $('#divDireccionModal').addClass('has-error');
                                             $('#alertDireccionModal').slideDown(200);
                                             return false;
                                         }else{
                                             $('#divDireccionModal').removeClass('has-error');
                                             $('#divDireccionModal').addClass('has-success');
                                             $('#alertDireccionModal').slideUp(200);
                                         }//FIN DIRECCION
                                     }// FIN CARGO
                                }// FIN TEL1
                            }//FIN GENERO
                    }// FIN ESTADO
            }// FIN NOMBRE
    }// FIN IDENTIDAD
//VALIDACION FINAL


    var url = 'php/editarServidorModal.php';


    $.ajax({
        type:'POST',
        url:url,
        data:{

            phpPromoCordero: promCorderitos,
            phpEstadoCivil: estadoCivil,
            phpGenero:genero,
            phpTransporte: transporte,
            phpIdentidad: identidad,
            phpNombre: nombre,
            phpApeCasada: ApeCasada,
            phpFechaCumpleanos:fechaCumpleanos,
            phpTel1:tel1,
            phpTel2:tel2,
            phpAreas: areas,
            phpDireccion: direccion,
            phpEquipo: equipo,
            phpCargo: cargo,

        },
        success: function(datos){


                alertify.success('DATOS ACTUALIZADOS');







            return false;


        }
    });

    return false;
}