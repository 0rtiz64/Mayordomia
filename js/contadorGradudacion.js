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
                   if(data[0] ==2){
                       alertify.error("ERROR, TAG YA LEIDO");
                       $('#divResultados').html(data[1]);
                       $('#inputTagGraduacion').val("");
                   }else{
                           $('#divResultados').html(data[1]);
                           $('#inputTagGraduacion').val("");
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


function checkBox(idEquipo) {
    $('.myCheck').change(function () {
        if(this.checked){
            $('#inpDev').val(idEquipo);
            $('#modalConfirm').modal({
                show:true,
                backdrop:'static'
            });//FIN ABRIR MODAL
        }
    });
}


function devolver() {
    var idEquipo = $('#inpDev').val();
    var url = 'php/devolverTogas.php';

    $.ajax({
        type:'POST',
        url:url,
        data: {
            phpIdEquipo: idEquipo

        },
        success: function (datos) {
            var data = eval(datos);
            $('#modalConfirm').modal('toggle');
            $('#divResultados').html(data[0]);
            $('#contadorVisible').html(data[1]);
            return false;
        }
    });
    return false;
}