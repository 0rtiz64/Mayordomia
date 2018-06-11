
$(document).ready(function () {
    $("input:submit").click(function () {
        return false;
    })

});

$('#inputBuscarServidores').on('keyup',function () {
var nombre =  $('#inputBuscarServidores').val();
var url = 'php/buscarServidores.php';

    $.ajax({
        type:'POST',
        url:url,
        data:'nombre='+nombre,
        success: function(datos){
            $('#tablaResultados').html(datos);
        }
    });
    return false;
});

function editarServidor(idIntegrante) {

    var url = 'php/consusltarDatosParaCambiosServidores.php';

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

            $('#equipoModal').val(datos[14]);
            $('#cargoModal').val(datos[15]);
            $('#selectEstadoModal').val(datos[16]);

            $('#idServidorEditar').val(datos[12]);
            $('#ModalEditarServidores').modal({
                show:true,
                backdrop:'static'
            });//FIN ABRIR MODAL

        }
    });
    return false;
}


//PDF INICIO
function consultarIdParaPDF() {
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


function abrirEnPestanaPDF(url) {
    var a = document.createElement("a");
    a.target = "_blank";
    a.href = url;
    a.click();
}
//PDF FIN



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




function actualizarDatosServidores() {
    var idIntegrante = $('#idServidorEditar').val();
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
    var estado= document.getElementById('selectEstadoModal').value;


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

                           if(estado.trim().length==""){
                               $('#divEstado').addClass('has-error');
                               $('#alertEstadoACModal').slideDown(200);
                               return false;
                           }else {
                               $('#divEstado').removeClass('has-error');
                               $('#divEstado').addClass('has-success');
                               $('#alertEstadoACModal').slideUp(200);
                               if(direccion.trim().length==""){
                                   $('#divDireccionModal').addClass('has-error');
                                   $('#alertDireccionModal').slideDown(200);
                                   return false;
                               }else{
                                   $('#divDireccionModal').removeClass('has-error');
                                   $('#divDireccionModal').addClass('has-success');
                                   $('#alertDireccionModal').slideUp(200);
                               }//FIN DIRECCION
                           }// FIN ESTADO
                        }// FIN CARGO
                    }// FIN TEL1
                }//FIN GENERO
            }// FIN ESTADO
        }// FIN NOMBRE
    }// FIN IDENTIDAD
//VALIDACION FINAL



    var url = 'php/editarServidor.php';


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
            phpEquipo: equipo,
            phpCargo: cargo,
            phpEstado: estado
        },
        success: function(datos){

                alertify.success('DATOS ACTUALIZADOS');







            return false;


        }
    });

    return false;
}

