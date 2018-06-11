
$(document).ready(function () {
    $("input:submit").click(function () {
        return false;
    })

    $('#nuevaPromocion').click(function () {
        $('#formularioPromocion').show('1000');
    })

    $('#limpiarNuevaPromocion').click(function () {
        $('#numeroPromocion').val("");
        $('#nombrePromocion').val("");
        $('#estadoPromocion').val("");
       // alert("BOTON PARA LIMPIAR");
    })

    $('#fechaPromEdit').datepicker({
        format: "yyyy-mm-dd"
    });


});


//Busca las promociones para hacer cambios
$('#buscarPromociones').on('keyup',function(){
    var dato = $('#buscarPromociones').val();
    var url = 'php/promociones.php';
    $.ajax({
        type:'POST',
        url:url,
        data:'numeroPromocion='+dato,
        success: function(datos){
            $('#agrega-registros').html(datos);
        }
    });
    return false;
});
//Fin Busca las promociones para hacer cambios


//Registrar Promocion
function guardarPromocion() {
    var numeroPromocion = $('#numeroPromocion').val();
    var nombrePromocion = $('#nombrePromocion').val();
    var estadoPromocion = document.getElementById("estadoPromocion").value;


//Validar Numero Promocion
    if (numeroPromocion.trim().length == "") {

        $('#numeroPromocionDiv').addClass('has-error');
        $("#alertNumeroPromocion").slideDown('1000');
        return false;
    } else {

        $("#alertNumeroPromocion").hide('1000');
        $('#numeroPromocionDiv').removeClass('has-error');
        $('#numeroPromocionDiv').addClass('has-success');

        if (nombrePromocion.trim().length ==""){
            $('#nombrePromocionDiv').addClass('has-error');
            $("#alertNombrePromocion").slideDown('1000');
            return false;
        }else {
            $("#alertNombrePromocion").hide('1000');
            $('#nombrePromocionDiv').removeClass('has-error');
            $('#nombrePromocionDiv').addClass('has-success');

            if(estadoPromocion.trim().length ==""){
                $('#estadoPromocionDiv').addClass('has-error');
                $("#alertEstadoPromocion").slideDown('1000');
                return false;
            }else{
                $("#alertEstadoPromocion").hide('1000');
                $('#estadoPromocionDiv').removeClass('has-error');
                $('#estadoPromocionDiv').addClass('has-success');
            }
        }
    }
    ;//FIN IF PRINCIPAL



    var url = 'php/guardarPromocion.php';

   $.ajax({
        type:'POST',
        url:url,
        data:{
            phpNumeroPromocion: numeroPromocion,
            phpNombrePromocion: nombrePromocion,
            phpEstadoPromocion:estadoPromocion
        },

        success: function(datos){

            $('#numeroPromocion').val("");
            $('#nombrePromocion').val("");
            $('#estadoPromocion').val("");
            $('#guardado').html(datos).show('1000').delay('2500').hide('200');
            $('#numeroPromocion').focus();

            return false;
        }
    });

    return false;

}
// Fin Registrar Promocion


function editarPromocion(id){
    $('#formularioPromoEdit')[0].reset();
    $("#Mensaje").empty();
    var url = 'php/editar_promocion.php';
    $.ajax({
        type:'POST',
        url:url,
        data:'id='+id,
        success: function(valores){
            var datos = eval(valores);

            $('#idPromEdit').val(id);
            $('#numPromoEdit').val(datos[0]);
            $('#nombrePromoEdit').val(datos[1]);
            $('#estadoPromEdit').val(datos[3]);
            $('#fechaPromEdit').val(datos[2]);

            $('#scrollingModalEdit').modal({
                show:true,
                backdrop:'static'
            });
            return false;
        }
    });

    return false;
}


function cambiosPromocion(){
    var id = $('#idPromEdit').val();
    var numero = $('#numPromoEdit').val();
    var nombre = $('#nombrePromoEdit').val();
    var estado = document.getElementById("estadoPromEdit").value;
    var fecha = $('#fechaPromEdit').val();


    if(numero.trim().length == ""){
        $('#alertNumeroEditCambios').slideDown('1000');
        $('#divNUMERO').addClass("has-error");
        return false;
    }else{
        $('#alertNumeroEditCambios').hide('1000');
        $('#divNUMERO').removeClass('has-error');
        $('#divNUMERO').addClass('has-success');
            if (nombre.trim().length ==""){
                $('#alertNombreEditCambios').slideDown('1000');
                $('#divNOMBRE').addClass("has-error");
                return false;
            }else {
                $('#alertNombreEditCambios').hide('1000');
                $('#divNOMBRE').removeClass('has-error');
                $('#divNOMBRE').addClass('has-success');
                if (estado.trim().length == ""){
                    $('#alertEstadoEditCambios').slideDown('1000');
                    $('#divESTADO').addClass("has-error");
                    return false;
                }else {
                    $('#alertEstadoEditCambios').hide('1000');
                    $('#divESTADO').removeClass('has-error');
                    $('#divESTADO').addClass('has-success');
                    if(fecha.trim().length ==""){
                        $('#alertFechaEditCambios').slideDown('1000');
                        $('#divFECHA').addClass("has-error");
                        return false;
                    }else {
                        $('#alertFechaEditCambios').hide('1000');
                        $('#divFECHA').removeClass('has-error');
                        $('#divFECHA').addClass('has-success');
                    }
                }
            }
    }


    var url = 'php/cambiosPromocion.php';

    $.ajax({
        type:'POST',
        url:url,
        data:{phpId:id,
            phpNumero:numero,
            phpNombre:nombre,
            phpEstado:estado,
            phpFecha:fecha
        },
        success: function(datos){
            $('#formularioPromoEdit')[0].reset();
            $('#numPromoEdit').focus();
            $('#Mensaje').html(datos);

            return false;
        }
    });

    return false;

}