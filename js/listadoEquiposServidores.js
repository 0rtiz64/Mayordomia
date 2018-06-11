
$(document).ready(function () {
    $("input:submit").click(function () {
        return false;
    });

});

$(document).on('click','.column_sort',function () {
    var column_name = $(this).attr("id");
    var order = $(this).data("order");
    var arrow = '';
    var idEquipo = $('#idSelectEquipo').val();
    //fa fa-sort-desc ||hacia Arriba
    //fa fa-sort-asc ||hacia Abajo

    if (order =='desc'){
        arrow ='&nbsp;<span class="fa fa-sort-asc"></span>';
    }else{
        arrow ='&nbsp;<span class="fa fa-sort-desc"></span>';
    }

    $.ajax({
        url : 'php/sortListadoServidores.php',
        method: "POST",
        data: {column_name : column_name,order:order,idEquipo:idEquipo},
        success:function (data) {
            $('#tablaEquipos').html(data);
            $('#'+column_name+'').append(arrow);
        }
    })
});




$('#idSelectEquipo').change(function () {
 var idEquipo = $('#idSelectEquipo').val();

    var url = 'php/listadoEquiposServidores.php';

    if (idEquipo.trim().length==""){
        return false;
    }
    $.ajax({
        type:'POST',
        url:url,
        data: {
            phpidEquipo: idEquipo
        },
        success: function (datos) {

            $('#tablaEquipos').html(datos);
            return false;
        }
    });

});