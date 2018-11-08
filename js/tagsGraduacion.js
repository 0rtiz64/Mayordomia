$(document).ready(function () {
    $("input:submit").click(function () {
        return false;
    });

});

$('#equiposGraduacion').on('change',function () {
    var idEquipo =document.getElementById('equiposGraduacion').value;
    var url = 'php/integrantesTagsGraduacion.php';

    $.ajax({
        type:'POST',
        url:url,
        data:{
            phpIdEquipo: idEquipo
        },
        success: function(datos){
            //SUCCESS CODE
            if(datos == 0){
                alertify.error("NO EXISTEN INTEGRANTES DISPONIBLES EN ESTE EQUIPO");
            }else{
                $('#tablaRegistrosIntegrantesGraduacion').html(datos);
            }

            return false;
        }
    });
   return false;
});