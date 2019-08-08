$(document).ready(function() {
	//alert("Hola como estan");
    $('#exampleReporte').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );

    $('.datepicker').datepicker();


} );


function ReporteEquipoOV() {
    var equipojs = document.getElementById("EquipoSelect").value;

    var fechajs = $('#fechaReporte').val();

    if(equipojs.trim().length == ""){
            $('#errorPromo').html('Selecciona la promocion.').slideDown(500);
            return false;
        }else{
            $('#errorPromo').html('').slideUp(300);
            if(fechajs.trim().length == ""){
                    $('#errorFecha').html('Selecciona la fecha.').slideDown(500);
                    $('#fechaReporte').focus();
                    return false;
            }else{
                $('#errorFecha').html('').slideUp(300);
            }
        }

var url = "php/reporte_x_equipo.php";
$.ajax({
        type:'POST',
        url : url,
        data :
            {equipo:equipojs,
            fecha: fechajs
            },
        success:function (datos) {
            if(datos == 0){
                alertify.error("AUN NO HAY EQUIPOS EN LA PROMOCION ACTUAL");

            }else{
                $('#formularioReporteEquipo')[0].reset();
                $('#TablaReporteResumenEquipo').html(datos);


                var data = [equipojs,fechajs];
                console.log(data);
            }


            return false;
        }
    });
    return false;
};


function ReporteResumen() {

    var fechajs = $('#fechaReporte').val();

    if(fechajs.trim().length == ""){
        $('#errorFecha').html('Selecciona la fecha.').slideDown(500);
        $('#fechaReporte').focus();
        return false;
    }else{
        $('#errorFecha').html('').slideUp(300);
    }
var url = "php/reporte_resumen.php";
$.ajax({
        type:'POST',
        url : url,
        data :
            {
            fecha: fechajs
            },
        success:function (datos) {
            $('#formularioReporteEquipo')[0].reset();
            $('#tablaReporteEquipo').html(datos);


            var data = [equipojs,fechajs];
            console.log(data);
            return false;
        }
    });
    return false;
};