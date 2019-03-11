$(document).ready(function () {
    $("input:submit").click(function () {
        return false;
    });

});

function guardarFecha(numFecha) {
   var fecha = $('#fecha'+numFecha).val();
    var url = 'php/reporteFechas.php';

    $.ajax({
        type:'POST',
        url:url,
        data: {
            phpFecha: fecha,
            phpNum: numFecha
        },
        success: function(res){
            swal("FECHA "+numFecha, "GUARDADA EXITOSAMENTE", "success");
            $('#divTablaReporte').html("");
             document.getElementById('selectEquipoReporteFechas').value ="";
            console.log(res);
        }
    });
}


$('#selectEquipoReporteFechas').change(function () {
    var equipo = document.getElementById('selectEquipoReporteFechas').value;
var url = 'php/reporteFechasGenerarReporte.php';

if(equipo.trim().length == ""){
    $('#divTablaReporte').html("");
    document.getElementById('selectEquipoReporteFechas').value ="";
    return false;
}
    $.ajax({
        type:'POST',
        url:url,
        data:{
            phpEquipo:equipo

        },
        success: function(datos){
            //SUCCESS
            $('#divTablaReporte').html(datos);
            console.log(datos);
            return false;


        }
    });

    return false;
});


function exportarExcel() {
    var equipo = document.getElementById('selectEquipoReporteFechas').value;
    if(equipo.trim().length==""){
        swal("¡CUIDADO!", "NO SE HA SELECCIONADO UN EQUIPO", "error");
        return false;
    }

    var url = 'php/exportarExcelReporteFechas.php?equipo='+equipo;
abrirEnPestana(url);

};

function abrirEnPestana(url) {
    var a = document.createElement("a");
    a.href = url;
    a.click();
}
