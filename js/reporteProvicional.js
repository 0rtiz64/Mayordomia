$(document).ready(function () {
    $("input:submit").click(function () {
        return false;
    });

});

function generarReporteProvicional() {
    var fecha = $('#fechaReporteProvicional').val();
   var url = 'php/reporteProvicional.php';

   if(fecha.trim().length==""){
       $('#divFechaReporteGeneral').addClass('has-error');
       alertify.error('CAMPO VACIO');
       $('#fechaReporteProvicional').focus;
       return false;
   }else{
       $('#divFechaReporteGeneral').removeClass('has-error');
       $('#divFechaReporteGeneral').addClass('has-success');

   }




    $.ajax({
        type:'POST',
        url : url,
        data :
            {fecha:fecha},
        beforeSend: function(){
            //imagen de carga
            $("#carga").html("<p align='center'><img src='myfiles/img/source.gif'  width='150px' height='150px'/></p>");
        },
        success:function (datos) {
            $("#carga").empty();
            $('#fechaReporteProvicional').val("");
            $('#tablaDatos').html(datos);
            return false;
        }
    });
    return false;
}