$(document).ready(function () {
    $("input:submit").click(function () {
        return false;
    })
});


var tagLeidos  = [];

function agregar() {
    var tag1 = $('#tagId').val();
    var tag = tag1.substr(1,tag1.length);
    var inicio = tag1.substr(0,1);
    var url ='php/datosAgregarIntegracion.php';


    if(inicio.trim() == "0"){
        console.log("INICIA 0 PERMITIDO");
    }else{
        console.log("INVALIDO");
        alertify.error("TAG NO PERMITIDO");
        return false;
    }

    if (tag.trim().length==""){
        alertify.error("CAMPO VACIO");
        return false;
    }else{

    }

    if (tagLeidos.includes(tag)== true){
        alertify.error("TAG DUPLICADO");
        $('#tagId').val("");
        return false;
    }

    tagLeidos.push(tag);

    $.ajax({
        type:'POST',
        url:url,
        data:{phpId:tag},
        success: function(datos){
            var valores = eval(datos);

            if(valores[0] ==0){
                alertify.error("INTEGRANTE NO ENCONTRADO");
            }else{
                add(valores[0],valores[1],valores[2],valores[3],valores[4]);
                $('#agregadoNombre').html(valores[5]).show(200).delay(2500).hide(300);
            }


            $('#tagId').val("");
        }
    });
    return false;
}

var cont = 0;
function add(idIntegrante,nombreIntegrante,tel,cel,correlativo) {
    cont ++;
    var fila = '<tr id="'+cont+'" ondblclick="editTel('+idIntegrante+','+cont+')"> <td>' + cont + ' <input type="hidden" value="'+idIntegrante+'" name="itemE[]"></td> <td>' + nombreIntegrante+ '</td> <td>' + cel+ '</td> <td id="E'+cont+'">' + tel+ '</td> <td>' + correlativo+ '</td> <td><input type="button" class="btn btn-danger btn-xs" value="Retirar" onclick="remover('+cont+','+idIntegrante+')"></td> </tr>';
    $('#tablaAgregados').append(fila);
    var visile = 'Integrantes en Listado:<span class="badge badge-danager animated bounceIn" id="new-messages">'+cont+'</span>';
    $('#contadorVisible').html(visile).show(200);
    $('#mensajeRespuesta').hide(200);
}

function remover(id_fila2,idIntegrante) {
    $('#'+id_fila2).remove();
    cont= cont-1;

    var visile = 'Integrantes en Listado:<span class="badge badge-danager animated bounceIn" id="new-messages">'+cont+'</span>';
    $('#contadorVisible').html(visile).show(200);

    var url = 'php/buscarId.php';

    $.ajax({
        type:'POST',
        url:url,
        data:{phpId:idIntegrante},
        success: function(datos){


            var  indice = tagLeidos.indexOf(datos);

            if (indice == -1){
                alertify.error("Se produjo un error, notificar al desarrollador");
            }else{
                tagLeidos.splice(indice,1);

            }

        }
    });








}

function integrarIntegrantes() {
    var idIntegrante;
    var area = document.getElementById('selectAreasServicio').value;
    var integrador = document.getElementById('PastOption').value;
    var url ='php/integrarIntegrantes.php';



    $("input[name='itemE[]']").each(function () {
        idIntegrante=idIntegrante+","+$(this).val();
        //idIntegrante.push($(this).text());
    });

    if (integrador.trim().length==""){
        alertify.error("MEDIO VACIO");
        $('#medioDiv').addClass('has-error');
        return false;
    }else{
        if (area.trim().length==""){
            alertify.error("AREA VACIA");
            return false;
        }else{

        }//FIN VALIDACION AREA
    }//FIN VALIDACION MEDIO



    $.ajax({
        url:url,
        method :"POST",
        data:{idIntegrante:idIntegrante,idEquipo:area,integrador:integrador},
        success: function (datos) {

            $('#tablaAgregados tbody > tr').remove();

            $('#mensajeRespuesta').html(datos).show(200);


            cont=0;
            var visile = 'Integrantes en Listado:<span class="badge badge-danager animated bounceIn" id="new-messages">'+cont+'</span>';
            $('#contadorVisible').html(visile).show(200);
            tagLeidos.splice(0,tagLeidos.length);

            $('#PastOption').val("");
            $('#selectAreasServicio').val("");


            return false;


        }
    });

}


function integrarIndividualModal() {
    $('#modalIntegrarIndividual').modal({
        show:true,
        backdrop:'static'
    });
    return false;
}
//FIN ABRIR MODAL

function integrarIndividual(){
    var area = document.getElementById('selectAreasIntegracionIndividual').value;
    var nombre = $('#nombreIntegracionIndividual').val().toUpperCase();
    var identidad = $('#identidadIntegracionIndividual').val();
    var telefono1= $('#telefono1IntegracionIndividual').val();
    var telefono2 = $('#telefono2IntegracionIndividual').val();
    var sirve = $('#sirveIntegracionIndividual').val().toUpperCase();
    var url = 'php/integracionIndividual.php';


    if(nombre.trim().length ==""){
        alertify.error("CAMPO NOMBRE VACIO");
        return false;
    }else{
        if(identidad.trim().length == ""){
            alertify.error("CAMPO IDENTIDAD VACIO");
            return false;
        }else{
            if(telefono1.trim().length ==""){
                alertify.error("CAMPO TELEFONO 1 VACIO");
                return false;
            }else{
                if(area.trim().length ==""){
                    alertify.error("DEBES SELECCIONAR UN AREA");
                    return false;
                }
            }
        }
    }



    $.ajax({
        type:'POST',
        url:url,
        data:{
            phpArea:area,
            phpNombre:nombre,
            phpIdentidad:identidad,
            phpTelefono1:telefono1,
            phpTelefono2:telefono2,
            phpSirve:sirve
        },
        success: function(datos){

            if(datos == 1){
                alertify.error("IDENTIDAD YA REGISTRADA EN ESTA AREA");
                return false;
            }else{
                alertify.success("REGISTRO GUARDADO");
                document.getElementById('selectAreasIntegracionIndividual').value ='';
                $('#nombreIntegracionIndividual').val('');
                $('#identidadIntegracionIndividual').val('');
                $('#telefono1IntegracionIndividual').val('');
                $('#telefono2IntegracionIndividual').val('');
                $('#sirveIntegracionIndividual').val('');
            }

        }
    });

}

//INICIO CERRAR MODAL
$('#modalIntegrarIndividual').on('hidden.bs.modal', function () {
    $('#nombreIntegracionIndividual').val('');
    $('#identidadIntegracionIndividual').val('');
    $('#telefono1IntegracionIndividual').val('');
    $('#telefono2IntegracionIndividual').val('');
    $('#sirveIntegracionIndividual').val('');
    return false;
});

function editTel(idInt, idTel) {
    var idTelNew ="E"+idTel;
    $('#inputIdTel').val(idTelNew);
    var url = 'php/editarTelefonos.php';
    $.ajax({
        type:'POST',
        url:url,
        data:{phpTag:idInt},
        success: function(datos){
            var data = eval(datos);

            if(data[3]== 0){
                alertify.error("INTEGRANTE NO ENCONTRADO EN ESTA PROMOCION");
                $('#inputIntegracionTag').val("");
                return false;
            }else{
                var nombre = data[0];
                var tel1 = data[1];
                var tel2 = data[2];
                var idInt = data[3];

                $('#labelModal').html(nombre);
                $('#inputTel1Edit').val(tel1);
                $('#inputTel2Edit').val(tel2);
                $('#inputidIntegranteEdit').val(idInt);
                $('#inputIntegracionTag').val("");
                $('#editTelModal').modal({
                    show:true,
                    backdrop:'static'
                });
            }
        }
    });

    return false;
}


function guardarEditTel(){
    var tel1 = $('#inputTel1Edit').val();
    var tel2 = $('#inputTel2Edit').val();
    var idInt = $('#inputidIntegranteEdit').val();
    var idTd = $('#inputIdTel').val()
    var url = 'php/editTelefonoIntegracion.php';

    if(tel1.trim().length==""){
        alertify.error(" TELEFONO 1 CAMPO VACIO");
        return false;
    }
    $.ajax({
        type:'POST',
        url:url,
        data:{
            phpId:idInt,
            phpTel1:tel1,
            phpTel2:tel2
        },
        success: function(datos){
            if(datos == 1){
                alertify.success("REGISTRO EDITADO CON EXITO");
                $('#inputTel1Edit').val("");
                $('#inputTel2Edit').val("");
                $('#inputidIntegranteEdit').val("");
                $('#editTelModal').modal('toggle');
                $('#'+idTd).html(tel1);
            }else{
                alertify.error("ERROR INTEGRANTE NO ENCONTRADO");
                return false;
            }
        }
    });

    return false;
}