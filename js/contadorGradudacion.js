$(document).ready(function () {
    $("input:submit").click(function () {
        return false;
    })
//contador();
});

function contadorGraduacion() {
    var tag = $('#inputTagGraduacion').val();
    var url = 'php/contadorGraduacion.php';


    if(tag.trim().length == ""){
        return false;

    }
    $.ajax({
        type:'POST',
        url:url,
        data: {
            phpTag: tag

        },
        success: function (datos) {

            var data = eval(datos);
                if(data[0] == 0){
                    alertify.error("ERROR, VERIFICAR INTEGRANTE EN PROMOCION ACTUAL");
                    $('#inputTagGraduacion').val("");
                    $('#divResultados').html(data[1]);
                }else{
                   if(data[0] ==4){
                       alertify.error("CANTIDAD MAXIMA ALCANZADA");
                       $('#divResultados').html(data[1]);
                       $('#inputTagGraduacion').val("");
                   }else{
                       if(data[0]==2){
                           alertify.error("ERROR, TAG YA LEIDO");
                           $('#divResultados').html(data[1]);
                           $('#inputTagGraduacion').val("");
                       }else{
                           $('#divResultados').html(data[1]);
                           $('#inputTagGraduacion').val("");
                       }
                   }
                }


                if(data[2] == 0){
                    return false;
                }else {
                    $('#contadorVisible').html(data[2]);
                }
            return false;
        }
    });
    return false;
}