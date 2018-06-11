
$(document).ready(function () {
    $("input:submit").click(function () {
        return false;
    })
});

function  matricularPast() {
    var identidad = $('#identidadInput').val();
    var nombre= $('#nombreInput').val();

    if(identidad.trim().length ==""){
        $('#identidadDiv').addClass('has-error');
        $('#alertIdentidadad').slideDown(300);
        return false;
    }else{
        $('#identidadDiv').removeClass('has-error');
        $('#identidadDiv').addClass('has-success');
        $('#alertIdentidadad').slideUp(300);

        if(nombre.trim().length ==""){
            $('#nombreDiv').addClass('has-error');
            $('#alertNombre').slideDown(300);
            return false
        }else{
            $('#nombreDiv').removeClass('has-error');
            $('#nombreDiv').addClass('has-success');
            $('#alertNombre').slideUp(300);

        }
    }

    var url = 'php/matricularPast.php';

    $.ajax({
        type:'POST',
        url:url,
        data:{
            phpId:identidad,
            phpNombre:nombre

        },
        success: function(datos){

            $('#identidadInput').val("");
            $('#nombreInput').val("");

            $('#guardado').html(datos).show('1000').delay('2500').hide('200');
            //$('#numeroExpedienteRegistrar').val(newId);
            return false;


        }
    });
    return false;
}