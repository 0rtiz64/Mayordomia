
$(document).ready(function () {
    $("input:submit").click(function () {
        return false;
    })


});

function listadosEquipos() {
var equipo = document.getElementById('equipoListadoSelect').value;

    if(equipo.trim().length == ""){
        $('#equipoListadoDiv').addClass('has-error');
        $('#alertEquipoSelect').slideDown(300);
        return false;
    }else{
        $('#equipoListadoDiv').removeClass('has-error');
        $('#equipoListadoDiv').addClass('has-success');
        $('#alertEquipoSelect').slideUp(300);

    }

    var url ='php/listadosEquipos.php';

    $.ajax({
        type:'POST',
        url:url,
        data:{
            phpEquipoL: equipo
        },
        success: function(datos){


            $('#listadoEquipos').html(datos);

            return false;


        }
    });
}