
$(document).ready(function () {
    $("input:submit").click(function () {
        return false;
    });

   /* $('#chart_area').dialog({
        autoOpen:false,
        width:500,
        height:500
    });
*/
});

$('#view_chart').click(function () {
    $('#for_chart').data('graph-container','#chart_area');
    $('#for_chart').data('graph-type','column');
    //ABRIR MODAL
    $('#for_chart').highchartTable();

    $('#chart_area').show(300);
});





function MarcarAuto() {
    var identidadjs = $('#identidadTxt').val();
    var url = "myfiles/php/marcarAuto";




    $.ajax({
        type:'POST',
        url : url,
        data :
            {identidad:identidadjs},
        success:function (datos) {
            $('#formularioAuto')[0].reset();
            $('#tabla').html(datos);


            var data = [identidadjs];
            console.log(data);
            return false;
        }
    });
    return false;
};

$('.mydate').datepicker({
    format: " yyyy-mm-dd",
    autoclose: true,
    todayHighlight: true
});


function ReporteEquipo() {
    var equipojs = document.getElementById("EquipoSelect").value;
    var fechajs = $('#fechaReporte').val();
var url = "myfiles/php/reporteEquipo";

if(equipojs.trim().length == ""){
    $('#equipoDiv').addClass('has-error');
    $('#alertEquipo').show('1000');
    return false;
}else{
    $('#alertEquipo').hide('1000');
    $('#equipoDiv').removeClass('has-error');
    $('#equipoDiv').addClass('has-success');

}



$.ajax({
        type:'POST',
        url : url,
        data :
            {equipo:equipojs,
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

//Reporte Detallado Liderazgo
function ReporteLiderazgoDetallado() {
    var equipoLiderazgojs = document.getElementById("EquipoSelectLiderazgo").value;
    var fechaLiderazgojs = $('#fechaReporteLiderazgo').val();
    var promocion = $('#promocion').val();
    var url = "php/reporteEquipoLiderazgo.php";




    $.ajax({
        type:'POST',
        url : url,
        data :
            {equipo:equipoLiderazgojs,
                fecha: fechaLiderazgojs,
                promocion: promocion
            },
        success:function (datos) {
            $('#formularioReporteEquipo')[0].reset();
            $('#tablaReporteEquipo').html(datos);


            var data = [equipoLiderazgojs,fechaLiderazgojs];
            console.log(data);
            return false;
        }
    });
    return false;
};


function ReporteEquipoResumen() {
    var fechaResumenjs = $('#fechaReporteResumen').val();
    var url = "myfiles/php/reporteEquipoResumen.php";



    $.ajax({
        type:'POST',
        url : url,
        data :
            {fechaResumen: fechaResumenjs
            },
        success:function (datos) {
            $('#formularioReporteEquipoResumen')[0].reset();
            $('#tablaReporteResumen').html(datos);


            var data = [fechaResumenjs];
            return false;
        }
    });
    return false;
}
$('#generarPdf').click(function () {
    $('#tabla').DataTable();
});
