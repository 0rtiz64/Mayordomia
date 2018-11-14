$(document).ready(function () {
    $("input:submit").click(function () {
        return false;
    })
//contador();
});

function contadorGraduacion() {
    var tag = $('#inputTagGraduacion').val();
    var url = 'php/contadorGraduacion.php';

    $.ajax({
        type:'POST',
        url:url,
        data: {
            phpTag: tag

        },
        success: function (datos) {
                if(datos == 0){
                    alertify.error("ERROR, VERIFICAR INTEGRANTE EN PROMOCION ACTUAL")
                    $('#inputTagGraduacion').val("");
                }else{
                   if(datos ==4){
                       alertify.error("CANTIDAD MAXIMA ALCANZADA");
                   }else{
                       if(datos==2){
                           alertify.error("ERROR, TAG YA LEIDO");
                           $('#inputTagGraduacion').val("");
                       }else{
                           $('#divResultados').html(datos);
                           $('#inputTagGraduacion').val("");
                       }
                   }
                }
            return false;
        }
    });
    return false;
}