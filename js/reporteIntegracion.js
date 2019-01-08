$(document).ready(function () {
    $("input:submit").click(function () {
        return false;
    });

});



//INICIO BOTONES PARA DIV

$('#btnParaNoIntegrados').click(function () {
    $('#divPorArea').hide(300);
    $('#divPorIntegrante').hide(300);
    $('#divNoIntegrados').show(300);
    var dato = 0;
var url = 'php/reporteNoIntegradosEnAreas.php';
    $.ajax({
        type:'POST',
        url:url,
        data: {
            dato: dato
        },
        success: function (datos) {

            $('#resultadosNoIntegrados').html(datos);
            return false;
        }
    });

    return false;

});

$('#btnParaAreas').click(function () {
    $('#divPorIntegrante').hide(300);
    $('#divNoIntegrados').hide(300);
    $('#divPorArea').show(300);
});



$('#btnParaIntegrantes').click(function () {
    $('#divPorArea').hide(300);
    $('#divNoIntegrados').hide(300);
    $('#divPorIntegrante').show(300);
});
//FIN BOTONES PARA DIV

$(document).on('click','.column_sort',function () {
    var column_name = $(this).attr("id");
    var order = $(this).data("order");
    var arrow = '';
    var area = $('#selectAreas').val();
    //fa fa-sort-desc ||hacia Arriba
    //fa fa-sort-asc ||hacia Abajo

    if (order =='desc'){
        arrow ='&nbsp;<span class="fa fa-sort-asc"></span>';
    }else{
        arrow ='&nbsp;<span class="fa fa-sort-desc"></span>';
    }

    $.ajax({
        url : 'php/sortReporteIntegrados.php',
        method: "POST",
        data: {column_name : column_name,order:order,idArea:area},
        success:function (data) {
            $('#resultados').html(data);
            $('#'+column_name+'').append(arrow);
        }
    })
});




$('#selectAreas').change(function () {
    var area = $('#selectAreas').val();
    var url = 'php/reporteIntegrantes.php';

    if(area.trim().length==""){
        return false;
    }
    $.ajax({
        type:'POST',
        url:url,
        data: {
            phpidArea: area
        },
        success: function (datos) {

            $('#resultados').html(datos);
            return false;
        }
    });



    /*
    $('#tablaRegistrosIntegrantes').DataTable({

        "ajax":{
            "method":"POST",
            "url":url,
            data: {
                phpidEquipo: equipo
            },
        },
        "columns":[
            {"data":"nombre_integrante"},
            {"data":"num_identidad"},
            {"data":"correlativo"}
        ]

    });
    */

//$('#tablaRegistrosIntegrantes').DataTable();
    return false;
});


//INICIO BUSCAR POR AREAS
$('#inputBuscarNombre').on('keyup',function () {
$('#inputBuscarPorFicha').val("");
    var nombre = $('#inputBuscarNombre').val();
    var url = 'php/buscarPorNombre.php';

    $.ajax({
        type:'POST',
        url:url,
        data:{

            nombre:nombre

        },
        success: function(datos){
            $('#resultadosBusqueda').html(datos);
            return false;
        }
    });


});



$('#inputBuscarPorFicha').on('keyup',function () {
    $('#inputBuscarNombre').val("");
    var nombre = $('#inputBuscarPorFicha').val();
    var url = 'php/buscarPorFicha.php';

    $.ajax({
        type:'POST',
        url:url,
        data:{

            nombre:nombre

        },
        success: function(datos){
            $('#resultadosBusqueda').html(datos);
            return false;
        }
    });


});

//FIN BUSCAR POR AREAS



//INICIO VER AREAS DE INTEGRANTE
function verAreasIntegrante(idIntegrante) {
var url = 'php/tablaAreasPorIntegrante.php';

    $.ajax({
        type:'POST',
        url:url,
        data:{

            idIntegrante:idIntegrante

        },
        success: function(datos){
            $('#resultadosParaTabla').html(datos);
            return false;
        }
    });

}
//FIN VER AREAS DE INTEGRANTE


//INICIO RETIRAR AREA DE INTEGRANTE
function retirarArea(idArea,idIntegrante) {
 var url = 'php/retirarAreaDeIntegrante.php';

    $.ajax({
        type:'POST',
        url:url,
        data:{

            idIntegrante:idIntegrante,
            idArea:idArea

        },
        success: function(datos){
            alertify.success("AREA RETIRADA");
            $('#resultadosParaTabla').html(datos);
            return false;
        }
    });

}

//FIN RETIRAR AREA DE INTEGRANTE

