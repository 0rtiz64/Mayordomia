
$(document).ready(function () {
    $("input:submit").click(function () {
        return false;
    });
});


function activar(idIntegrante) {
    var url = 'php/estadosMultimedios.php';
    var accion = 1; //ACTIVAR
    $.ajax({
        type:'POST',
        url:url,
        data:{
            phpIdIntegrante:idIntegrante,
            phpAccion:accion

        },
        success: function(datos){
            //SUCCESS
            var resp = eval(datos);
            $('#table').html(resp[0]);
            swal(resp[1], "HA SIDO ACTIVADO", "success");

            $('#activos').html(resp[2]);
            $('#desactivos').html(resp[3]);

            $('#tableActivos').html(resp[4]);
            $('#tableDesactivos').html(resp[5]);
            return false;


        }
    });

    return false;

}


function desactivar(idIntegrante) {
    var url = 'php/estadosMultimedios.php';
    var accion = 2; //DESACTIVAR
    $.ajax({
        type:'POST',
        url:url,
        data:{
            phpIdIntegrante:idIntegrante,
            phpAccion:accion

        },
        success: function(datos){
            //SUCCESS
            var resp = eval(datos);
            $('#table').html(resp[0]);
            swal(resp[1], "HA SIDO DESACTIVADO", "error");
            $('#activos').html(resp[2]);
            $('#desactivos').html(resp[3]);
            $('#tableActivos').html(resp[4]);
            $('#tableDesactivos').html(resp[5]);
            return false;


        }
    });

    return false;



}

