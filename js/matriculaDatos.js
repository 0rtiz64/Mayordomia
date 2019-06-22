$(document).ready(function () {
    return false;
});

$("#fechaDatos").on('change',function () {
 var fecha = $("#fechaDatos").val();
 var url = 'php/matriculaDatos.php';
    $.ajax({
        type:'POST',
        url:url,
        data:{
            phpFecha:fecha

        },
        success: function(datos){
            //SUCCESS
            $("#resultados").html(datos);
            return false;


        }
    });
    return false;
});