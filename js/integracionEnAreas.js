$(document).ready(function () {
    $("input:submit").click(function () {
        return false;
    })
});


var tagLeidos  = [];

function agregar() {
    var tag = $('#tagId').val();
    var url ='php/datosAgregarIntegracion.php';

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
function add(idIntegrante,nombreIntegrante,identidad,cel,correlativo) {
    cont ++;
    var fila = '<tr id="'+cont+'"> <td>' + cont + ' <input type="hidden" value="'+idIntegrante+'" name="itemE[]"></td> <td style="font-size: small" >' + nombreIntegrante+ '</td> <td>' + identidad+ '</td> <td>' + cel+ '</td> <td>' + correlativo+ '</td> <td><input type="button" class="btn btn-danger btn-xs" value="Retirar" onclick="remover('+cont+','+idIntegrante+')"></td> </tr>';
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
               alert(datos)
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


