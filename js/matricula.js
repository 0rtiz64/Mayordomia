
$(document).ready(function () {
    $("input:submit").click(function () {
        return false;
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


    $('#selectNinos').change(function ninosT(){
        var ninoRespuesta = document.getElementById("selectNinos").value;
        if (ninoRespuesta == 1) {
            $('#rangoNinosDiv').show('1000');

        }else{
            $('#rangoNinosDiv').hide('1000');
        }
    });

    $('#selectDocumentos').change(function documentos(){
        var docRespuesta = document.getElementById("selectDocumentos").value;
        if (docRespuesta == 1) {
            $('#DivdocumentosInput').show('1000');

        }else{
            $('#DivdocumentosInput').hide('1000');
        }
    });





    $('#preguntaNinosModal').change(function ninosModal(){
        var ninoRespuesta = document.getElementById("preguntaNinosModal").value;
        if (ninoRespuesta == 1) {
            $('#rangoNinosDivModal').show('1000');

        }else{
            $('#rangoNinosDivModal').hide('1000');
        }
    });

    $('#preguntaDocumentosModal').change(function documentosModal(){
        var docRespuesta = document.getElementById("preguntaDocumentosModal").value;
        if (docRespuesta == 1) {
            $('#DivdocumentosInputModal').show('1000');

        }else{
            $('#DivdocumentosInputModal').hide('1000');
        }
    });

});


//Registrar Persona
function guardarPersona(){
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

    var respuestaDocumentos = document.getElementById('selectDocumentos').value;
    var inputDocumentos1 = $('#inputDocumentos').val();

    var respuestaNinos = document.getElementById('selectNinos').value;
    var rango1= $('#inputRango1').val();
    var rango2= $('#inputRango2').val();
    var rango3= $('#inputRango3').val();
    var rango4= $('#inputRango4').val();
    var rango5= $('#inputRango5').val();
    var rango6= $('#inputRango6').val();


    var id = $('#numeroExpedienteRegistrar').val();
    var idNum = parseInt(id);
    var newId = idNum+1;


var nombre =nombre1.toUpperCase();
var ApeCasada =ApeCasada1.toUpperCase();
var direccion =direccion1.toUpperCase();
var inputDocumentos =inputDocumentos1.toUpperCase();
var areas =areas1.toUpperCase();
var identidad =identidad1.toUpperCase();
var correlativoVisible = $('#correlativo').val();

//INICIA VALIDACION
    if (identidad.trim().length == "") {
        $('#divIdentidad').addClass('has-error');
        $("#alertIdentidad").slideDown('1000');
        return false;
    }else {
        $("#alertIdentidad").hide('1000');
        $('#divIdentidad').removeClass('has-error');
        $('#divIdentidad').addClass('has-success');

        if (nombre.trim().length == "") {
            $('#divNombre').addClass('has-error');
            $("#alertNombre").slideDown('1000');
            return false;
        }else {
            $("#alertNombre").hide('1000');
            $('#divNombre').removeClass('has-error');
            $('#divNombre').addClass('has-success');
            if (fechaCumpleaños.trim().length == "") {
                $('#divFecha').addClass('has-error');
                $("#alertFecha").slideDown('1000');
                return false;
            }else {
                $("#alertFecha").hide('1000');
                $('#divFecha').removeClass('has-error');
                $('#divFecha').addClass('has-success');

                if(estadoCivil.trim().length == ""){
                    $('#divCivil').addClass('has-error');
                    $("#alertEstado").slideDown('1000');
                    return false;
                }else {
                    $("#alertEstado").hide('1000');
                    $('#divCivil').removeClass('has-error');
                    $('#divCivil').addClass('has-success');

                    if (genero.trim().length == "") {
                        $('#divGenero').addClass('has-error');
                        $("#alertGenero").slideDown('1000');
                        return false;
                    }else {
                        $("#alertGenero").hide('1000');
                        $('#divGenero').removeClass('has-error');
                        $('#divGenero').addClass('has-success');

                        if (transporte.trim().length == "") {
                            $('#divTransporte').addClass('has-error');
                            $("#alertTransporte").slideDown('1000');
                            return false;
                        }else {
                            $("#alertTransporte").hide('1000');
                            $('#divTransporte').removeClass('has-error');
                            $('#divTransporte').addClass('has-success');

                            if(promCorderitos.trim().length == ""){

                                $('#divCorderito').addClass('has-error');
                                $("#alertPromocion").slideDown('1000');
                                return false;
                            }else {

                                $("#alertPromocion").hide('1000');
                                $('#divCorderito').removeClass('has-error');
                                $('#divCorderito').addClass('has-success');

                               if(respuestaDocumentos.trim().length==""){
                                   $('#divDocumentosSelect').addClass('has-error');
                                   $("#alertDocumentos").slideDown('1000');
                                   return false;
                               }else{
                                   $("#alertDocumentos").hide('1000');
                                   $('#divDocumentosSelect').removeClass('has-error');
                                   $('#divDocumentosSelect').addClass('has-success');

                                   if(respuestaNinos.trim().length==""){
                                       $('#divNinosPregunta').addClass('has-error');
                                       $("#alertNinos").slideDown('1000');
                                       return false;
                                   }else{
                                       $("#alertNinos").hide('1000');
                                       $('#divNinosPregunta').removeClass('has-error');
                                       $('#divNinosPregunta').addClass('has-success');

                                       if (tel1.trim().length == "") {
                                           $('#divTelefono1').addClass('has-error');
                                           $("#alertTelefono1").slideDown('1000');
                                           return false;
                                       }else{
                                           $("#alertTelefono1").hide('1000');
                                           $('#divTelefono1').removeClass('has-error');
                                           $('#divTelefono1').addClass('has-success');

                                           if (integradoRes.trim().length == "") {
                                               $('#divIntegrado').addClass('has-error');
                                               $("#alertIntegrado").slideDown('1000');
                                               return false;
                                           }else {
                                               $("#alertIntegrado").hide('1000');
                                               $('#divIntegrado').removeClass('has-error');
                                               $('#divIntegrado').addClass('has-success');

                                               if (direccion.trim().length == "") {
                                                   $('#divDireccion').addClass('has-error');
                                                   $("#alertDireccion").slideDown('1000');
                                                   return false;
                                               }else{
                                                   $("#alertDireccion").hide('1000');
                                                   $('#divDireccion').removeClass('has-error');
                                                   $('#divDireccion').addClass('has-success');
                                               }//FIN DIRECCION
                                           }//FIN INTEGRADO
                                       }//FIN TEL 1
                                   }//FIN NINOS
                               }// FIN DOCUMENTOS
                            }//FIN CORDERITOS
                        }//FIN TRANSPORTE
                    }// FIN GENERO
                }// FIN CIVIL
            }// FIN CUMPLEANOS
        }//FIN NOMBRE
    }// FIN IDENTIDAD
//FIN VALIDACION






    var url = 'php/guardarIntegrante.php';

    $.ajax({
        type:'POST',
        url:url,
        data:{
         phpCorr:correlativoVisible,
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
            phpId:id,
            phpnewId:newId,
            phpRango1 :rango1,
            phpRango2 :rango2,
            phpRango3 :rango3,
            phpRango4 :rango4,
            phpRango5 :rango5,
            phpRango6 :rango6,
            phpDocumentos :inputDocumentos,
            phpRespuestaDocumentos :respuestaDocumentos

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

    return false;
}
// Fin Registrar Persona




function consultarId() {
    var identidad = $('#identidadRegistrar').val();
    var url = 'php/buscarUltId.php';
    $.ajax({
        type:'POST',
        url:url,
        data:{

            phpIdentidad:identidad

        },
        success: function(id){


            abrirEnPestana('php/fichaInscripcion.php?numero='+id);
            //$('#valorId').val().html(datos);


            return false;


        }
    });

    return false;
}


function abrirEnPestana(url) {
    var a = document.createElement("a");
    a.target = "_blank";
    a.href = url;
    a.click();
}



function limpiarCarnt(){
    $('#formularioRegistro')[0].reset();
    $('#btnCarnet').hide(300);
    $('#btnpdf').hide(300);
}


$('#identidadRegistrar').on('focusout',function(){
    var identidad = $('#identidadRegistrar').val();
    var url = 'php/verificarIntegrante.php';


    $.ajax({
        type:'POST',
        url:url,
        data:{

            phpIdentidad:identidad

        },
        success: function(valores){
            var datos = eval(valores);

            if(datos[15]=="Si"){
                $('#areasRegistroModal').show(300);
            }else{
                $('#areasRegistroModal').hide(300);
            }


            if(datos[16]==1){
                $('#DivdocumentosInputModal').show(300);
            }else{
                $('#DivdocumentosInputModal').hide(300);
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
               $('#areasRegistroTextModal').val(datos[10]);
               $('#direccionRegistrarModal').val(datos[9]);
               $('#nombrePromocion').html(datos[13]);
               $('#idIntegrante').val(datos[14]);
               $('#integradoRegistrarModal').val(datos[15]);
               $('#preguntaDocumentosModal').val(datos[16]);
               $('#inputDocumentosModal').val(datos[17]);



                if(datos[0]== 1){
                    $('#ModalRegistrar').modal({
                        show:true,
                        backdrop:'static'
                    });//FIN ABRIR MODAL
                    $('#pdfModal').empty();
                    $('#carnetModal').empty();
                }else {
                    return false;
                }
             //FIN DEL IF
            return false;
        }//FIN SUCCESS
    });// FIN AJAX
    return false;
});//FIN EVENTO FOCUS OUT

//INICIO CERRAR MODAL
$('#ModalRegistrar').on('hidden.bs.modal', function () {
    $('#pdfModal').hide(300);
    $('#carnetModal').hide(300);

});



//FIN CERRAR MODAL



function pdfModal() {
    var id = $('#idIntegrante').val();
    var url ='php/fichaInscripcion.php?numero='+id;
    abrirEnPestana(url);
}





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


//Registrar Persona
function actualizarDatos(){
    var idIntegrante = $('#idIntegrante').val();
    var promCorderitos = $('#corderitosPromocionRegistrarModal').val();
    var estadoCivil =document.getElementById("estadoCivilRegistrarModal").value;
    var genero = document.getElementById("generoRegistrarModal").value;
    var transporte = document.getElementById("tranporteRegistrarModal").value;
    var identidad1 = $('#identidadRegistrarModal').val();
    var nombre1 = $('#NombreRegistroModal').val();
    var ApeCasada1 = $('#ApellidoCasadaModal').val();
    var fechaCumpleaños = $('#fecha_cumpleRegistroModal').val();
    var tel1= $('#telefono1RegistrarModal').val();
    var tel2 = $('#telefono2RegistrarModal').val();
    var integradoRes = document.getElementById("integradoRegistrarModal").value;
    var areas1= $('#areasRegistroTextModal').val();
    var direccion1 = $('#direccionRegistrarModal').val();

    var respuestaDocumentosModal = document.getElementById('preguntaDocumentosModal').value;
    var inputDocumentos1Modal = $('#inputDocumentosModal').val();

    var respuestaNinosModal = document.getElementById('preguntaNinosModal').value;
    var rango1Modal= $('#inputRango1Modal').val();
    var rango2Modal= $('#inputRango2Modal').val();
    var rango3Modal= $('#inputRango3Modal').val();
    var rango4Modal= $('#inputRango4Modal').val();
    var rango5Modal= $('#inputRango5Modal').val();
    var rango6Modal= $('#inputRango6Modal').val();

    var nombre =nombre1.toUpperCase();
    var ApeCasada =ApeCasada1.toUpperCase();
    var direccion =direccion1.toUpperCase();
    var areas =areas1.toUpperCase();
    var identidad =identidad1.toUpperCase();
    var inputDocumentosModal =inputDocumentos1Modal.toUpperCase();


//INICIO VALIDACION
    if (identidad.trim().length == "") {
        $('#divIdentidadModal').addClass('has-error');
        $("#alertIdentidadModal").slideDown('1000');
        return false;
    }else {
        $("#alertIdentidadModal").hide('1000');
        $('#divIdentidadModal').removeClass('has-error');
        $('#divIdentidadModal').addClass('has-success');

        if (nombre.trim().length == "") {
            $('#divNombreModal').addClass('has-error');
            $("#alertNombreModal").slideDown('1000');
            return false;
        }else {
            $("#alertNombreModal").hide('1000');
            $('#divNombreModal').removeClass('has-error');
            $('#divNombreModal').addClass('has-success');
            if (fechaCumpleaños.trim().length == "") {
                $('#divFechaModal').addClass('has-error');
                $("#alertFechaModal").slideDown('1000');
                return false;
            }else {
                $("#alertFechaModal").hide('1000');
                $('#divFechaModal').removeClass('has-error');
                $('#divFechaModal').addClass('has-success');

                if(estadoCivil.trim().length == ""){
                    $('#divCivilModal').addClass('has-error');
                    $("#alertEstadoModal").slideDown('1000');
                    return false;
                }else {
                    $("#alertEstadoModal").hide('1000');
                    $('#divCivilModal').removeClass('has-error');
                    $('#divCivilModal').addClass('has-success');

                    if (genero.trim().length == "") {
                        $('#divGeneroModal').addClass('has-error');
                        $("#alertGeneroModal").slideDown('1000');
                        return false;
                    }else {
                        $("#alertGeneroModal").hide('1000');
                        $('#divGeneroModal').removeClass('has-error');
                        $('#divGeneroModal').addClass('has-success');

                        if (transporte.trim().length == "") {
                            $('#divTransporteModal').addClass('has-error');
                            $("#alertTransporteModal").slideDown('1000');
                            return false;
                        }else {
                            $("#alertTransporteModal").hide('1000');
                            $('#divTransporteModal').removeClass('has-error');
                            $('#divTransporteModal').addClass('has-success');

                            if(promCorderitos.trim().length == ""){

                                $('#divCorderitoModal').addClass('has-error');
                                $("#alertPromocionModal").slideDown('1000');
                                return false;
                            }else {

                                $("#alertPromocionModal").hide('1000');
                                $('#divCorderitoModal').removeClass('has-error');
                                $('#divCorderitoModal').addClass('has-success');

                                    if(respuestaDocumentosModal.trim().length==""){
                                        $('#divdocumentosPreguntaModal').addClass('has-error');
                                        $("#alertPreguntaDocumentosModal").slideDown('1000');
                                        return false;
                                    }else{
                                        $("#alertPreguntaDocumentosModal").hide('1000');
                                        $('#divdocumentosPreguntaModal').removeClass('has-error');
                                        $('#divdocumentosPreguntaModal').addClass('has-success');

                                        if(respuestaNinosModal.trim().length==""){
                                            $('#divPreguntaNinosModal').addClass('has-error');
                                            $("#alertNinosModal").slideDown('1000');
                                            return false;
                                        }else{
                                            $("#alertNinosModal").hide('1000');
                                            $('#divPreguntaNinosModal').removeClass('has-error');
                                            $('#divPreguntaNinosModal').addClass('has-success');

                                            if (tel1.trim().length == "") {
                                                $('#divTelefono1Modal').addClass('has-error');
                                                $("#alertTelefono1Modal").slideDown('1000');
                                                return false;
                                            }else {
                                                $("#alertTelefono1Modal").hide('1000');
                                                $('#divTelefono1Modal').removeClass('has-error');
                                                $('#divTelefono1Modal').addClass('has-success');

                                                if (integradoRes.trim().length == "") {
                                                    $('#divIntegradoModal').addClass('has-error');
                                                    $("#alertIntegradoModal").slideDown('1000');
                                                    return false;
                                                }else{
                                                    $("#alertIntegradoModal").hide('1000');
                                                    $('#divIntegradoModal').removeClass('has-error');
                                                    $('#divIntegradoModal').addClass('has-success');

                                                    if (direccion.trim().length == "") {
                                                        $('#divDireccionModal').addClass('has-error');
                                                        $("#alertDireccionModal").slideDown('1000');
                                                        return false;
                                                    }else{
                                                        $("#alertDireccionModal").hide('1000');
                                                        $('#divDireccionModal').removeClass('has-error');
                                                        $('#divDireccionModal').addClass('has-success');
                                                    }//Fin Direccion
                                                }//FIN INTEGRADO
                                            }//FIN TELEFONO 1
                                        }//FIN NINOS
                                    }// FIN DOCUMENTOS
                                }// FIN PROMOOCION CORDERITOS
                            }//FIN TRANSPORTE
                    }//FIN GENERO
                }//ESTADO CIVIL
            }// FECHA NACIMIENTO
        }// FIN NOMBRE
    }//FIN IDENTIDAD

   //FIN VALIDACION


    var url = 'php/editarIntegrante.php';

    $.ajax({
        type:'POST',
        url:url,
        data:{
            phpIdIntegrante: idIntegrante,
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
            phpRango1 :rango1Modal,
            phpRango2 :rango2Modal,
            phpRango3 :rango3Modal,
            phpRango4 :rango4Modal,
            phpRango5 :rango5Modal,
            phpRango6 :rango6Modal,
            phpDocumentos :inputDocumentosModal,
            phpRespuestaDocumentos :respuestaDocumentosModal
        },
        success: function(datos){
            $('#preguntaNinosModal').val("");
            $('#inputRango1Modal').val("");
            $('#inputRango2Modal').val("");
            $('#inputRango3Modal').val("");
            $('#inputRango4Modal').val("");
            $('#inputRango5Modal').val("");
            $('#inputRango6Modal').val("");

            $('#nombrePromocion').html(datos).show('1000');
            $('#carnetModal').show(300);
            $('#pdfModal').show(300);



            return false;


        }
    });

    return false;
}
// Fin Registrar Persona
