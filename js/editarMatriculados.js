$(document).ready(function () {
    $("input:submit").click(function () {
        return false;
    })
});


$('#selectNinosModal').change(function ninosT(){
    var ninoRespuesta = document.getElementById("selectNinosModal").value;
    if (ninoRespuesta == 1) {
        $('#rangoNinosDivModal').show('1000');

    }else{
        $('#rangoNinosDivModal').hide('1000');
    }
});

$('#selectDocumentosModal').change(function documentos(){
    var docRespuesta = document.getElementById("selectDocumentosModal").value;
    if (docRespuesta == 1) {
        $('#DivdocumentosInputModal').show('1000');
    }else{
        $('#DivdocumentosInputModal').hide('1000');
    }
});




//Busca las integrantes matriculados
$('#inputCambiosMatricula').on('keyup',function(){
    var dato = $('#inputCambiosMatricula').val();
    var url = 'php/cambiosMatricula.php';

    $.ajax({
        type:'POST',
        url:url,
        data:'nombre='+dato,
        success: function(datos){
            $('#agrega-registros').html(datos);
        }
    });
    return false;
});
//Busca las integrantes matriculados



function editarIntegranteMatriculado(idIntegrante) {

    var url = 'php/consusltarDatosParaCambiosMatricula.php';

    $.ajax({
        type:'POST',
        url:url,
        data:'idIntegrante='+idIntegrante,
        success: function(valores){
            //$('#agrega-registros').html(datos);



            var datos = eval(valores);
            if(datos[13] == 0){
                $('#integradoRegistrarModal').val('No');
                $('#areasRegistroModal').hide(300);

            }else{
                $('#integradoRegistrarModal').val('Si');
                $('#areasRegistroModal').show(300);
                }


                if(datos[14]==1){
                $('#DivdocumentosInputModal').show(200);
                }else{
                    $('#DivdocumentosInputModal').hide(200);
                }

                if(datos[23] ==1){
                $('#rangoNinosDivModal').show(200);
                $('#inputRango1Modal').val(datos[16]);
                $('#inputRango2Modal').val(datos[17]);
                $('#inputRango3Modal').val(datos[18]);
                $('#inputRango4Modal').val(datos[19]);
                $('#inputRango5Modal').val(datos[20]);
                $('#inputRango6Modal').val(datos[21]);
                }else{
                    $('#rangoNinosDivModal').hide(200);
                    $('#inputRango1Modal').val(datos[16]);
                    $('#inputRango2Modal').val(datos[17]);
                    $('#inputRango3Modal').val(datos[18]);
                    $('#inputRango4Modal').val(datos[19]);
                    $('#inputRango5Modal').val(datos[20]);
                    $('#inputRango6Modal').val(datos[21]);
                }

            $('#identidadRegistrarModal').val(datos[1]);
            $('#corderitosPromocionRegistrarModal').val(datos[0]);
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
            $('#selectDocumentosModal').val(datos[14]);
            $('#inputDocumentosModal').val(datos[15]);
            $('#selectNinosModal').val(datos[23]);

            $('#idIntegrante').val(datos[12]);
            $('#ModalEditarMatriculado').modal({
                show:true,
                backdrop:'static'
            });//FIN ABRIR MODAL

        }
    });
    return false;
}


function pdfModal() {
    var id = $('#idIntegrante').val();
    var url ='php/fichaInscripcion.php?numero='+id;
    abrirEnPestana(url);
}

function abrirEnPestana(url) {
    var a = document.createElement("a");
    a.target = "_blank";
    a.href = url;
    a.click();
}

function actualizarDatosMatriculado() {
    var idIntegrante = $('#idIntegrante').val();
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

    var nombre =nombre1.toUpperCase();
    var ApeCasada =ApeCasada1.toUpperCase();
    var direccion =direccion1.toUpperCase();
    var areas =areas1.toUpperCase();

var respuestaDocumentos = $('#selectDocumentosModal').val();




var respuestaNinos =$('#selectNinosModal').val();
if(respuestaNinos == 2){
    var rango1 = 0;
    var rango2 = 0;
    var rango3 = 0;
    var rango4 = 0;
    var rango5 = 0;
    var otros = 0;
}else{
    var rango1 = $('#inputRango1Modal').val();
    var rango2 = $('#inputRango2Modal').val();
    var rango3 = $('#inputRango3Modal').val();
    var rango4 = $('#inputRango4Modal').val();
    var rango5 = $('#inputRango5Modal').val();
    var otros = $('#inputRango6Modal').val();


    if(rango1.trim().length==""){
     var rango1= 0;
    }

    if(rango2.trim().length==""){
        var rango2= 0;
    }

    if(rango3.trim().length==""){
       var rango3= 0;
    }

    if(rango4.trim().length==""){
       var rango4= 0;
    }

    if(rango5.trim().length==""){
       var rango5= 0;
    }

    if(otros.trim().length==""){
       var otros= 0;
    }

}



if(respuestaDocumentos ==2){
    var documentosPendientes ="";
}else{
    var documentosPendientes = $('#inputDocumentosModal').val();
}


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
            if (fechaCumpleanos.trim().length == "") {
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

                                if(respuestaDocumentos.trim().length==""){
                                    $('#divDocumentosSelectModal').addClass('has-error');
                                    $("#alertDocumentosModal").slideDown('1000');
                                    return false;
                                }else{
                                    $("#alertDocumentosModal").hide('1000');
                                    $('#divDocumentosSelectModal').removeClass('has-error');
                                    $('#divDocumentosSelectModal').addClass('has-success');

                                    if(respuestaNinos.trim().length==""){
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

    var url = 'php/editarIntegranteMatriculado.php';


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
            phpFechaCumpleanos:fechaCumpleanos,
            phpTel1:tel1,
            phpTel2:tel2,
            phpAreas: areas,
            phpDireccion: direccion,
            phpRespuestaDocumentos: respuestaDocumentos,
            phpDocumentos: documentosPendientes,
            phpRango1: rango1,
            phpRango2: rango2,
            phpRango3: rango3,
            phpRango4: rango4,
            phpRango5: rango5,
            phpOtros: otros
        },
        success: function(datos){

           if (datos == 1){
               alertify.success('DATOS ACTUALIZADOS');
                $('#inputRango1Modal').val("");
                $('#inputRango2Modal').val("");
                $('#inputRango3Modal').val("");
                $('#inputRango4Modal').val("");
                $('#inputRango5Modal').val("");
                $('#inputRango6Modal').val("");
           }else{
               alertify.success('DATOS ACTUALIZADOS');
           }
            return false;
        }
    });

    return false;
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