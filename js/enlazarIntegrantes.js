
$(document).ready(function(){

 /* $("form").keypress(function(e) {
        if (e.which == 13) {
            return false;
        }
    });
*/

});



//Busca los integrantes para enlazar


//BUSCAR TODOS
function verTodos() {
var uno = 1;

var url = 'php/buscarTodos.php';
$.ajax({
    type:'POST',
    url:url,
    data: {
        phpPromoCordero: uno
    },
    success: function (datos) {
        $('#resultados').html(datos);
        return false;
    }
})
    return false;
}

function enlazarIntegrante(id) {

    var equipo =document.getElementById("equipoEnlazar").value;
    var cargo =document.getElementById("cargoSelect").value;

    if (equipo.trim().length == ""){
        $('#equipoEnlazarDiv').addClass('has-error');
        $('#alertEquipo').slideDown(300);
        return false;
    }else{
        $('#equipoEnlazarDiv').removeClass('has-error');
        $('#equipoEnlazarDiv').addClass('has-success');
        $('#alertEquipo').slideUp(300);

        if(cargo.trim().length == ""){
            $('#selectDiv').addClass('has-error');
            $('#alertCargo').slideDown(300);
            return false;
        }else{
            $('#selectDiv').removeClass('has-error');
            $('#selectDiv').addClass('has-success');
            $('#alertCargo').slideUp(300);

        }

    }

    //ENLAZAR INTEGRANTES
   var url =  'php/enlazarVariosIntegrantes.php';

    $.ajax({
        type:'POST',
        url:url,
        data:{
            phpIdIntegrante: id,
            phpEquipo: equipo,
            phpCargo: cargo
        },
        success: function(datos){


            $('#resultados').html(datos);

            return false;


        }
    });
}

// VER INTEGRANTES POR EQUIPOS
function verListado() {

    var equipoListado =document.getElementById("equipoListadoSelect").value;

    if( equipoListado .trim().length == ""){
        $('#equipoListadoDiv').addClass('has-error');
        $('#alertEquipoListado').slideDown(300);
        return false;
    }else {
        $('#equipoListadoDiv').removeClass('has-error');
        $('#equipoListadoDiv').addClass('has-success');
        $('#alertEquipoListado').slideUp(300);
    }

    var url= 'php/listadoEquipos.php';

    $.ajax({
        type:'POST',
        url:url,
        data:{
            phpEquipoL: equipoListado
        },
        success: function(datos){


            $('#listadoEquipos').html(datos);

            return false;


        }
    });
}

//BUSCAR FICHAS
$('#buscarFicha').on('keyup',function(){
    var dato = $('#buscarFicha').val();
    var url = 'php/buscar_fichas.php';
    $.ajax({
        type:'POST',
        url:url,
        data:'nombrePersona='+dato,
        success: function(datos){
            $('#fichasMostrar').html(datos);
        }
    });
    return false;
});

$('#buscarFicha').on('keyup',function(){
    $('#buscarFichaNumero').val("");
});


$('#buscarFichaNumero').on('keyup',function(){
    $('#buscarFicha').val("");
});


function tagIntegracion() {
    var tag1 = $('#inputIntegracionTag').val();
    var tag = tag1.substr(1,tag1.length);
    var inicio = tag1.substr(0,1);
    var url = 'php/editarTelefonos.php';

    if(inicio.trim() == "0"){
        console.log("INICIA 0 PERMITIDO");
    }else{
        console.log("INVALIDO");
        alertify.error("TAG NO PERMITIDO");
        $('#inputIntegracionTag').val("");
        return false;
    }

    $.ajax({
        type:'POST',
        url:url,
        data:{phpTag:tag},
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



//INICIO DE LIMPIAR INPUPT CUANDO SE ESCRIBE EN EL OTRO
$('#buscarFicha').on('keyup',function(){
    var numeroFicha= $('#buscarFichaNumero').val();
    var nombreFicha =$('#buscarFicha').val();

    if(numeroFicha.trim().legth >""){
        numeroFicha.val("");
    }

    return false;
});
//FIN DE LIMPIAR INPUPT CUANDO SE ESCRIBE EN EL OTRO


//BUSCAR FICHAS
$('#buscarFichaNumero').on('keyup',function(){
    var dato = $('#buscarFichaNumero').val();
    var url = 'php/buscar_fichas_numero.php';
    $.ajax({
        type:'POST',
        url:url,
        data:'nombrePersona='+dato,
        success: function(datos){
            $('#fichasMostrar').html(datos);
        }
    });
    return false;
});


function guardarEditTel(){
    var tel1 = $('#inputTel1Edit').val();
    var tel2 = $('#inputTel2Edit').val();
    var idInt = $('#inputidIntegranteEdit').val();
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
                }else{
                    alertify.error("ERROR INTEGRANTE NO ENCONTRADO");
                    return false;
                }
        }
    });

    return false;
}


function verDetalles() {
    var idIntegrante = $('#idVerDetalles').val();
    var url ='php/tablaDetalles.php';

    if (idIntegrante.trim().length==""){
        return false;
    }else{
        //AJAX

        $.ajax({
            type:'POST',
            url:url,
            data:{phpId:idIntegrante},
            success: function(datos){
                // $('#resultados').html(datos);

                $('#tablaDetalles').html(datos).show('300').delay('2500').hide('300');

            }
        });

        return false;
    }
}

var tagLeidos  = [];
function  agregar() {
    var tag = $('#busIdInterno').val();
    var url = 'php/buscarTodos.php';

    if(tag.trim().length==""){
        alertify.error("CAMPO VACIO");
        return false;
    }// FIN VACIO

    if (tagLeidos.includes(tag)== true){
        alertify.error("TAG DUPLICADO");
        $('#busIdInterno').val("");
        return false;
    }// FIN ESTA EN ARRAY


    $.ajax({
        type:'POST',
        url:url,
        data:'nombrePersonaEnlazar='+tag,
        success: function(datos){
            var valores = eval(datos);

            if(valores[4]==0){
                alertify.error("INTEGRANTE NO DISPONIBLE");
                $('#busIdInterno').val("");
                return false;
            }else{
                tagLeidos.push(tag);
                add(valores[0],valores[1],valores[2],valores[3],valores[4]);
                $('#agregadoNombre').html(valores[2]).show(200).delay(2500).hide(300);
                $('#busIdInterno').val("");
            }

            $('#busIdInterno').val("");
        }
    });
    return false;


}




var cont = 0;

function add(item,identidad,nombre,cel) {


        cont++;

        var fila = '<tr id="'+cont+'"> <td>' + cont + ' <input type="hidden" value="'+item+'" name="itemE[]"></td> <td >' + identidad + '</td> <td>' + nombre + '</td> <td>' + cel + '</td> <td><input type="button" class="btn btn-danger btn-xs" value="Retirar" onclick="remover('+cont+','+item+')"></td> </tr>';
           $('#dataTable').append(fila);
           var visile = 'Integrantes en Listado:<span class="badge badge-danager animated bounceIn" id="new-messages">'+cont+'</span>';
    $('#contadorVisible').html(visile).show(200);
        
}

function remover(id_fila2, idIntegrante) {
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




function enlazarVarios() {
    var idIntegrante;
    var equipo = document.getElementById('equipoSelectEnlazarVarios').value;
    var url ='php/enlazarVarios.php';

    if(tagLeidos.length==0){
        alertify.error("NO HAY INTEGRANTES EN LISTA");
        return false;
    }

    $("input[name='itemE[]']").each(function () {
        idIntegrante=idIntegrante+","+$(this).val();
        //idIntegrante.push($(this).text());
    });





    if(equipo.trim().length==""){
        $('#divSelectEquiposVariosEnlazar').addClass('has-error');
        $('#alertSelectEquipoVariosEnlazar').slideDown(300);
        return false;
    }else{
        $('#divSelectEquiposVariosEnlazar').removeClass('has-error');
        $('#divSelectEquiposVariosEnlazar').addClass('has-success');
        $('#alertSelectEquipoVariosEnlazar').slideUp(300);

    }

   $.ajax({
    url:url,
        method :"POST",
        data:{idIntegrante:idIntegrante,idEquipo:equipo},
        success: function (datos) {

            $('#dataTable tbody > tr').remove();
            $('#mensajeP8').html(datos).show(200).delay(2500).hide(200);
            $('#botonImprimirEtiquetasEquipo').show(300);
            cont=0;
            var visile = 'Integrantes en Listado:<span class="badge badge-danager animated bounceIn" id="new-messages">'+cont+'</span>';
            $('#contadorVisible').html(visile).show(200);
            tagLeidos=[];
            return false;
        }
    });
}



//CARNET LIBRERIA



